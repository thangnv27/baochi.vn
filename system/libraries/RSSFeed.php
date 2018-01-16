<?php

class RSSFeed {

    var $channel_title;
    var $channel_link;
    var $channel_description;
    var $channel_language;
    var $channel_lastBuildDate;
    var $channel_generator;
    var $channel_ttl;
    var $channel_copyright;
    var $channel_email;
    var $channel_id;
    var $image_url;
    var $image_title;
    var $image_link;

    // constructor
    function RSSFeed() {
        $this->nritems = 0;
        $this->channel_title = '';
        $this->channel_link = '';
        $this->channel_description = '';
        $this->channel_language = '';
        $this->channel_lastBuildDate = '';
        $this->channel_generator = '';
        $this->channel_ttl = '';
        $this->channel_copyright = '';
        $this->channel_email = '';
        $this->channel_id = '';
        $this->image_url = '';
        $this->image_title = '';
        $this->image_link = '';
    }

    // set channel vars
    function SetChannel($title, $link, $description, $language, $lastBuildDate, $generator, $copyright, $ttl, $email, $id) {
        $this->channel_title = $title;
        $this->channel_link = $link;
        $this->channel_description = $description;
        $this->channel_language = $language;
        $this->channel_lastBuildDate = $lastBuildDate;
        $this->channel_generator = $generator;
        $this->channel_copyright = $copyright;
        $this->channel_ttl = $ttl;
        $this->channel_email = $email;
        $this->channel_id = $id;
    }

    // set image
    function SetImage($url, $title, $link) {
        $this->image_url = $url;
        $this->image_title = $title;
        $this->image_link = $link;
    }

    // set item
    function SetItem($title, $link, $pubDate, $description, $content_encoded, $category, $domain, $creator, $guid) {
        $item = array();
        $item['title'] = $title;
        $item['link'] = $link;
        $item['pubDate'] = $pubDate;
        $item['description'] = $description;
        $item['content_encoded'] = $content_encoded;
        $item['category'] = $category;
        $item['domain'] = $domain;
        $item['creator'] = $creator;
        $item['guid'] = $guid;
        return $item;
    }

    /**
     * RSS 0.91 feed generation
     * @param array $items News list
     * @return string xml format
     */
    function GenerateRSS($items) {
        $output = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
        $output .= "<!DOCTYPE rss PUBLIC \"-//RSS Advisory Board//DTD RSS 0.91//EN\" \"http://www.rssboard.org/rss-0.91.dtd\">";
        $output .= "<rss version=\"0.91\">";
        $output .= "<channel>";
        $output .= "<title>" . htmlspecialchars($this->channel_title) . "</title>";
        $output .= "<link>" . htmlspecialchars($this->channel_link) . "</link>";
        $output .= "<description>" . htmlspecialchars($this->channel_description) . "</description>";
        $output .= "<language>" . $this->channel_language . "</language>";
        $output .= "<image>";
        $output .= "<url>" . htmlspecialchars($this->image_url) . "</url>";
        $output .= "<title>" . htmlspecialchars($this->image_title) . "</title>";
        $output .= "<link>" . htmlspecialchars($this->image_link) . "</link>";
        $output .= "</image>";
        foreach ($items as $key => $value) {
            $output .= "<item>";
            $output .= "<title>" . htmlspecialchars($value['title']) . "</title>";
            $output .= "<link>" . htmlspecialchars($value['link']) . "</link>";
            $output .= "<description><![CDATA[" . htmlspecialchars($value['description']) . "]]></description>";
            $output .= "</item>";
        }
        $output .= "</channel>";
        $output .= "</rss>";
        return $output;
    }

