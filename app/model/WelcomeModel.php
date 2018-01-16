<?php

class WelcomeModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function allSources() {
        $result = $this->DB()->select(TABLE_PREFIX . "categories", "*", "taxonomy='source' AND displayorder > 0", "displayorder");
        $cat = array();
        foreach ($result as $row) {
            $row['countpost'] = $this->getCountPost($row['id']);
            $cat[] = $row;
        }
        return $cat;
    }

    function getCountPost($sourceID) {
        $result = $this->DB()->select(TABLE_PREFIX . "posts", "count(id)", "source = '$sourceID'");
        return $result[0]['count(id)'];
    }

    public function mobileSources() {
        $result = $this->DB()->select(TABLE_PREFIX . "categories", "*", "taxonomy='source' AND hidemobile='0' AND displayorder > 0 AND displayorder <> 10101010", "displayorder");
        return $result;
    }

    function getLinkCategories() {
        $db = $this->DB();
        return $db->select(TABLE_PREFIX . "categories", "*", "taxonomy='link' AND parent=0 AND displayorder > 0", "displayorder");
    }

    function getWebHayByCategory($cat_ID) {
        $result = array();
        $db = $this->DB();
        $categories = $db->select(TABLE_PREFIX . "categories", "*", array(
            'id' => $cat_ID,
        ));
        $where = "WHERE report_count < 5 AND L.lang_code = '" . Language::$lang_content . "' AND post_status = 'published'";
        foreach ($categories as $key => $category) {
            $childs = $this->categoryCategoryByParent($category['id']);
            $sql = "SELECT DISTINCT L.* FROM " . TABLE_PREFIX . "links L 
                    JOIN " . TABLE_PREFIX . "users U ON L.user_id = U.id 
                    JOIN " . TABLE_PREFIX . "term_relationships T ON L.id = T.object_id 
                    $where AND T.object_type = 'link' AND taxonomy_id = {$category['id']} 
                    ORDER BY L.view_count DESC";
            $stm = $db->prepare($sql);
            $stm->execute();
            $links = $stm->fetchAll(PDO::FETCH_ASSOC);
            $result[$key] = array(
                'cat_ID' => $category['id'],
                'cat_name' => stripslashes($category['name']),
                'links' => $links,
                'childs' => null,
            );

            if (!empty($childs)) {
                foreach ($childs as $k => $child) {
                    $sql = "SELECT DISTINCT L.* FROM " . TABLE_PREFIX . "links L 
                        JOIN " . TABLE_PREFIX . "users U ON L.user_id = U.id 
                        JOIN " . TABLE_PREFIX . "term_relationships T ON L.id = T.object_id 
                        $where AND T.object_type = 'link' AND taxonomy_id = {$child['id']} 
                        ORDER BY L.view_count DESC";
                    $stm = $db->prepare($sql);
                    $stm->execute();
                    $links = $stm->fetchAll(PDO::FETCH_ASSOC);
                    $result[$key]['childs'][] = array(
                        'cat_ID' => $child['id'],
                        'cat_name' => stripslashes($child['name']),
                        'links' => $links,
                    );
                }
            }
        }
        return $result;
    }

    function categoryCategoryByParent($parent) {
        return $this->DB()->select(TABLE_PREFIX . "categories", "*", "taxonomy='link' AND parent=$parent AND displayorder > 0", "displayorder");
    }

    function getHeadline() {
        try {
            $db = $this->DB();
            $date = date('Y-m-d', strtotime("-2 day"));
            $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND post_status = 'published' AND posted_date > '{$date}'";
            $sql = "SELECT P.* FROM " . TABLE_PREFIX . "posts P $where ORDER BY P.view_count DESC LIMIT 10";
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

    function getPostSlider($start = 0, $limit = 10) {
        try {
            $db = $this->DB();
            $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND post_status = 'published' AND show_in_slider = 'show'";
            $sql = "SELECT DISTINCT P.*, C.name as sourcename, C.website FROM " . TABLE_PREFIX . "posts P 
                    JOIN " . TABLE_PREFIX . "users U ON P.user_id = U.id 
                    JOIN " . TABLE_PREFIX . "categories C ON P.source = C.id 
                    $where ORDER BY P.view_count DESC LIMIT $start, $limit";
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

    function getTinTamDiemSuggest($limit = 10) {
        try {
            $db = $this->DB();
            $date = date('Y-m-d', strtotime("-2 day"));
            $date2 = date('Y-m-d', strtotime("-7 day"));
            $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND post_status = 'published' AND source = 174 AND posted_date <= '{$date}' AND posted_date >= '{$date2}'";
            $sql = "SELECT P.* FROM " . TABLE_PREFIX . "posts P $where ORDER BY P.posted_date DESC LIMIT $limit";
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

    function getFavoriteLinks($user_id) {
        try {
            $user_id = intval($user_id);
            $db = $this->DB();
            $sql = "SELECT L.* FROM " . TABLE_PREFIX . "links L 
                    JOIN " . TABLE_PREFIX . "favorite_links F ON F.link_id = L.id 
                    WHERE F.user_id = $user_id 
                    ORDER BY L.view_count DESC LIMIT 50";

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

    function addFavoriteLink($data) {
        return $this->DB()->insert(TABLE_PREFIX . "favorite_links", $data);
    }

    function removeFavoriteLink($array) {
        $db = $this->DB();
        $link_id = $array['link_id'];
        $user_id = $array['user_id'];
        $db->delete(TABLE_PREFIX . "favorite_links", $array);
        $db->delete(TABLE_PREFIX . 'links', array(
            'id' => $link_id,
            'user_id' => $user_id
        ));
        $db->delete(TABLE_PREFIX . 'report_links', array(
            "link_id" => $link_id
        ));
        $db->delete(TABLE_PREFIX . 'favorite_links', array(
            "link_id" => $link_id
        ));
        try {
            $where = $db->where(array(
                'id' => $link_id,
                'user_id' => $user_id
            ));
            $sql = "DELETE FROM " . TABLE_PREFIX . "term_relationships WHERE object_type='link' AND 
                    object_id=(SELECT L.id FROM " . TABLE_PREFIX . "links L WHERE $where";
            $db->exec($sql);
        } catch (Exception $ex) {
            
        }
    }

    function countFavoriteLinks($where) {
        $result = $this->DB()->select(TABLE_PREFIX . "favorite_links", "COUNT(id) AS total", $where);
        return $result[0]['total'];
    }

    function getBlacklistDomains() {
        $result = $this->DB()->select(TABLE_PREFIX . 'blacklist_domains');
        $domains = array();
        foreach ($result as $row) {
            $domains[$row['id']] = $row['domain'];
        }
        return $domains;
    }

    function report_link($data) {
        return $this->DB()->insert(TABLE_PREFIX . 'report_links', $data);
    }

    function get_admin_links() {
        return $this->DB()->select(TABLE_PREFIX . "links", array('id', 'title', 'link'), array(
                    'user_id' => 1,
        ));
    }

    function getHotPosts($start = 0, $limit = 10) {
        try {
            $db = $this->DB();
            $date = date('Y-m-d H:i:s', strtotime("-20 day"));

            $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND post_status = 'published' AND posted_date >= '{$date}'";
            $sql = "SELECT DISTINCT P.*, C.name as sourcename, C.website FROM " . TABLE_PREFIX . "posts P 
                    JOIN " . TABLE_PREFIX . "users U ON P.user_id = U.id 
                    JOIN " . TABLE_PREFIX . "categories C ON P.source = C.id 
                    $where ORDER BY P.view_count DESC LIMIT $start, $limit";
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

    function getNewPosts($start = 0, $limit = 10) {
        try {
            $db = $this->DB();
            $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND post_status = 'published'";
            $sql = "SELECT DISTINCT P.*, C.name as sourcename, C.website FROM " . TABLE_PREFIX . "posts P 
                    JOIN " . TABLE_PREFIX . "users U ON P.user_id = U.id 
                    JOIN " . TABLE_PREFIX . "categories C ON P.source = C.id 
                    $where ORDER BY P.posted_date DESC LIMIT $start, $limit";
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

    /**
     * 
     * @param int $limit
     * @param int $source Source ID
     * @return array
     */
    function getPostsBySource($start = 0, $limit = 10, $source) {
        try {
            $db = $this->DB();
            $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND post_status = 'published' AND source = $source";
            $sql = "SELECT DISTINCT P.* FROM " . TABLE_PREFIX . "posts P 
                    JOIN " . TABLE_PREFIX . "users U ON P.user_id = U.id 
                    $where  ORDER BY P.view_count DESC LIMIT $start, $limit";
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

    // get cat id by slug
    function getCatIDBySlug($slug) {
        $result = $this->DB()->select(TABLE_PREFIX . "categories", "id", array(
            'slug' => $slug,
            'taxonomy' => 'post',
        ));
        if (!empty($result))
            return $result[0]['id'];
    }

//    get cat by slug
    public function getAllCatCategoryBySlug($slug) {
        $categories = $this->DB()->select(TABLE_PREFIX . "categories", "*", "taxonomy='post' AND parent = 0 AND displayorder > 0 AND slug = '{$slug}'", "displayorder");
        foreach ($categories as $category) {
            $childs = $this->categoryChild($category['id']);
            $category['childs'] = $childs;
            $result[] = $category;
        }
        return $result;
    }

    // get posts by cat

    function getPostsByCatSlug($start = 0, $limit = 10, $slug) {
        try {
            $catID = $this->getCatIDBySlug($slug);
            $db = $this->DB();
//            $date = date('Y-m-d H:i:s', strtotime("-12 hour"));
            $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND post_status = 'published' AND categories REGEXP '.*;s:[0-9]+:\"$catID\".*' ";
            $sql = "SELECT DISTINCT P.*, C.name as sourcename, C.website FROM " . TABLE_PREFIX . "posts P 
                    JOIN " . TABLE_PREFIX . "users U ON P.user_id = U.id 
                    JOIN " . TABLE_PREFIX . "categories C ON P.source = C.id 
                    $where ORDER BY P.view_count DESC LIMIT $start, $limit";
//                    $where AND P.posted_date <= '$date' ORDER BY P.view_count DESC LIMIT $start, $limit";
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

//    get cat
    public function allCategory() {
        $categories = $this->DB()->select(TABLE_PREFIX . "categories", "*", "taxonomy='post' AND parent = 0 AND displayorder > 0", "displayorder");
        foreach ($categories as $category) {
            $childs = $this->categoryChild($category['id']);
            $category['childs'] = $childs;
            $result[] = $category;
        }
        return $result;
    }

    function categoryChild($parent) {
        $result = array();

        $where = array(
            'taxonomy' => 'post',
            'parent' => intval($parent),
            'lang_code' => Language::$lang_content,
        );

        $categories = $this->DB()->select(TABLE_PREFIX . "categories", "*", $where, "displayorder");
        foreach ($categories as $category) {
            $result[] = $category;
            $childs = $this->categoryChild($category['id']);
            foreach ($childs as $child) {
                $result[] = $child;
            }
        }
        return $result;
    }

}
