<?php

class Mobile extends Controller {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = User::getUserLoggedIn();
    }

    function index() {
        $request = $this->getRequest();
        $page = $request->get('page');
        $page = (intval($page) <= 0) ? 1 : intval($page);
        
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
        
        // Tin tam diem
        $cache_key = CACHE_PREFIX . 'tamdiem_' . $page;
        $posts_cached = $memcache->get($cache_key);
        if(!$posts_cached){
            $limit = Registry::$settings['config']['limit_posts_tamdiem'];
            $start = ($page - 1) * $limit;
            $tamdiemModel = new TamdiemModel();
            $posts = $tamdiemModel->getPosts($start, $limit);
            $memcache->set($cache_key, $posts, FALSE, time() + 60*10); // 15 phut
            $posts_cached = $memcache->get($cache_key);
        }
        
        $this->render('index.tpl', array(
            'title' => $option->site_option->name,
            'prev' => ($page <= 1) ? 1 : $page - 1,
            'next' => $page + 1,
            'posts' => $posts_cached,
        ));
    }
    
    function webhay() {
        
        $this->render('webhay.tpl', array(
            'title' => "Danh sách web hay",
        ));
    }
    
    function webhayByID($cat_ID) {
        $memcache = $this->Memcache();
        $cache_key = CACHE_PREFIX . 'mobile_webhay_catID_' . $cat_ID;
        $html_cached = $memcache->get($cache_key);
        if(!$html_cached){
            $siteurl = Registry::$siteurl;
            $model = new WelcomeModel();
            $webhay = $model->getWebHayByCategory($cat_ID);
            $html = "";
            foreach ($webhay as $cat) {
                $html .= <<<HTML
                    <li><a style="display: none;" class="cat-title-sub ui-btn ui-btn-text"></a>
                        <ul class="link-cat-sub">
HTML;
                foreach ($cat['links'] as $link):
                    $html .= <<<HTML
                            <li class="link-item">
                                <span class="favicon16" onclick="addFavoriteLink({$link['id']});"><img width="16" height="16" title="" src="{$link['thumbnail']}"></span>
                                <a target="_blank" class="link-item-a" href="{$siteurl}/link/{$link['slug']}/">
                                <span>{$link['title']}</span>
                                </a>
                            </li>
HTML;
                endforeach;
                $html .= '</ul></li>';
                if ($cat['childs'] != NULL) {
                    foreach ($cat['childs'] as $child):
                        $html .= <<<HTML
                        <li><a class="cat-title-sub">{$child['cat_name']}</a>
                        <ul class="link-cat-sub">
HTML;
                        foreach ($child['links'] as $link):
                            $html .= <<<HTML
                                <li class="link-item">
                                    <span class="favicon16" onclick="addFavoriteLink({$link['id']});"><img width="16" height="16" title="" src="{$link['thumbnail']}"></span>
                                    <a target="_blank" class="link-item-a" href="{$siteurl}/link/{$link['slug']}/">
                                    <span>{$link['title']}</span>
                                    </a>
                                </li>
HTML;
                        endforeach;
                        $html .= '</ul></li>';
                    endforeach;
                }
            }
            
            $memcache->set($cache_key, $html, FALSE, time() + 60*15); // 15 phut
            $html_cached = $memcache->get($cache_key);
        }
        
        echo $html_cached;
    }

}
