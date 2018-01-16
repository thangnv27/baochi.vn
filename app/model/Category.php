<?php

class CategoryModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function getCategoryBySlug($slug) {
        $result = $this->DB()->select(TABLE_PREFIX . "categories", "*", array(
            'slug' => $slug,
            'taxonomy' => 'post',
        ));
        if (!empty($result))
            return $result[0];
        return array();
    }

}