    /**
     * RSS 2.0 feed generation
     * @param array $items News list
     * @return string xml format
     */
    function GenerateRSS2($items) {
        $output = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
        $output .= "<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\" xmlns:content=\"http://purl.org/rss/1.0/modules/content/\">";
        $output .= "<channel>";
        $output .= "<title>" . htmlspecialchars($this->channel_title) . "</title>";
        $output .= "<link>" . htmlspecialchars($this->channel_link) . "</link>";
        $output .= "<description>" . htmlspecialchars($this->channel_description) . "</description>";
        $output .= "<language>" . $this->channel_language . "</language>";
        $output .= "<lastBuildDate>" . htmlspecialchars($this->channel_lastBuildDate) . "</lastBuildDate>";
        $output .= "<generator>" . $this->channel_generator . "</generator>";
        $output .= "<copyright>" . htmlspecialchars($this->channel_copyright) . "</copyright>";
        $output .= "<ttl>" . $this->channel_ttl . "</ttl>";
        $output .= "<image>";
        $output .= "<url>" . htmlspecialchars($this->image_url) . "</url>";
        $output .= "<title>" . htmlspecialchars($this->image_title) . "</title>";
        $output .= "<link>" . htmlspecialchars($this->image_link) . "</link>";
        $output .= "</image>";
        foreach ($items as $key => $value) {
            $output .= "<item>";
            $output .= "<title>" . htmlspecialchars($value['title']) . "</title>";
            $output .= "<link>" . htmlspecialchars($value['link']) . "</link>";
            $output .= "<pubDate>" . $value['pubDate'] . "</pubDate>";
            //$output .= "<description><![CDATA[" . htmlspecialchars($value['description']) . "]]></description>";
            $output .= "<description><![CDATA[" . $value['description'] . "]]></description>";
            $output .= "<content:encoded><![CDATA[" . htmlspecialchars($value['content_encoded']) . "]]></content:encoded>";
            $output .= "<category domain=\"" . htmlspecialchars($value['domain']) . "\">" . htmlspecialchars($value['category']) . "</category>";
            $output .= "<dc:creator>" . $value['creator'] . "</dc:creator>";
            $output .= "<guid isPermaLink=\"true\">" . htmlspecialchars($value['guid']) . "</guid>";
            $output .= "</item>";
        }
        $output .= "</channel>";
        $output .= "</rss>";
        return $output;
    }
    
    /**
     * RSS 2.0 feed like VNExpress generation
     * @param array $items News list
     * @return string xml format
     */
    function GenerateRSS2_VnExpress($items) {
        $channel_title = htmlspecialchars($this->channel_title);
        $channel_description = htmlspecialchars($this->channel_description);
        $output = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:slash="http://purl.org/rss/1.0/modules/slash/">
  <channel>
    <title>{$channel_title}</title>
    <description>{$channel_description}</description>
    <pubDate>{$this->channel_lastBuildDate}</pubDate>
    <generator>{$this->channel_generator}</generator>
    <link>{$this->channel_link}</link>
    <image>
      <url>{$this->image_url}</url>
      <title>{$this->image_title}</title>
      <link>{$this->image_link}</link>
    </image>\n
XML;
        foreach ($items as $value) {
            $title = htmlspecialchars($value['title']);
            $output .= <<<XML
    <item>
      <title>{$title}</title>
      <description><![CDATA[{$value['description']}]]></description>
      <pubDate>{$value['pubDate']}</pubDate>
      <link>{$value['link']}</link>
      <guid>{$value['link']}</guid>
      <slash:comments>0</slash:comments>
    </item>\n
XML;
        }
        $output .= <<<XML
  </channel>
</rss>
XML;
        return $output;
    }

    /**
     * Atom feed generation
     * @param array $items News list
     * @return string xml format
     */
    function GenerateAtom($items) {
        $output = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
        $output .= "<feed xml:lang=\"" . $this->channel_language . "\" xmlns=\"http://www.w3.org/2005/Atom\">";
        $output .= "<title>" . htmlspecialchars($this->channel_title) . "</title>";
        $output .= "<subtitle>" . htmlspecialchars($this->channel_description) . "</subtitle>";
        $output .= "<link href=\"" . htmlspecialchars($this->channel_link) . "\"/>";
        $output .= "<updated>" . $this->channel_lastBuildDate . "</updated>";
        $output .= "<author>";
        $output .= "<name>" . $this->channel_generator . "</name>";
        $output .= "<email>" . htmlspecialchars($this->channel_email) . "</email>";
        $output .= "</author>";
        $output .= "<id>" . $this->channel_id . "</id>";
        foreach ($items as $key => $value) {
            $output .= "<entry>";
            $output .= "<title>" . htmlspecialchars($value['title']) . "</title>";
            $output .= "<link type=\"text/html\" href=\"" . htmlspecialchars($value['link']) . "\"/>";
            $output .= "<id>tag:" . htmlspecialchars($value['category']) . ",2012:" . htmlspecialchars($value['domain']) . "</id>";
            $output .= "<updated>" . $value['pubDate'] . "</updated>";
            $output .= "<author>";
            $output .= "<name>" . $value['creator'] . "</name>";
            $output .= "</author>";
            $output .= "<summary><![CDATA[" . htmlspecialchars($value['description']) . "]]></summary>";
            $output .= "</entry>";
        }
        $output .= "</feed>";
        return $output;
    }

}
