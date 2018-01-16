<?php

class PostModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function getPostBySlug($slug) {
        $post = $this->DB()->select(TABLE_PREFIX . "posts", "*", array(
            'slug' => $slug,
        ));
        if (!empty($post)) {
            $seo = @unserialize($post[0]['seo']);
            $post[0]['title'] = stripslashes($post[0]['title']);
            $post[0]['content'] = stripslashes($post[0]['content']);
            $post[0]['excerpt'] = stripslashes($post[0]['excerpt']);
            $post[0]['seo'] = $seo;
            return $post[0];
        }
        return array();
    }

    function getRelatedPosts($post, $limit) {
        try {
            $db = $this->DB();
            $sql = "SELECT DISTINCT P.* FROM " . TABLE_PREFIX . "posts P 
                    JOIN " . TABLE_PREFIX . "term_relationships T ON P.id = T.object_id 
                    WHERE P.lang_code = '" . Language::$lang_content . "' AND T.object_type = 'post' 
                    AND post_status = 'published' AND posted_date <= '{$post['posted_date']}' 
                    AND P.id <> {$post['id']} AND P.link = '' 
                    ORDER BY P.id DESC LIMIT $limit";
            $stm = $db->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                $posts = array();
                foreach ($result as $row) {
                    $row['title'] = stripslashes($row['title']);
                    $row['content'] = stripslashes($row['content']);
                    $row['excerpt'] = stripslashes($row['excerpt']);
                    $seo = @unserialize($row['seo']);
                    if (!empty($seo['seo_description'])) {
                        $seo['seo_description'] = $seo['seo_description'];
                    } elseif (!empty($posts[0]['excerpt'])) {
                        $seo['seo_description'] = strip_tags($posts[0]['excerpt']);
                    } elseif (!empty($posts[0]['content'])) {
                        $seo['seo_description'] = substr(strip_tags($posts[0]['content']), 0, 170);
                    }
                    $row['seo'] = $seo;
                    $posts[] = $row;
                }
                return $posts;
            }
            return array();
        } catch (Exception $exc) {
            if (DEBUG == TRUE) {
                Debug::throwException("Database error!", $exc);
            }
            return array();
        }
    }

    function getRelatedPosts2($post, $limit) {
        try {
            $db = $this->DB();
            $categories = implode(",", unserialize($post['categories']));
            $sql = "SELECT DISTINCT P.* FROM " . TABLE_PREFIX . "posts P 
                    JOIN " . TABLE_PREFIX . "term_relationships T ON P.id = T.object_id 
                    WHERE P.lang_code = '" . Language::$lang_content . "' AND T.object_type = 'post' 
                    AND post_status = 'published' AND posted_date <= '{$post['posted_date']}' 
                    AND P.id <> {$post['id']} AND P.link = '' AND taxonomy_id IN ($categories)
                    ORDER BY P.id DESC LIMIT $limit";
            $stm = $db->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                $posts = array();
                foreach ($result as $row) {
                    $row['title'] = stripslashes($row['title']);
                    $row['content'] = stripslashes($row['content']);
                    $row['excerpt'] = stripslashes($row['excerpt']);
                    $seo = @unserialize($row['seo']);
                    if (!empty($seo['seo_description'])) {
                        $seo['seo_description'] = $seo['seo_description'];
                    } elseif (!empty($posts[0]['excerpt'])) {
                        $seo['seo_description'] = strip_tags($posts[0]['excerpt']);
                    } elseif (!empty($posts[0]['content'])) {
                        $seo['seo_description'] = substr(strip_tags($posts[0]['content']), 0, 170);
                    }
                    $row['seo'] = $seo;
                    $posts[] = $row;
                }
                return $posts;
            }
            return array();
        } catch (Exception $exc) {
            if (DEBUG == TRUE) {
                Debug::throwException("Database error!", $exc);
            }
            return array();
        }
    }

    function countPosts($where = array(), $category = "") {
        $db = $this->DB();
        if (is_numeric($category) and $category > 0) {
            if (!empty($where)) {
                $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND post_status = 'published' AND " . $db->where($where);
            } else {
                $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND post_status = 'published'";
            }
            $sql = "SELECT COUNT(P.id) AS total FROM " . TABLE_PREFIX . "posts P 
                    JOIN " . TABLE_PREFIX . "term_relationships T ON P.id = T.object_id 
                    $where AND T.object_type = 'post' AND taxonomy_id = $category";
            $stm = $db->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $result[0]['total'];
        }
        if (!empty($where)) {
            $where = "lang_code = '" . Language::$lang_content . "' AND post_status = 'published' AND " . $db->where($where);
        } else {
            $where = "lang_code = '" . Language::$lang_content . "' AND post_status = 'published'";
        }
        $result = $db->select(TABLE_PREFIX . "posts", "COUNT(id) AS total", $where);
        return $result[0]['total'];
    }

    function updateViewCount($post) {
        $view = intval($post['view_count']) + rand(21, 24);
        $this->DB()->update(TABLE_PREFIX . "posts", array('view_count' => $view), array('id' => $post['id']));
    }

    function getPosts($start, $limit) {
        try {
            $db = $this->DB();
            $sql = "SELECT DISTINCT P.id, P.title, P.slug, P.content, P.thumbnail, C.name as category_name ";
            $sql .= "FROM " . TABLE_PREFIX . "posts P ";
            $sql .= "JOIN " . TABLE_PREFIX . "term_relationships T ON P.id = T.object_id ";
            $sql .= "JOIN " . TABLE_PREFIX . "categories C ON C.id = T.taxonomy_id ";
            $sql .= "WHERE P.post_status='published' ";
            $sql .= "ORDER BY P.id DESC LIMIT $start, $limit";
            $stm = $db->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $exc) {
            if (DEBUG == TRUE) {
                Debug::throwException("Database error!", $exc);
            }
            return array();
        }
        return array();
    }

}
