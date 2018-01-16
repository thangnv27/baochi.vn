<?php

class Link extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index($slug) {
        $memcache = $this->Memcache();
        $cache_key = CACHE_PREFIX . 'link_' . $slug;
        $link = $memcache->get($cache_key);
        if(!$link){
            $_link = $this->model->getLinkBySlug($slug);
            $memcache->set($cache_key, $_link, FALSE, time() + 60*60*24); // 1 ngay
            $link = $memcache->get($cache_key);
        }
        $this->model->updateViewCount($link);
        $urlDecode = urldecode($link['link']);
        $url = parse_url($urlDecode);
        if (empty($url['scheme']))
            $urlDecode = "http://" . $urlDecode;
        $this->redirect($urlDecode);
    }

}
