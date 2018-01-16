<?php

class LinkModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function getLinkByID($id) {
        $result = $this->DB()->select(TABLE_PREFIX . "links", "*", array(
            'id' => $id,
        ));
        if (!empty($result))
            return $result[0];
        return array();
    }

    function getLinkBySlug($slug) {
        $result = $this->DB()->select(TABLE_PREFIX . "links", "*", array(
            'slug' => $slug,
        ));
        if (!empty($result))
            return $result[0];
        return array();
    }

    function updateViewCount($link) {
        $view = intval($link['view_count']) + 1;
        $this->DB()->update(TABLE_PREFIX . "links", array('view_count' => $view), array('id' => $link['id']));
    }

    function updateReportCount($link) {
        $count = intval($link['report_count']) + 1;
        $this->DB()->update(TABLE_PREFIX . "links", array('report_count' => $count), array('id' => $link['id']));
    }
}
