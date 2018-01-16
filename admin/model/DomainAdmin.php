<?php

class DomainAdminModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function all() {
        return $this->DB()->select(TABLE_PREFIX . "blacklist_domains", "*");
    }

    function create($data) {
        return $this->DB()->insert(TABLE_PREFIX . "blacklist_domains", $data);
    }

    function update($data, $where) {
        $this->DB()->update(TABLE_PREFIX . "blacklist_domains", $data, $where);
    }

    function delete($id) {
        return $this->DB()->delete(TABLE_PREFIX . 'blacklist_domains', "id=" . $id);
    }

    function deleteBulk($where) {
        return $this->DB()->delete(TABLE_PREFIX . 'blacklist_domains', $where);
    }

    function getBlacklistDomainsByID($id) {
        $result = $this->DB()->select(TABLE_PREFIX . "blacklist_domains", "*", array(
            'id' => $id,
        ));
        if (!empty($result))
            return $result[0];
        return array();
    }

    public function countBlacklistDomains($where = array()) {
        $result = $this->DB()->select(TABLE_PREFIX . "blacklist_domains", "COUNT(id) AS total", $where);
        return $result[0]['total'];
    }

    function getBlacklistDomains($start, $limit, $where = "") {
        try {
            $db = $this->DB();
            if (!empty($where)) {
                $where = "WHERE " . $db->where($where);
            }
            $sql = "SELECT * FROM " . TABLE_PREFIX . "blacklist_domains $where ORDER BY id DESC LIMIT $start, $limit";
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
