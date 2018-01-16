<?php

class Details extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $request = $this->getRequest();
        $id = intval($request->get('id'));
        $link_model = new LinkModel();
        $link = $link_model->getLinkByID($id);
        $this->render('link_details.tpl', array(
            'title' => "Chi tiết " . $link['title'],
            'link' => $link
        ));
    }

    function mydetails() {
        $request = $this->getRequest();
        $id = intval($request->get('id'));
        $link_model = new LinkModel();
        $link = $link_model->getLinkByID($id);
        $this->render('myweb_details.tpl', array(
            'title' => "Chi tiết " . $link['title'],
            'link' => $link
        ));
    }

}
