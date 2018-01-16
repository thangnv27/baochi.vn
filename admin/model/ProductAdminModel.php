<?php

class ProductAdminModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function create($data, $meta, $categories) {
        $id = $this->DB()->insert(TABLE_PREFIX . "products", $data);
        if ($id) {
            foreach ($meta as $key => $value) {
                $this->DB()->insert(TABLE_PREFIX . "productmeta", array(
                    'product_id' => $id,
                    'meta_key' => $key,
                    'meta_value' => $value,
                ));
            }
            foreach ($categories as $cat_ID) {
                $this->createTerms(array(
                    'object_id' => $id,
                    'object_type' => 'product',
                    'taxonomy_id' => $cat_ID,
                ));
            }
            return $id;
        }
        return FALSE;
    }

    function createTerms($data) {
        return $this->DB()->insert(TABLE_PREFIX . "term_relationships", $data);
    }

    function update($data, $meta, $product_id) {
        $this->DB()->update(TABLE_PREFIX . "products", $data, array('id' => $product_id));
        foreach ($meta as $key => $value) {
            if ($this->getMeta($product_id, $key) !== FALSE) {
                $this->DB()->update(TABLE_PREFIX . "productmeta", array(
                    'meta_value' => $value,
                        ), array(
                    'product_id' => $product_id,
                    'meta_key' => $key,
                ));
            } else {
                $this->DB()->insert(TABLE_PREFIX . "productmeta", array(
                    'product_id' => $product_id,
                    'meta_key' => $key,
                    'meta_value' => $value,
                ));
            }
        }
    }

    function delete($id) {
        $this->DB()->delete(TABLE_PREFIX . 'products', "id=" . $id);
        $this->DB()->delete(TABLE_PREFIX . 'productmeta', "product_id=" . $id);
    }

    function publish($id) {
        return $this->DB()->update(TABLE_PREFIX . 'products', array('post_status' => 'published'), "id=" . $id);
    }

    function publishBulk($where) {
        return $this->DB()->update(TABLE_PREFIX . 'products', array('post_status' => 'published'), $where);
    }

    function move2trashBulk($where) {
        return $this->DB()->update(TABLE_PREFIX . 'products', array('post_status' => 'trashed'), $where);
    }

    function updateTerms($post_id, $terms) {
        $this->DB()->delete(TABLE_PREFIX . 'term_relationships', array(
            'object_id' => $post_id,
            'object_type' => 'product',
        ));
        foreach ($terms as $cat_ID) {
            $this->createTerms(array(
                'object_id' => $post_id,
                'object_type' => 'product',
                'taxonomy_id' => $cat_ID,
            ));
        }
    }

    public function countPosts($where = array()) {
        $posts = $this->DB()->select(TABLE_PREFIX . "products", "COUNT(id) AS total", $where);
        return $posts[0]['total'];
    }

    public function getPosts($start, $limit, $where = array(), $category = "") {
        try {
            $db = $this->DB();
            if (!empty($where)) {
                $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND " . $db->where($where);
            }
            $sql = "SELECT P.*, U.username FROM " . TABLE_PREFIX . "products P JOIN " . TABLE_PREFIX . "users U 
                ON P.user_id = U.id " . $where . " ORDER BY P.id DESC LIMIT $start, $limit";
            if (is_numeric($category) and $category > 0) {
                $sql = "SELECT P.*, U.username FROM " . TABLE_PREFIX . "products P 
                        JOIN " . TABLE_PREFIX . "users U ON P.user_id = U.id 
                        JOIN " . TABLE_PREFIX . "term_relationships T ON P.id = T.object_id 
                        WHERE P.lang_code = '" . Language::$lang_content . "' AND T.object_type = 'product' AND taxonomy_id = $category AND post_status IN ('draft','published') ORDER BY P.id DESC LIMIT $start, $limit";
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

    function getPostByTitle($title) {
        return $this->DB()->select(TABLE_PREFIX . "products", "*", array(
                    'title' => $title,
                    'lang_code' => Language::$lang_content,
        ));
    }

    function getPostBySlug($slug) {
        return $this->DB()->select(TABLE_PREFIX . "products", "*", array(
                    'slug' => $slug,
                    'lang_code' => Language::$lang_content,
        ));
    }

    function getProductByID($id) {
        $post = $this->DB()->select(TABLE_PREFIX . "products", "*", array(
            'id' => $id,
        ));
        if (!empty($post)) {
            $meta = $this->DB()->select(TABLE_PREFIX . "productmeta", "*", array(
                'product_id' => $id,
            ));
            $post[0]['meta'] = array();
            foreach ($meta as $value) {
                $post[0]['meta'][$value['meta_key']] = $value['meta_value'];
            }
        }
        return $post;
    }

    function getMeta($product_id, $key) {
        $meta = $this->DB()->select(TABLE_PREFIX . "productmeta", "*", array(
            'product_id' => $product_id,
            'meta_key' => $key,
        ));
        if (!empty($meta)) {
            return $meta[0]['meta_value'];
        }
        return false;
    }

    function getAllTags() {
        $result = "";
        $tags = $this->DB()->select(TABLE_PREFIX . "products", "tags");
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
