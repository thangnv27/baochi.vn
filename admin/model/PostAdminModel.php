<?php

class PostAdminModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function create($data) {
        return $this->DB()->insert(TABLE_PREFIX . "posts", $data);
    }

    function createTerms($data) {
        return $this->DB()->insert(TABLE_PREFIX . "term_relationships", $data);
    }

    function update($data, $where) {
        $this->DB()->update(TABLE_PREFIX . "posts", $data, $where);
    }

    function delete($id) {
        $db = $this->DB();
        $db->delete(TABLE_PREFIX . 'posts', "id=" . $id);
        $db->delete(TABLE_PREFIX . 'postmeta', "post_id=" . $id);
        $db->delete(TABLE_PREFIX . 'term_relationships', array(
            'object_id' => $id,
            'object_type' => 'post',
        ));
        $db->delete(TABLE_PREFIX . 'term_relationships', array(
            'object_id' => $id,
            'object_type' => 'source',
        ));
    }

    /**
     * 
     * @param array $ids
     */
    function deleteBulk($ids) {
        if (!empty($ids)) {
            $db = $this->DB();
            $post_ID = implode(",", $ids);
            $db->delete(TABLE_PREFIX . 'posts', "id IN ($post_ID)");
            $db->delete(TABLE_PREFIX . 'postmeta', "post_id IN ($post_ID)");
            foreach ($ids as $id) {
                $db->delete(TABLE_PREFIX . 'term_relationships', array(
                    'object_id' => $id,
                    'object_type' => 'post',
                ));
                $db->delete(TABLE_PREFIX . 'term_relationships', array(
                    'object_id' => $id,
                    'object_type' => 'source',
                ));
            }
        }
    }

    function publish($id) {
        return $this->DB()->update(TABLE_PREFIX . 'posts', array('post_status' => 'published'), "id=" . $id);
    }

    function publishBulk($where) {
        return $this->DB()->update(TABLE_PREFIX . 'posts', array('post_status' => 'published'), $where);
    }

    function move2trashBulk($where) {
        return $this->DB()->update(TABLE_PREFIX . 'posts', array('post_status' => 'trashed'), $where);
    }

    function updateTerms($post_id, $terms) {
        $this->DB()->delete(TABLE_PREFIX . 'term_relationships', array(
            'object_id' => $post_id,
            'object_type' => 'post',
        ));
        foreach ($terms as $cat_ID) {
            $this->createTerms(array(
                'object_id' => $post_id,
                'object_type' => 'post',
                'taxonomy_id' => $cat_ID,
            ));
        }
    }

    function updateSources($post_id, $source) {
        $this->DB()->delete(TABLE_PREFIX . 'term_relationships', array(
            'object_id' => $post_id,
            'object_type' => 'source',
        ));
        $this->createTerms(array(
            'object_id' => $post_id,
            'object_type' => 'source',
            'taxonomy_id' => $source,
        ));
    }

    public function countPosts($where = array(), $category = "", $source = "") {
        $result = array();
        $sql = "";
        if (is_numeric($category) and $category > 0 and is_numeric($source) and $source > 0) {
            $sql = "SELECT COUNT(P.id) AS total FROM " . TABLE_PREFIX . "posts P 
                JOIN " . TABLE_PREFIX . "users U ON P.user_id = U.id 
                JOIN " . TABLE_PREFIX . "term_relationships T ON P.id = T.object_id 
                WHERE P.lang_code = '" . Language::$lang_content . "' AND T.object_type IN ('post', 'source') 
                AND taxonomy_id IN ($category, $source) AND post_status IN ('draft','published')";
        } else if (is_numeric($category) and $category > 0) {
            $sql = "SELECT COUNT(P.id) AS total FROM " . TABLE_PREFIX . "posts P 
                JOIN " . TABLE_PREFIX . "users U ON P.user_id = U.id 
                JOIN " . TABLE_PREFIX . "term_relationships T ON P.id = T.object_id 
                WHERE P.lang_code = '" . Language::$lang_content . "' AND T.object_type = 'post' 
                AND taxonomy_id = $category AND post_status IN ('draft','published')";
        } else if (is_numeric($source) and $source > 0) {
            $sql = "SELECT COUNT(P.id) AS total FROM " . TABLE_PREFIX . "posts P 
                JOIN " . TABLE_PREFIX . "users U ON P.user_id = U.id 
                JOIN " . TABLE_PREFIX . "term_relationships T ON P.id = T.object_id 
                WHERE P.lang_code = '" . Language::$lang_content . "' AND T.object_type = 'source' 
                AND taxonomy_id = $source AND post_status IN ('draft','published')";
        } 
        if(!empty($sql)){
            try {
                $stm = $this->DB()->prepare($sql);
                $stm->execute();
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $exc) {
                if (DEBUG == TRUE) {
                    Debug::throwException("Database error!", $exc);
                }
                return array(0);
            }
        }else {
            $result = $this->DB()->select(TABLE_PREFIX . "posts", "COUNT(id) AS total", $where);
        }
        return $result[0]['total'];
    }

    public function getPosts($start, $limit, $where = array(), $category = "", $source = "") {
        try {
            $db = $this->DB();
            if (!empty($where)) {
                $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND " . $db->where($where);
            }
            $sql = "SELECT DISTINCT P.*, U.username FROM " . TABLE_PREFIX . "posts P JOIN " . TABLE_PREFIX . "users U 
                ON P.user_id = U.id " . $where . " ORDER BY P.id DESC LIMIT $start, $limit";
            if (is_numeric($category) and $category > 0 and is_numeric($source) and $source > 0) {
                $sql = "SELECT DISTINCT P.*, U.username FROM " . TABLE_PREFIX . "posts P 
                        JOIN " . TABLE_PREFIX . "users U ON P.user_id = U.id 
                        JOIN " . TABLE_PREFIX . "term_relationships T ON P.id = T.object_id 
                        WHERE P.lang_code = '" . Language::$lang_content . "' AND T.object_type IN ('post', 'source') 
                        AND taxonomy_id IN ($category, $source) AND post_status IN ('draft','published') 
                        ORDER BY P.id DESC LIMIT $start, $limit";
            } else if (is_numeric($category) and $category > 0) {
                $sql = "SELECT DISTINCT P.*, U.username FROM " . TABLE_PREFIX . "posts P 
                        JOIN " . TABLE_PREFIX . "users U ON P.user_id = U.id 
                        JOIN " . TABLE_PREFIX . "term_relationships T ON P.id = T.object_id 
                        WHERE P.lang_code = '" . Language::$lang_content . "' AND T.object_type = 'post' 
                        AND taxonomy_id = $category AND post_status IN ('draft','published') 
                        ORDER BY P.id DESC LIMIT $start, $limit";
            } else if (is_numeric($source) and $source > 0) {
                $sql = "SELECT DISTINCT P.*, U.username FROM " . TABLE_PREFIX . "posts P 
                        JOIN " . TABLE_PREFIX . "users U ON P.user_id = U.id 
                        JOIN " . TABLE_PREFIX . "term_relationships T ON P.id = T.object_id 
                        WHERE P.lang_code = '" . Language::$lang_content . "' AND T.object_type = 'source' 
                        AND taxonomy_id = $source AND post_status IN ('draft','published') 
                        ORDER BY P.id DESC LIMIT $start, $limit";
            }
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

    function getPostsOlder() {
        $date = date('Y-m-d H:i:s', strtotime("-30 day"));
        $where = "link <> '' AND posted_date < '{$date}'";
        return $this->DB()->select(TABLE_PREFIX . "posts", "id", $where);
    }
    
    public function deleteOldPosts($num_day) {
        try {
            $db = $this->DB();
            $date = date('Y-m-d H:i:s', strtotime("-$num_day day"));
            $where = "link <> '' AND posted_date < '{$date}'";
            $db->delete(TABLE_PREFIX . 'posts', $where);
            
            $sql = "DELETE FROM " . TABLE_PREFIX . "term_relationships 
                    WHERE object_type = 'post' AND object_id NOT IN (SELECT id FROM " . TABLE_PREFIX . "posts)";
            $db->exec($sql);
        } catch (Exception $exc) {
            if (DEBUG == TRUE) {
                Debug::throwException("Database error!", $exc);
            }
        }
    }

    function getPostByTitle($title) {
        return $this->DB()->select(TABLE_PREFIX . "posts", "*", array(
                    'title' => $title,
                    'lang_code' => Language::$lang_content,
        ));
    }

    function getPostByMD5Title($title_md5) {
        return $this->DB()->select(TABLE_PREFIX . "posts", "*", array(
                    'title_md5' => $title_md5,
                    'lang_code' => Language::$lang_content,
        ));
    }

    function getPostBySlug($slug) {
        return $this->DB()->select(TABLE_PREFIX . "posts", "*", array(
                    'slug' => $slug,
                    'lang_code' => Language::$lang_content,
        ));
    }

    function getPostByID($id) {
        $post = $this->DB()->select(TABLE_PREFIX . "posts", "*", array(
            'id' => $id,
        ));
        return $post;
    }

    function getLatestPostRss($rss_id) {
        return $this->DB()->get_row(TABLE_PREFIX . "posts", "*", array(
                            'rss_id' => $rss_id,
                        ), 'id', 'DESC');
    }
    
    function getPostsByCategory($limit = 0, $category) {
        try {
            $db = $this->DB();
            $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND post_status = 'published'";
            $sql = "SELECT DISTINCT P.* FROM " . TABLE_PREFIX . "posts P 
                    JOIN " . TABLE_PREFIX . "users U ON P.user_id = U.id 
                    JOIN " . TABLE_PREFIX . "term_relationships T ON P.id = T.object_id AND T.object_type = 'post' 
                    $where AND taxonomy_id = $category ORDER BY P.posted_date DESC LIMIT $limit";
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

    function getAllTags() {
        $result = "";
        $tags = $this->DB()->select(TABLE_PREFIX . "posts", "tags");
        foreach ($tags as $key => $tag) {
            $tmp = explode(",", $tag['tags']);
            if ($key >= count($tags) - 1) {
                foreach ($tmp as $k => $v) {
                    if ($k >= count($tmp) - 1) {
                        $result .= '"' . $v . '"';
                    } else {
                        $result .= '"' . $v . '",';
                    }
                }
            } else {
                foreach ($tmp as $k => $v) {
                    $result .= '"' . $v . '",';
                }
            }
        }
        return $result;
    }

}
