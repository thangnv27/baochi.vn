<?php

class ReportAdminModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function delete($id) {
        return $this->DB()->delete(TABLE_PREFIX . 'report_links', "id=" . $id);
    }

    function deleteBulk($where) {
        return $this->DB()->delete(TABLE_PREFIX . 'report_links', $where);
    }

    public function countReport() {
        $result = $this->DB()->select(TABLE_PREFIX . "report_links", "COUNT(id) AS total");
        return $result[0]['total'];
    }

    function getReport($start, $limit) {
        try {
            $db = $this->DB();
            $sql = "SELECT R.*, L.categories, L.link, L.title FROM " . TABLE_PREFIX . "report_links R 
                    JOIN " . TABLE_PREFIX . "links L ON L.id = R.link_id 
                    ORDER BY R.id DESC LIMIT $start, $limit";
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

    function getReportByID($id) {
        $result = $this->DB()->select(TABLE_PREFIX . "report_links", "*", array(
            'id' => $id,
        ));
        if (!empty($result))
            return $result[0];
        return array();
    }

    function getReportLink($link_id) {
        $fields = "SUM(broken) as broken, SUM(wrong_category) as wrong_category, SUM(sex) as sex, 
                SUM(low_quality) as low_quality, SUM(spam) as spam, SUM(adv) as adv, 
                (SUM(broken) + SUM(wrong_category) + SUM(sex) + SUM(low_quality) + SUM(spam) + SUM(adv)) as total";
        return $this->DB()->select(TABLE_PREFIX . "report_links", $fields, array(
                    'link_id' => $link_id,
        ));
    }

}
