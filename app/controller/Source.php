<?php

class Source extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index($slug) {
        $memcache = $this->Memcache();
        $wcModel = new WelcomeModel();
        $request = $this->getRequest();

        if (empty($slug)) {
            $sources_cached = $memcache->get(CACHE_PREFIX . 'sourceall');
            if (!$sources_cached) {
                $sources = $wcModel->allSources();
                $memcache->set(CACHE_PREFIX . 'sourceall', $sources, FALSE, time() + 60 * 60 * 1); // 1 tieng
                $sources_cached = $memcache->get(CACHE_PREFIX . 'sourceall');
            }
            $count = $this->model->getCountSource();

            $this->render('source_all.tpl', array(
                'title' => "Danh sách nguồn tin",
                'sources' => $sources_cached,
                'count' => $count,
            ));
        } else {

            $postMD = new PostModel();
            $source = $this->model->getSourceBySlug($slug);

            // Pagination
            $currentURL = trailingslashit($request->getCurrentRquestUrl());
            if (count($request->all()) > 0) {
                $currentURL = $request->getCurrentRquestUrl();
            }
            $limit = 21;
            $pager = new Pagenavi($currentURL, $request->get('page'), $limit);
            $start = $pager->start($limit);
            $countRecords = $wcModel->getCountPost($source['id']);
            
            $page_list = $pager->pageList($countRecords);
            $cached_key = CACHE_PREFIX . 'source_' . $source['id'] . '_' . $request->get('page');
            $posts_cached = $memcache->get($cached_key);
            if (!$posts_cached) {
                $posts = $wcModel->getPostsBySource($start, $limit, $source['id']);
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
            
            $this->render('source.tpl', array(
                'title' => $source['name'],
                'posts' => $posts_cached,
                'pagelist' => $page_list,
                'source' => $source,
                'xemnhieu' => $xemnhieucat_cached,
            ));
        }
    }

}
