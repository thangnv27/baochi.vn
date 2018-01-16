<?php

class Post extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index($slug) {
        $permalink = get_permalink($slug, 'post');
        $slug = explode("-", $slug);
        $rss_id = $slug[0];
        unset($slug[0]);
        $slug = implode("-", $slug);

        $memcache = $this->Memcache();
        $cache_key = CACHE_PREFIX . 'post_' . $slug;
        $post = $memcache->get($cache_key);
        if(!$post){
            $_post = $this->model->getPostBySlug($slug);
            $memcache->set($cache_key, $_post, FALSE, time() + 60*60*24); // 1 ngay
            $post = $memcache->get($cache_key);
        }
        $this->model->updateViewCount($post);

        if ( (!empty($post['link']))
                or in_array($post['source'], array(121, 134))) {
            if(trailingslashit($post['link']) != $permalink){
                $this->redirect($post['link']);
            }
        }
        
                //Tin xem nhieu
        $xemnhieucat_cached = $memcache->get(CACHE_PREFIX . 'xemnhieucat');
        if (!$xemnhieucat_cached) {
            $xemnhieucat = $wcModel->getHotPosts(0, 5);
            $memcache->set(CACHE_PREFIX . 'xemnhieucat', $xemnhieucat, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $xemnhieucat_cached = $memcache->get(CACHE_PREFIX . 'xemnhieucat');
        }
        
        // Tin lien quan / Tin da dang
        //GET 6 Tin co ngay lon hon ngay cua tin dang doc
        $ortherPost_key = CACHE_PREFIX . 'otherpost_' . $post['id'];
        $ortherPost = $memcache->get($ortherPost_key);
        if(!$ortherPost){
            $_ortherPost = $this->model->getRelatedPosts($post, 6);
            $memcache->set($ortherPost_key, $_ortherPost, FALSE, time() + 60*10); // 10 phut
            $ortherPost = $memcache->get($ortherPost_key);
        }
        
        // Tin cung chuyen muc
        $related_key = CACHE_PREFIX . 'relatedpost_' . $post['id'];
        $relatedPost = $memcache->get($related_key);
        if(!$relatedPost){
            $_relatedPost = $this->model->getRelatedPosts2($post, 6);
            $memcache->set($related_key, $_relatedPost, FALSE, time() + 60*10); // 10 phut
            $relatedPost = $memcache->get($related_key);
        }
        
        $this->render('post.tpl', array(
            'title' => $post['title'],
            'post' => $post,
            'link' => $permalink,
            'post_link' => $post['link'],
            'xemnhieu' => $xemnhieucat_cached,
            'post_id' => $post['id'],
        ));
    }
    
}
