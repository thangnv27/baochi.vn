<?php

class SourceModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function getSourceByID($id) {
        $result = $this->DB()->select(TABLE_PREFIX . "categories", "*", "taxonomy='source' AND id=$id AND displayorder > 0");
        if (is_array($result) and count($result) > 0)
            return $result[0];

        return array();
    }
    function getSourceBySlug($slug) {
        $result = $this->DB()->select(TABLE_PREFIX . "categories", "*", "taxonomy='source' AND slug='$slug' AND displayorder > 0");
        if (is_array($result) and count($result) > 0)
            return $result[0];

        return array();
    }

    function getCountSource() {
        $result = $this->DB()->select(TABLE_PREFIX . "categories", "count(id)", "taxonomy='source' AND displayorder > 0");
        return $result[0]['count(id)'];
    }

    function getSourceByCat($catID) {
        $db = $this->DB();
        $sql = "SELECT DISTINCT P.source, C.* from posts P JOIN categories C ON P.source = C.id WHERE categories REGEXP '.*;s:[0-9]+:\"$catID\".*'";
        $stm = $db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    function getPosts($source_id, $start = 0, $limit = 10) {
        try {
            $db = $this->DB();
            $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND post_status = 'published' AND source = $source_id";
            $sql = "SELECT P.* FROM " . TABLE_PREFIX . "posts P $where ORDER BY P.posted_date DESC LIMIT $start, $limit";
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
