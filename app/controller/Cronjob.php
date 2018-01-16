<?php

class Cronjob extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function generate_menu() {
        $menu = new MenuModel();
        $primary_menu = $menu->getNavigation('primary_menu');
        write_file(TMP_PATH . "menu.html", $primary_menu);
    }
    
    function generate_xml_sitemap() {
        $siteurl = Registry::$siteurl;
        $domain = Registry::$settings['config']['domain'];
        $limit = Registry::$settings['config']['limit_sitemap'];
        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<!-- created by {$domain} -->

<url>
  <loc>$siteurl/</loc>
</url>
XML;
        
        $rssModel = new RssModel();
        $posts = $rssModel->getPosts($limit);
        foreach ($posts as $post) {
            if($post['rss_id'] == null or $post['rss_id'] == ""){
                $post['rss_id'] = 0;
            }
            $date = makeISO8601TimeStamp($post['posted_date']);
            $xml .= <<<XML
\n<url>
  <loc>{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/</loc>
  <lastmod>{$date}</lastmod>
</url>
XML;
        }
        
        $xml .= "\n</urlset>";
        
        write_file(BASE_PATH . DS . "sitemap.xml", $xml);
    }
    
    function remove_tmp_file() {
        Debug::displayErrors("On");
        $dirname = TMP_PATH . 'tamdiem';
        if (file_exists($dirname)) {
            $files = glob("{$dirname}/*");
            if(is_array($files)){
                foreach ($files as $file) {
                    if (is_file($file)) {
                        @unlink($file);
                    }
                }
            }
        }
    }
}
