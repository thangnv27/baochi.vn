<?php

class Category extends Controller {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = User::getUserLoggedIn();
    }

    function index($slug) {
        $memcache = $this->Memcache();

        $wcModel = new WelcomeModel();
        $postMD = new PostModel();

        $request = $this->getRequest();

        $cat = $this->model->getCategoryBySlug($slug);

        // Pagination
        $currentURL = trailingslashit($request->getCurrentRquestUrl());
        if (count($request->all()) > 0) {
            $currentURL = $request->getCurrentRquestUrl();
        }
        $limit = 21;
       
        
        $page = $request->get('page');
        $page = (intval($page) <= 0) ? 1 : intval($page);
        
         if ($page == "") {
            $page_title = $cat['name'];
        } else{
            $page_title = $cat['name'] .' - Trang '.$page;
        }

        $pager = new Pagenavi($currentURL, $page, $limit);
        $start = $pager->start($limit);
        $countRecords = $postMD->countPosts('', $cat['id']);


        $page_list = $pager->pageList($countRecords);


        $cached_key = CACHE_PREFIX . 'category_' . $cat['id'] . '_' . $page;
        $posts_cached = $memcache->get($cached_key);
        if (!$posts_cached) {
            $posts = $wcModel->getPostsByCatSlug($start, $limit, $slug);
            $memcache->set($cached_key, $posts, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $posts_cached = $memcache->get($cached_key);
        }

        //Tin xem nhieu
        $xemnhieucat_cached = $memcache->get(CACHE_PREFIX . 'xemnhieucat');
        if (!$xemnhieucat_cached) {
            $xemnhieucat = $wcModel->getHotPosts(0, 5);
            $memcache->set(CACHE_PREFIX . 'xemnhieucat', $xemnhieucat, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $xemnhieucat_cached = $memcache->get(CACHE_PREFIX . 'xemnhieucat');
        }

//        source list
        $sourceMD = new SourceModel();
        $source_cached = $memcache->get(CACHE_PREFIX . 'source_'.$cat['id']);
        if (!$source_cached) {
            $source = $sourceMD->getSourceByCat($cat['id']);
            $memcache->set(CACHE_PREFIX . 'source_'.$cat['id'], $source, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $source_cached = $memcache->get(CACHE_PREFIX . 'source_'.$cat['id']);
        }
        
        $this->render('category.tpl', array(
            'title' => $page_title,
            'posts' => $posts_cached,
            'pagelist' => $page_list,
            'cat' => $cat,
            'xemnhieu' => $xemnhieucat_cached,
            'sources' => $source_cached,
        ));
    }

}
