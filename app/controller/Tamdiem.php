<?php

class Tamdiem extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        $memcache = $this->Memcache();
        
        $request = $this->getRequest();
        $page = $request->get('page');
        $page = (intval($page) <= 0) ? 1 : intval($page);
        $cache_key = CACHE_PREFIX . 'tamdiem_' . $page;
        $posts_cached = $memcache->get($cache_key);
        if(!$posts_cached){
            $limit = Registry::$settings['config']['limit_posts_tamdiem'];
            $start = ($page - 1) * $limit;
            $posts = $this->model->getPosts($start, $limit);
            $memcache->set($cache_key, $posts, FALSE, time() + 60*10); // 15 phut
            $posts_cached = $memcache->get($cache_key);
        }
        
        // Tin quan tam
        $cache_key2 = CACHE_PREFIX . "tam_diem_suggest";
        $tamdiem_suggest_cached = $memcache->get($cache_key2);
        if(!$tamdiem_suggest_cached){
            $welcomeModel = new WelcomeModel();
            $tamdiem_suggest = $welcomeModel->getTinTamDiemSuggest(15);
            $memcache->set($cache_key2, $tamdiem_suggest, FALSE, time() + 60*60*12); // nua ngay
            $tamdiem_suggest_cached = $memcache->get($cache_key2);
        }

        $this->render('tamdiem.tpl', array(
            'title' => "Tin Tâm Điểm - Người Đưa Tin .Net",
            'prev' => ($page <= 1) ? 1 : $page - 1,
            'next' => $page + 1,
            'posts' => $posts_cached,
            'tamdiem_suggest' => $tamdiem_suggest_cached,
        ));
    }

}
