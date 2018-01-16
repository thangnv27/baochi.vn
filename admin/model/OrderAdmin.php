<?php

class OrderAdminModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function cancel($id) {
        $this->DB()->update(TABLE_PREFIX . "orders", array(
            'status' => 3,
                ), array(
            'id' => $id
        ));
    }

    function deleteBulk($where) {
        return $this->DB()->delete(TABLE_PREFIX . 'orders', $where);
    }

    function update($data, $where) {
        $this->DB()->update(TABLE_PREFIX . "orders", $data, $where);
    }

    function getOrderByID($id) {
        $order = $this->DB()->select(TABLE_PREFIX . "orders", "*", array(
            'id' => $id,
        ));
        return $order;
    }

    function countOrders($where = array()) {
        $posts = $this->DB()->select(TABLE_PREFIX . "orders", "COUNT(id) AS total", $where);
        return $posts[0]['total'];
    }

    /**
     * @param string $where
     * @return array 
     */
    function orderRowsTable($start, $limit, $where = "") {
        try {
            $db = $this->DB();
            $sql = "SELECT O.*,U.username,UM.first_name,UM.last_name FROM " . TABLE_PREFIX . "orders O "
                    . "LEFT JOIN " . TABLE_PREFIX . "users U ON U.id = O.customer_id "
                    . "LEFT JOIN " . TABLE_PREFIX . "usermeta UM ON UM.user_id = U.id";
            if (!empty($where)) {
                $sql .= " WHERE " . $where;
            }
            $sql .= " ORDER BY O.id DESC LIMIT $start, $limit";

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
