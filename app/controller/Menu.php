<?php

class Menu extends Controller {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = User::getUserLoggedIn();
    }

    function index() {
        $memcache = $this->Memcache();
        
        // Site option
        $option_cached = $memcache->get(CACHE_PREFIX . 'options');
        if(!$option_cached){
            $option = file_get_contents(DB_PATH . 'options.json');
            $memcache->set(CACHE_PREFIX . 'options', $option, FALSE, time() + 60*60*24); // 1 ngay
            $option_cached = $memcache->get(CACHE_PREFIX . 'options');
        }
        $option = json_decode($option_cached);
        $option->site_option->footer_info = stripslashes($option->site_option->footer_info);
        
        $this->render('menu.tpl', array(
            'title' => $option->site_option->name,
        ));
    }

}
