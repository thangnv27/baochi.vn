<?php

class IE7 extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {

        // Site option
        $option = file_get_contents(DB_PATH . 'options.json');
        $option = json_decode($option);
        $option->site_option->footer_info = stripslashes($option->site_option->footer_info);

//        $wcmodel = new WelcomeModel();
//        $webhay = $wcmodel->getWebHay();
////        Debug::preTag($webhay);
        $webhay = file_get_contents(TMP_PATH . "ie7.html");
        $this->render('ie7.tpl', array(
            'title' => $option->site_option->name,
            'webhay' => $webhay
        ));
    }

}
