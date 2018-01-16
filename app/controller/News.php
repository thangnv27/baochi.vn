<?php

class News extends Controller {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = User::getUserLoggedIn();
        
        Registry::$settings['theme_name'] = 'mobile';
        Registry::$settings['config']['front_controller'] = 'Mobile';
    }

    function index() {
        $request = $this->getRequest();
        $page = intval($request->get('page'));
        $page = ($page <= 0) ? 1 : $page;
        
        $memcache = $this->Memcache();
        $cache_key = CACHE_PREFIX . 'mobile_newnews_' . $page;
        $posts_cached = $memcache->get($cache_key);
        if(!$posts_cached){
            $limit = Registry::$settings['config']['limit_posts_mobile'];
            $start = ($page - 1) * $limit;
            $model = new WelcomeModel();
            $posts = $model->getNewPosts($start, $limit);
            $memcache->set($cache_key, $posts, FALSE, time() + 60*10); // 15 phut
            $posts_cached = $memcache->get($cache_key);
        }

        $this->render('news.tpl', array(
            'title' => 'Tin mới',
            'prev' => ($page <= 1) ? 1 : $page - 1,
            'next' => $page + 1,
            'posts' => $posts_cached,
        ));
    }

    function hot() {
        $request = $this->getRequest();
        $page = intval($request->get('page'));
        $page = ($page <= 0) ? 1 : $page;
        
        $memcache = $this->Memcache();
        $cache_key = CACHE_PREFIX . 'mobile_hotnews_' . $page;
        $posts_cached = $memcache->get($cache_key);
        if(!$posts_cached){
            $limit = Registry::$settings['config']['limit_posts_mobile'];
            $start = ($page - 1) * $limit;
            $model = new WelcomeModel();
            $posts = $model->getHotPosts($start, $limit);
            $memcache->set($cache_key, $posts, FALSE, time() + 60*10); // 15 phut
            $posts_cached = $memcache->get($cache_key);
        }

        $this->render('hot.tpl', array(
            'title' => 'Tin hot',
            'prev' => ($page <= 1) ? 1 : $page - 1,
            'next' => $page + 1,
            'posts' => $posts_cached,
        ));
    }

}
