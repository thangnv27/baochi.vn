<?php

class RssModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function getPosts($limit) {
        try {
            $db = $this->DB();
            $sql = "SELECT * FROM " . TABLE_PREFIX . "posts WHERE post_status='published' ORDER BY id DESC LIMIT $limit";
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
