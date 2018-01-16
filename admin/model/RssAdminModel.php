<?php

class RssAdminModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function all() {
        return $this->DB()->select(TABLE_PREFIX . "rss", "*");
    }

    function create($data) {
        return $this->DB()->insert(TABLE_PREFIX . "rss", $data);
    }

    function update($data, $where) {
        $this->DB()->update(TABLE_PREFIX . "rss", $data, $where);
    }

    function delete($id) {
        return $this->DB()->delete(TABLE_PREFIX . 'rss', "id=" . $id);
    }

    function deleteBulk($where) {
        return $this->DB()->delete(TABLE_PREFIX . 'rss', $where);
    }

    function getRssByID($id) {
        $result = $this->DB()->select(TABLE_PREFIX . "rss", "*", array(
            'id' => $id,
        ));
        if (!empty($result))
            return $result[0];
        return array();
    }

    public function countRss($where = array()) {
        $result = $this->DB()->select(TABLE_PREFIX . "rss", "COUNT(id) AS total", $where);
        return $result[0]['total'];
    }

    function getRss($start, $limit, $where = "") {
        try {
            $db = $this->DB();
            if (!empty($where)) {
                $where = "WHERE " . $db->where($where);
            }
            $sql = "SELECT * FROM " . TABLE_PREFIX . "rss $where ORDER BY id DESC LIMIT $start, $limit";
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
    
    function getRssByDay($start, $limit, $where = "", $orderby = "", $order = "") {
        try {
            $db = $this->DB();
            if (!empty($where)) {
                $where = "WHERE " . $db->where($where);
            }
            $day1 = date('Y-m-d H:i:s', strtotime("-1 day"));
            $day2 = date('Y-m-d H:i:s', strtotime("-2 day"));
            $day7 = date('Y-m-d H:i:s', strtotime("-7 day"));
            $day30 = date('Y-m-d H:i:s', strtotime("-30 day"));
            $curDate = date('Y-m-d H:i:s');
            $sql = "SELECT R.*, 
                (SELECT COUNT(P.id) FROM " . TABLE_PREFIX . "posts P WHERE P.rss_id = R.id AND P.posted_date BETWEEN '{$day1}' AND '$curDate') as 1day, 
                (SELECT COUNT(P.id) FROM " . TABLE_PREFIX . "posts P WHERE P.rss_id = R.id AND P.posted_date BETWEEN '{$day2}' AND '$curDate') as 2day, 
                (SELECT COUNT(P.id) FROM " . TABLE_PREFIX . "posts P WHERE P.rss_id = R.id AND P.posted_date BETWEEN '{$day7}' AND '$curDate') as 7day, 
                (SELECT COUNT(P.id) FROM " . TABLE_PREFIX . "posts P WHERE P.rss_id = R.id AND P.posted_date BETWEEN '{$day30}' AND '$curDate') as 30day  
                FROM " . TABLE_PREFIX . "rss R $where ";
            if(empty($orderby)){
                $sql .= " ORDER BY R.id ";
            } else {
                $sql .= " ORDER BY $orderby ";
            }
            if(empty($order)){
                $sql .= " DESC ";
            } else {
                $sql .= " $order ";
            }
            $sql .= " LIMIT $start, $limit";
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

    function getRssLive() {
        return $this->DB()->select(TABLE_PREFIX . "rss", "*", array(
                    'status' => 0,
        ));
    }

    function countRssPosts($time, $rss_id) {
        $date = date('Y-m-d H:i:s', strtotime("-$time day"));
        $curDate = date('Y-m-d H:i:s');
        $where = "rss_id = $rss_id AND posted_date BETWEEN '{$date}' AND '$curDate'";
        $posts = $this->DB()->select(TABLE_PREFIX . "posts", "COUNT(id) AS total", $where);
        return $posts[0]['total'];
    }
}
