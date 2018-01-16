<?php

class CategoryAdminModel extends Model {
    
    private $taxonomy = 'post';

    function __construct() {
        parent::__construct();
    }

    public function allCategories() {
        $categories = $this->DB()->select(TABLE_PREFIX . "categories", "*", array(
            'taxonomy' => 'post',
            'lang_code' => Language::$lang_content,
                ), "displayorder");
        return $categories;
    }

    function create($data) {
        return $this->DB()->insert(TABLE_PREFIX . "categories", $data);
    }

    function update($data, $where) {
        $this->DB()->update(TABLE_PREFIX . "categories", $data, $where);
    }

    function delete($id) {
        return $this->DB()->delete(TABLE_PREFIX . 'categories', "id=" . $id);
    }

    function deleteBulk($where) {
        return $this->DB()->delete(TABLE_PREFIX . 'categories', $where);
    }

    function getCategoryByID($id) {
        $category = $this->DB()->select(TABLE_PREFIX . "categories", "*", array(
            'taxonomy' => 'post',
            'id' => $id,
        ));
        return $category;
    }

    function getCategoryByName($name) {
        $category = $this->DB()->select(TABLE_PREFIX . "categories", "*", array(
            'taxonomy' => 'post',
            'name' => $name,
                //'lang_code' => Language::$lang_content,
        ));
        return $category;
    }

    function getCategoryBySlug($slug) {
        $category = $this->DB()->select(TABLE_PREFIX . "categories", "*", array(
            'taxonomy' => 'post',
            'slug' => $slug,
                //'lang_code' => Language::$lang_content,
        ));
        return $category;
    }

    public function countCategories() {
        $result = $this->DB()->select(TABLE_PREFIX . "categories", "COUNT(id) AS total", array(
            'taxonomy' => $this->taxonomy,
            'lang_code' => Language::$lang_content,
        ));
        return $result[0]['total'];
    }

    function getCategories($start, $limit) {
        try {
            $db = $this->DB();
            $sql = "SELECT * FROM " . TABLE_PREFIX . "categories 
                    WHERE taxonomy='{$this->taxonomy}' 
                    ORDER BY displayorder ASC";
//            $sql = "SELECT * FROM " . TABLE_PREFIX . "categories 
//                    WHERE taxonomy='{$this->taxonomy}' 
//                    ORDER BY displayorder ASC LIMIT $start, $limit";
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

    function countPostByCatID($cat_ID) {
        $terms = $this->DB()->select(TABLE_PREFIX . "term_relationships", "*", array(
            'object_type' => 'post',
            'taxonomy_id' => $cat_ID,
        ));
        return count($terms);
    }

    function countChildByCatID($cat_ID) {
        $terms = $this->DB()->select(TABLE_PREFIX . "categories", "*", array(
            'taxonomy' => 'post',
            'parent' => $cat_ID,
        ));
        return count($terms);
    }

    /**
     * @param bool $has_none First item is none
     * @return array 
     */
    public function categoryOptions($has_none = true) {
        $result = array();
        if ($has_none) {
            $result = array('0' => Language::$phrases['context']['none']);
        }
        $categories = $this->DB()->select(TABLE_PREFIX . "categories", "*", array(
            'taxonomy' => 'post',
            'parent' => 0,
                //'lang_code' => Language::$lang_content,
                ), "displayorder");
        foreach ($categories as $category) {
            $result[$category['id']] = $category['name'];
            $childs = $this->categoryChildOptions($category['id'], 0);
            $result = $result + $childs;
        }
        return $result;
    }

    /**
     * 
     * @param int $parent Category parent
     * @return array 
     */
    function categoryChildOptions($parent, $indent = 0) {
        $result = array();
        $categories = $this->DB()->select(TABLE_PREFIX . "categories", "*", array(
            'taxonomy' => 'post',
            'parent' => intval($parent),
                //'lang_code' => Language::$lang_content,
                ), "displayorder");
        foreach ($categories as $category) {
            $result[$category['id']] = Utils::indentSpace($indent + 4) . $category['name'];
            $childs = $this->categoryChildOptions($category['id'], $indent + 4);
            $result = $result + $childs;
        }
        return $result;
    }

    /**
     * @param string $search_query Query string
     * @return array 
     */
    function categoryRowsTable($search_query = "") {
        $result = array();
        $where = array();
        if ($search_query == "") {
            $where = array(
                'taxonomy' => 'post',
                'parent' => 0,
                    //'lang_code' => Language::$lang_content,
            );
        } else {
            $where = "taxonomy = 'post' AND parent = 0 AND "
                    . "(name LIKE '%$search_query%' OR slug LIKE '%$search_query%' OR "
                    . "description LIKE '%$search_query%')";
        }
        $categories = $this->DB()->select(TABLE_PREFIX . "categories", "*", $where, "displayorder");
        foreach ($categories as $category) {
            $result[] = $category;
            $childs = $this->categoryChildRowsTable($category['id'], 0, $search_query);
            foreach ($childs as $child) {
                $result[] = $child;
            }
        }
        return $result;
    }

    /**
     * 
     * @param int $parent Category parent
     * @param string $search_query Query string
     * @return array 
     */
    function categoryChildRowsTable($parent, $indent = 0, $search_query = "") {
        $result = array();
        $where = array();
        if ($search_query == "") {
            $where = array(
                'taxonomy' => 'post',
                'parent' => intval($parent),
                    //'lang_code' => Language::$lang_content,
            );
        } else {
            $where = "taxonomy = 'post' AND parent = $parent AND "
                    . "(name LIKE '%$search_query%' OR slug LIKE '%$search_query%' OR "
                    . "description LIKE '%$search_query%')";
        }
        $categories = $this->DB()->select(TABLE_PREFIX . "categories", "*", $where, "displayorder");
        foreach ($categories as $category) {
            $category['name'] = Utils::indentDash($indent + 2) . " " . $category['name'];
            $result[] = $category;
            $childs = $this->categoryChildRowsTable($category['id'], $indent + 2, $search_query);
            foreach ($childs as $child) {
                $result[] = $child;
            }
        }
        return $result;
    }

}
