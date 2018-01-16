<?php

class Rss extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $siteurl = Registry::$siteurl;
        $domain = Registry::$settings['config']['domain'];
        $limit = Registry::$settings['config']['limit_rss'];
        // Site option
        $option = file_get_contents(DB_PATH . 'options.json');
        $option = json_decode($option);
        
        $rssfeed = new RSSFeed();
        $rssfeed->SetChannel($option->site_option->name, 
                $siteurl . '/rss', 
                $option->site_option->description, 
                'vi-VN', 
                gmdate("D, d M Y H:i:s") . ' GMT', 
                $domain, 
                'Copyright © 2014 ' . $domain, 
                '1400', 
                $option->site_option->admin_email, 
                "tag:$domain,2014:" . $siteurl
        );
        $rssfeed->SetImage($siteurl . '/public/images/rss.png', "RSS", $siteurl);

        // each news add to array items
        $posts = $this->model->getPosts($limit);
        $items = array();
        foreach ($posts as $value) {
            if($value['rss_id'] == null or $value['rss_id'] == ""){
                $value['rss_id'] = 0;
            }
            $img = "";
            if(!empty($value['thumbnail'])){
                $img = '<img width=130 height=100 src="' . $value['thumbnail'] . '" ></a></br>';
            }
            $item = $rssfeed->SetItem(convertCharset(stripslashes($value['title']), 2), 
                    $siteurl . "/post/{$value['rss_id']}-" . $value['slug'], 
                    //($value['posted_date'] != "") ? gmdate('D, d M Y H:i:s', $value['posted_date']) . ' GMT' : gmdate('D, d M Y H:i:s') . ' GMT', 
                    date('D, d M Y H:i:s', strtotime($value['posted_date'])),
                    $img . Utils::get_short_content($value['content'], 400), 
                    strip_tags($value['content']), '', 
                    $domain,
                    "ADMIN",
                    $siteurl . "/post/{$value['rss_id']}-" . $value['slug']
            );
            array_push($items, $item);
        }

        header("Content-Type: text/xml; charset=UTF-8");
        echo $rssfeed->GenerateRSS2_VnExpress($items);
    }

}
