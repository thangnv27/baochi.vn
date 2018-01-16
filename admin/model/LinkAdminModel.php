<?php

class LinkAdminModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function create($data) {
        return $this->DB()->insert(TABLE_PREFIX . "links", $data);
    }

    function createTerms($data) {
        return $this->DB()->insert(TABLE_PREFIX . "term_relationships", $data);
    }

    function update($data, $where) {
        $this->DB()->update(TABLE_PREFIX . "links", $data, $where);
    }

    function updateTerms($post_id, $terms) {
        $this->DB()->delete(TABLE_PREFIX . 'term_relationships', array(
            'object_id' => $post_id,
            'object_type' => 'link',
        ));
        foreach ($terms as $cat_ID) {
            $this->createTerms(array(
                'object_id' => $post_id,
                'object_type' => 'link',
                'taxonomy_id' => $cat_ID,
            ));
        }
    }

    function updateTermsBulk($ids, $cat_ID) {
        $this->DB()->delete(TABLE_PREFIX . 'term_relationships', "object_id IN ($ids) AND object_type='link'");
        $list = explode(",", $ids);
        foreach ($list as $id) {
            $this->createTerms(array(
                'object_id' => $id,
                'object_type' => 'link',
                'taxonomy_id' => $cat_ID,
            ));
        }
    }

    function delete($id) {
        $db = $this->DB();
        $db->delete(TABLE_PREFIX . 'links', "id=" . $id);
        $db->delete(TABLE_PREFIX . 'term_relationships', array(
            'object_id' => $id,
            'object_type' => 'link',
        ));
        $db->delete(TABLE_PREFIX . 'report_links', "link_id=" . $id);
        $db->delete(TABLE_PREFIX . 'favorite_links', "link_id=" . $id);
    }
    
        /**
     * 
     * @param array $ids
     */
    function deleteBulk($ids) {
        if (!empty($ids)) {
            $db = $this->DB();
            $link_ID = implode(",", $ids);
            $db->delete(TABLE_PREFIX . 'links', "id IN ($link_ID)");
            
            foreach ($ids as $id) {
                $db->delete(TABLE_PREFIX . 'term_relationships', array(
                    'object_id' => $id,
                    'object_type' => 'link',
                ));
            }
        }
    }

    function approve($id) {
        $db = $this->DB();
        $db->update(TABLE_PREFIX . 'links', array(
            'report_count' => 0,
            'post_status' => 'published',
                ), array(
            'id' => $id,
        ));
        $db->delete(TABLE_PREFIX . 'report_links', "link_id=" . $id);
    }

    function publish($id) {
        return $this->DB()->update(TABLE_PREFIX . 'links', array('post_status' => 'published'), "id=" . $id);
    }

    function publishBulk($where) {
        return $this->DB()->update(TABLE_PREFIX . 'links', array('post_status' => 'published'), $where);
    }

    function move2trashBulk($where) {
        return $this->DB()->update(TABLE_PREFIX . 'links', array('post_status' => 'trashed'), $where);
    }

    public function countLinks($where = "", $category = "") {
        $result = array();
        if (is_numeric($category) and $category > 0) {
            try {
                $sql = "SELECT COUNT(L.id) AS total FROM " . TABLE_PREFIX . "links L 
                        JOIN " . TABLE_PREFIX . "term_relationships T ON L.id = T.object_id 
                        WHERE L.lang_code = '" . Language::$lang_content . "' AND object_type = 'link' 
                        AND taxonomy_id = $category AND post_status IN ('draft','published')";
                $stm = $this->DB()->prepare($sql);
                $stm->execute();
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $exc) {
                if (DEBUG == TRUE) {
                    Debug::throwException("Database error!", $exc);
                }
                return array(0);
            }
        } else {
            $result = $this->DB()->select(TABLE_PREFIX . "links", "COUNT(id) AS total", $where);
        }
        return $result[0]['total'];
    }

    public function getLinks($start, $limit, $where = "", $orderby = "", $order = "", $category = "") {
        try {
            $db = $this->DB();
            if (!empty($where)) {
                $where = "WHERE lang_code = '" . Language::$lang_content . "' AND " . $db->where($where);
            }
            $sql = "SELECT DISTINCT L.*, U.username FROM " . TABLE_PREFIX . "links L
                    JOIN " . TABLE_PREFIX . "users U ON L.user_id = U.id $where";

            if (is_numeric($category) and $category > 0) {
                $sql = "SELECT DISTINCT L.*, U.username FROM " . TABLE_PREFIX . "links L 
                        JOIN " . TABLE_PREFIX . "users U ON L.user_id = U.id 
                        JOIN " . TABLE_PREFIX . "term_relationships T ON L.id = T.object_id 
                        WHERE L.lang_code = '" . Language::$lang_content . "' AND T.object_type = 'link' 
                        AND taxonomy_id = $category AND post_status IN ('draft','published') ";
            }
            
            if(empty($orderby)){
                $sql .= " ORDER BY id ";
            } else {
                $sql .= " ORDER BY $orderby ";
            }
            if(empty($order)){
                $sql .= " DESC ";
            } else {
                $sql .= " $order ";
            }
            $sql .= " LIMIT $start, $limit";
            
            $stm = $db->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            if (DEBUG == TRUE) {
                Debug::throwException("Database error!", $exc);
            }
            return array();
        }
    }

    function getLinkByTitle($title) {
        return $this->DB()->select(TABLE_PREFIX . "links", "*", array(
                    'title' => $title,
                    'lang_code' => Language::$lang_content,
        ));
    }

    function getLinkBySlug($slug) {
        return $this->DB()->select(TABLE_PREFIX . "links", "*", array(
                    'slug' => $slug,
                    'lang_code' => Language::$lang_content,
        ));
    }

    function getLinkByID($id) {
        $result = $this->DB()->select(TABLE_PREFIX . "links", "*", array(
            'id' => $id,
        ));
        return $result;
    }

    function isExistsLink($link) {
        $result = $this->DB()->get_row(TABLE_PREFIX . "links", "*", array(
            'link' => $link,
        ));
        if (!$result)
            return false;
        return true;
    }

    function getLatestLinks($limit = 10) {
        try {
            $db = $this->DB();
            $sql = "SELECT DISTINCT L.*, U.username FROM " . TABLE_PREFIX . "links L
                    JOIN " . TABLE_PREFIX . "users U ON L.user_id = U.id 
                    WHERE post_status='published'
                    ORDER BY id DESC LIMIT $limit";
            $stm = $db->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            if (DEBUG == TRUE) {
                Debug::throwException("Database error!", $exc);
            }
            return array();
        }
    }

    function getRandomLinks($limit = 10) {
        try {
            $db = $this->DB();
            $sql = "SELECT DISTINCT L.*, U.username FROM " . TABLE_PREFIX . "links L
                    JOIN " . TABLE_PREFIX . "users U ON L.user_id = U.id 
                    WHERE post_status='published'
                    ORDER BY rand() LIMIT $limit";
            $stm = $db->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            if (DEBUG == TRUE) {
                Debug::throwException("Database error!", $exc);
            }
            return array();
        }
    }
}
