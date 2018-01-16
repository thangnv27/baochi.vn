<?php

class Welcome extends Controller {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = User::getUserLoggedIn();
    }

    function index() {
        $memcache = $this->Memcache();
//        Tin noi bat slider
        $posts_slider_cached = $memcache->get(CACHE_PREFIX . 'posts_slider');
        if (!$posts_slider_cached) {
            $posts_slider = $this->model->getPostSlider(0,10);
            $memcache->set(CACHE_PREFIX . 'posts_slider', $posts_slider, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $posts_slider_cached = $memcache->get(CACHE_PREFIX . 'posts_slider');
        }
        
//        $posts_slider_sub_cached = $memcache->get(CACHE_PREFIX . 'posts_slider_sub');
//        if (!$posts_slider_sub_cached) {
//             $posts_slider_sub = $this->model->getPostSlider(10,4);
//            $memcache->set(CACHE_PREFIX . 'posts_slider_sub', $posts_slider_sub, FALSE, time() + 60 * 60 * 1); // 1 tieng
//            $posts_slider_sub_cached = $memcache->get(CACHE_PREFIX . 'posts_slider_sub');
//        }
       
        
//        Xa Hoi
        $xahoi_cached = $memcache->get(CACHE_PREFIX . 'xahoi');
        if (!$xahoi_cached) {
            $xahoi = $this->model->getPostsByCatSlug(0, 7, "xa-hoi");
            $memcache->set(CACHE_PREFIX . 'xahoi', $xahoi, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $xahoi_cached = $memcache->get(CACHE_PREFIX . 'xahoi');
        }
        $xahoicat_cached = $memcache->get(CACHE_PREFIX . 'xahoicat');
        if (!$xahoicat_cached) {
            $xahoiCat = $this->model->getAllCatCategoryBySlug("xa-hoi");
            $memcache->set(CACHE_PREFIX . 'xahoicat', $xahoiCat, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $xahoicat_cached = $memcache->get(CACHE_PREFIX . 'xahoicat');
        }


        //Giai tri
        if (!$giaitri_cached) {
            $giaitri = $this->model->getPostsByCatSlug(0, 4, "giai-tri");
            $memcache->set(CACHE_PREFIX . 'giaitri', $giaitri, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $giaitri_cached = $memcache->get(CACHE_PREFIX . 'giaitri');
        }
        $giaitricat_cached = $memcache->get(CACHE_PREFIX . 'giaitricat');
        if (!$giaitricat_cached) {
            $giaitriCat = $this->model->getAllCatCategoryBySlug("giai-tri");
            $memcache->set(CACHE_PREFIX . 'giaitricat', $giaitriCat, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $giaitricat_cached = $memcache->get(CACHE_PREFIX . 'giaitricat');
        }

//        Kinh Te
        if (!$kinhte_cached) {
            $kinhte = $this->model->getPostsByCatSlug(0, 7, "kinh-te");
            $memcache->set(CACHE_PREFIX . 'kinhte', $kinhte, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $kinhte_cached = $memcache->get(CACHE_PREFIX . 'kinhte');
        }
        $kinhtecat_cached = $memcache->get(CACHE_PREFIX . 'kinhtecat');
        if (!$kinhtecat_cached) {
            $kinhteCat = $this->model->getAllCatCategoryBySlug("kinh-te");
            $memcache->set(CACHE_PREFIX . 'kinhtecat', $kinhteCat, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $kinhtecat_cached = $memcache->get(CACHE_PREFIX . 'kinhtecat');
        }
//        The Thao
        if (!$thethao_cached) {
            $thethao = $this->model->getPostsByCatSlug(0, 7, "the-thao");
            $memcache->set(CACHE_PREFIX . 'thethao', $thethao, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $thethao_cached = $memcache->get(CACHE_PREFIX . 'thethao');
        }
        $thethaocat_cached = $memcache->get(CACHE_PREFIX . 'thethaocat');
        if (!$thethaocat_cached) {
            $thethaoCat = $this->model->getAllCatCategoryBySlug("the-thao");
            $memcache->set(CACHE_PREFIX . 'thethaocat', $thethaoCat, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $thethaocat_cached = $memcache->get(CACHE_PREFIX . 'thethaocat');
        }

//        Giao Duc
        if (!$giaoduc_cached) {
            $giaoduc = $this->model->getPostsByCatSlug(0, 3, "giao-duc");
            $memcache->set(CACHE_PREFIX . 'giaoduc', $giaoduc, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $giaoduc_cached = $memcache->get(CACHE_PREFIX . 'giaoduc');
        }
        $giaoduccat_cached = $memcache->get(CACHE_PREFIX . 'giaoduccat');
        if (!$giaoduccat_cached) {
            $giaoducCat = $this->model->getAllCatCategoryBySlug("giao-duc");
            $memcache->set(CACHE_PREFIX . 'giaoduccat', $giaoducCat, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $giaoduccat_cached = $memcache->get(CACHE_PREFIX . 'giaoduccat');
        }
        // tin moi
        $new_cached = $memcache->get(CACHE_PREFIX . 'newposts');
        if (!$new_cached) {
            $newposts = $this->model->getNewPosts(0, 4);
            $memcache->set(CACHE_PREFIX . 'newposts', $newposts, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $new_cached = $memcache->get(CACHE_PREFIX . 'newposts');
        }
        // Xem nhieu
        $hot_cached = $memcache->get(CACHE_PREFIX . 'hotposts');
        if (!$hot_cached) {
            $hotposts = $this->model->getHotPosts(0, 20);
            $memcache->set(CACHE_PREFIX . 'hotposts', $hotposts, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $hot_cached = $memcache->get(CACHE_PREFIX . 'hotposts');
        }


        // Site option
        $option_cached = $memcache->get(CACHE_PREFIX . 'options');
        if (!$option_cached) {
            $option = file_get_contents(DB_PATH . 'options.json');
            $memcache->set(CACHE_PREFIX . 'options', $option, FALSE, time() + 60 * 60 * 24); // 1 ngay
            $option_cached = $memcache->get(CACHE_PREFIX . 'options');
        }
        $option = json_decode($option_cached);
        $option->site_option->footer_info = stripslashes($option->site_option->footer_info);

//        Debug::preTag($hot_cached);

        $this->render('index.tpl', array(
            'title' => $option->site_option->name,
            'posts_slider' => $posts_slider_cached,
//            'posts_slider_sub' => $posts_slider_sub_cached,
            'newposts' => $new_cached,
            'hotposts' => $hot_cached,
            'xahoi' => $xahoi_cached,
            'kinhte' => $kinhte_cached,
            'thethao' => $thethao_cached,
            'giaitri' => $giaitri_cached,
            'giaoduc' => $giaoduc_cached,
            'xahoicat' => $xahoicat_cached,
            'kinhtecat' => $kinhtecat_cached,
            'giaoduccat' => $giaoduccat_cached,
            'thethaocat' => $thethaocat_cached,
            'giaitricat' => $giaitricat_cached,
        ));
    }

    function clear_memcached() {
        $memcache = $this->Memcache();
        $memcache->flush();
        echo "Done!";
    }

}
