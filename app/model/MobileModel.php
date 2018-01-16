<?php

class MobileModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function categoryOptions($has_none = true) {
        $result = array();
        if ($has_none) {
            $result = array('0' => Language::$phrases['context']['none']);
        }
        $categories = $this->DB()->select(TABLE_PREFIX . "categories", "*", array(
            'taxonomy' => 'link',
            'parent' => 0,
                //'lang_code' => Language::$lang_content,
                ), "displayorder");
        foreach ($categories as $category) {
            $result[$category['id']] = stripslashes($category['name']);
        }
        return $result;
    }
    
    public function categoryNews($has_none = true) {
        $result = array();
        if ($has_none) {
            $result = array('0' => Language::$phrases['context']['none']);
        }
        $categories = $this->DB()->select(TABLE_PREFIX . "categories", "*", 
                "taxonomy='post' AND hidemobile=0 AND parent=0 AND displayorder <> 10101010", "displayorder");
        foreach ($categories as $category) {
            $result[$category['id']] = stripslashes($category['name']);
        }
        return $result;
    }

}
