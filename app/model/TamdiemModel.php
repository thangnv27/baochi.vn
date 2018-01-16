<?php

class TamdiemModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function getPosts($start = 0, $limit = 10) {
        try {
            $db = $this->DB();
            $where = "WHERE P.lang_code = '" . Language::$lang_content . "' AND post_status = 'published' AND source = 174";
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
