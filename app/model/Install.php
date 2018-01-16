<?php

class InstallModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function create() {
        $languages = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "languages`; 
                    CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "languages` (
                        `id`                bigint(20) NOT NULL AUTO_INCREMENT,
                        `english_name`      varchar(100) NOT NULL,
                        `code`              varchar(7) NOT NULL,
                        `iso`               varchar(8) NOT NULL,
                        `locale`            varchar(8) NOT NULL,
                        `active`            tinyint(4) NOT NULL,
                        `flag`              varchar(255),
                        PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $usergroups = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "usergroups`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "usergroups` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `role`          varchar(50) NOT NULL,
                    `name`          varchar(50) NOT NULL,
                    `capability`    longtext NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $users = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "users`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "users` (
                    `id`                bigint(20) NOT NULL AUTO_INCREMENT,
                    `user_referer`      varchar(50),
                    `username`          varchar(50) NOT NULL,
                    `email`             varchar(100) NOT NULL,
                    `password`          varchar(40) NOT NULL,
                    `salt`              varchar(30) NOT NULL,
                    `activation_key`    varchar(32),
                    `role`              varchar(50) NOT NULL,
                    `capability`        longtext NOT NULL,
                    `registered_date`   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `ip_address`        varchar(15),
                    `oauth_uid`         varchar(200),
                    `oauth_provider`    varchar(200),
                    `is_deleted`        tinyint(4) DEFAULT 0,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $usermeta = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "usermeta`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "usermeta` (
                    `meta_id`       bigint(20) NOT NULL AUTO_INCREMENT,
                    `user_id`       bigint(20) NOT NULL,
                    `first_name`    varchar(50) NOT NULL,
                    `last_name`     varchar(50) NOT NULL,
                    `address`       varchar(255),
                    `gender`        tinyint(4) NOT NULL DEFAULT 0,
                    `dob`           date,
                    `phone`         varchar(25),
                    `website`       varchar(255),
                    `avatar`        varchar(255),
                    `yahoo`         varchar(100),
                    `skype`         varchar(100),
                    `about`         varchar(500),
                    `updated_date`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`meta_id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $statistics_visitor = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "statistics_visitor`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "statistics_visitor` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `last_counter`  date NOT NULL,
                    `referred`      text NOT NULL,
                    `agent`         varchar(255) NOT NULL,
                    `platform`      varchar(255),
                    `version`       varchar(255),
                    `UAString`      varchar(255),
                    `ip`            varchar(15) NOT NULL,
                    `location`      varchar(15),
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $statistics_visit = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "statistics_visit`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "statistics_visit` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `last_visit`    datetime NOT NULL,
                    `last_counter`  date NOT NULL,
                    `visit`         bigint(20) NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $statistics_useronline = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "statistics_useronline`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "statistics_useronline` (
                    `id`        bigint(20) NOT NULL AUTO_INCREMENT,
                    `ip`        varchar(15) NOT NULL,
                    `timestamp` int(10) NOT NULL,
                    `date`      datetime NOT NULL,
                    `referred`  text NOT NULL,
                    `url`       text NOT NULL,
                    `agent`     varchar(255) NOT NULL,
                    `platform`  varchar(255),
                    `version`       varchar(255),
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $categories = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "categories`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "categories` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `lang_code`     varchar(7) NOT NULL,
                    `name`          varchar(100) NOT NULL,
                    `slug`          varchar(255) NOT NULL,
                    `parent`        bigint(20) NOT NULL DEFAULT 0,
                    `description`   varchar(500),
                    `image`         varchar(255),
                    `images`        longtext,
                    `taxonomy`      varchar(50) NOT NULL DEFAULT 'post' COMMENT 'post, product,...',
                    `seo`           longtext,
                    `displayorder`  bigint(20) NOT NULL DEFAULT 1,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $pages = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "pages`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "pages` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `lang_code`     varchar(7) NOT NULL,
                    `title`         varchar(100) NOT NULL,
                    `slug`          varchar(255) NOT NULL,
                    `excerpt`       varchar(500),
                    `content`       longtext NOT NULL,
                    `thumbnail`     varchar(255),
                    `seo`           longtext,
                    `view_count`    bigint(20) NOT NULL DEFAULT 0,
                    `post_status`   varchar(10) NOT NULL DEFAULT 'draft' COMMENT 'draft, published, trashed',
                    `posted_date`   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `updated_date`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $links = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "links`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "links` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `user_id`       bigint(20) NOT NULL,
                    `lang_code`     varchar(7) NOT NULL,
                    `categories`    longtext NOT NULL,
                    `title`         varchar(100) NOT NULL,
                    `slug`          varchar(255) NOT NULL,
                    `thumbnail`     varchar(255),
                    `link`          text,
                    `view_count`    bigint(20) NOT NULL DEFAULT 0,
                    `report_count`  int(11) NOT NULL DEFAULT 0,
                    `post_status`   varchar(20) NOT NULL DEFAULT 'draft' COMMENT 'draft, pending_approval, published, trashed',
                    `posted_date`   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `updated_date`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $posts = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "posts`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "posts` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `user_id`       bigint(20) NOT NULL,
                    `lang_code`     varchar(7) NOT NULL,
                    `categories`    longtext NOT NULL,
                    `source`        bigint(20),
                    `title`         varchar(100) NOT NULL,
                    `title_md5`     varchar(32) NOT NULL,
                    `slug`          varchar(255) NOT NULL,
                    `excerpt`       varchar(500),
                    `content`       longtext,
                    `thumbnail`     varchar(255),
                    `tags`          varchar(255),
                    `seo`           longtext,
                    `view_count`    bigint(20) NOT NULL DEFAULT 0,
                    `link`          text,
                    `rss_id`        bigint(20),
                    `post_status`   varchar(10) NOT NULL DEFAULT 'draft' COMMENT 'draft, published, trashed',
                    `posted_date`   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `updated_date`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $postmeta = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "postmeta`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "postmeta` (
                    `meta_id`       bigint(20) NOT NULL AUTO_INCREMENT,
                    `post_id`       bigint(20) NOT NULL DEFAULT 0,
                    `meta_key`      varchar(255),
                    `meta_value`    longtext,
                    PRIMARY KEY (`meta_id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $products = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "products`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "products` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `user_id`       bigint(20) NOT NULL,
                    `lang_code`     varchar(7) NOT NULL,
                    `categories`    longtext NOT NULL,
                    `title`         varchar(100) NOT NULL,
                    `slug`          varchar(255) NOT NULL,
                    `excerpt`       varchar(500),
                    `content`       longtext NOT NULL,
                    `thumbnail`     varchar(255),
                    `tags`          varchar(255),
                    `images`        longtext,
                    `seo`           longtext,
                    `view_count`    bigint(20) NOT NULL DEFAULT 0,
                    `price`         decimal(10,0) NOT NULL DEFAULT 0,
                    `post_status`   varchar(10) NOT NULL DEFAULT 'draft' COMMENT 'draft, published, trashed',
                    `posted_date`   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `updated_date`  datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $productmeta = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "productmeta`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "productmeta` (
                    `meta_id`       bigint(20) NOT NULL AUTO_INCREMENT,
                    `product_id`    bigint(20) NOT NULL DEFAULT 0,
                    `meta_key`      varchar(255),
                    `meta_value`    longtext,
                    PRIMARY KEY (`meta_id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $term_relationships = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "term_relationships`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "term_relationships` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `object_id`     bigint(20) UNSIGNED NOT NULL DEFAULT 0,
                    `object_type`   varchar(100) NOT NULL COMMENT 'Example: \"product\" or \"post\" or ...',
                    `taxonomy_id`   bigint(20) UNSIGNED NOT NULL DEFAULT 0,
                    `term_order`    int(11) NOT NULL DEFAULT 1,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $orders = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "orders`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "orders` (
                    `id`                    bigint(20) NOT NULL AUTO_INCREMENT,
                    `customer_id`           bigint(20) NOT NULL DEFAULT 0,
                    `customer_info`         longtext NOT NULL,
                    `ship_info`             longtext NOT NULL,
                    `payment_method`        varchar(255) NOT NULL,
                    `discount`              decimal(10,0) NOT NULL DEFAULT 0,
                    `delivery_amount`       decimal(10,0) NOT NULL DEFAULT 0,
                    `total_amount`          decimal(10,0) NOT NULL DEFAULT 0,
                    `products`              longtext NOT NULL,
                    `status`                int(11) DEFAULT 0 COMMENT '0: Pending, 1: In Progress, 2: Paid, 3: Canceled',
                    `delivery_status`       int(11) DEFAULT 0 COMMENT '0: Pending, 1: Shipping, 2: Shipped',
                    `nl_payment_id`         varchar(255),
                    `nl_secure_code`        varchar(255),
                    `affiliate_id`          varchar(100),
                    `affiliate_trans_id`    varchar(255),
                    `created_at`            TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $files = "DROP TABLE IF EXISTS `" . TABLE_FILE . "`; 
            CREATE TABLE IF NOT EXISTS `" . TABLE_FILE . "` (
                `id`        int(11) unsigned NOT NULL auto_increment,
                `parent_id` int(11) unsigned NOT NULL,
                `name`      varchar(256) NOT NULL,
                `content`   longblob NOT NULL,
                `size`      int(11) unsigned NOT NULL default '0',
                `mtime`     int(11) unsigned NOT NULL,
                `mime`      varchar(256) NOT NULL default 'unknown',
                `read`      enum('1', '0') NOT NULL default '1',
                `write`     enum('1', '0') NOT NULL default '1',
                `locked`    enum('1', '0') NOT NULL default '0',
                `hidden`    enum('1', '0') NOT NULL default '0',
                `width`     int(11) NOT NULL,
                `height`    int(11) NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY  `parent_name` (`parent_id`, `name`),
                KEY         `parent_id`   (`parent_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $menu = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "menu`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "menu` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `lang_code`     varchar(7) NOT NULL,
                    `name`          varchar(50) NOT NULL,
                    `title`         varchar(50) NOT NULL,
                    `url`           varchar(255) NOT NULL,
                    `parent`        bigint(20) NOT NULL DEFAULT 0,
                    `description`   varchar(500),
                    `image`         varchar(255),
                    `image_link`    varchar(255),
                    `icon`          varchar(255),
                    `displayorder`  bigint(20) NOT NULL DEFAULT 1,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $sliders = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "sliders`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "sliders` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `title`         varchar(200) NOT NULL,
                    `link`          varchar(255) NOT NULL,
                    `image`         varchar(255) NOT NULL,
                    `displayorder`  bigint(20) NOT NULL DEFAULT 1,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $rss = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "rss`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "rss` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `sources`       bigint(20) NOT NULL,
                    `categories`    longtext NOT NULL,
                    `url`           text NOT NULL,
                    `status`        tinyint(4) NOT NULL DEFAULT 0 COMMENT '0: Live, 1: Die',
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $favorite_links = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "favorite_links`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "favorite_links` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `user_id`       bigint(20) NOT NULL,
                    `link_id`       bigint(20) NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $blacklist_domains = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "blacklist_domains`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "blacklist_domains` (
                    `id`            bigint(20) NOT NULL AUTO_INCREMENT,
                    `domain`        varchar(100) NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";
        $report_links = "DROP TABLE IF EXISTS `" . TABLE_PREFIX . "report_links`; 
                CREATE TABLE IF NOT EXISTS `" . TABLE_PREFIX . "report_links` (
                    `id`                bigint(20) NOT NULL AUTO_INCREMENT,
                    `link_id`           bigint(20) NOT NULL,
                    `broken`            tinyint(4),
                    `wrong_category`    tinyint(4),
                    `sex`               tinyint(4),
                    `low_quality`       tinyint(4),
                    `spam`              tinyint(4),
                    `adv`               tinyint(4),
                    `date`              TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=" . DB_CHARSET . " COLLATE=" . DB_COLLATE . ";";

        $db = $this->DB();
        try {
            /* Begin a transaction, turning off autocommit */
            $db->beginTransaction();
            /* Change the database schema and data */
            //$db->exec($languages);
            $db->exec($usergroups);
            $db->exec($users);
            //$db->exec($usermeta);
            //$db->exec($statistics_visit);
            //$db->exec($statistics_visitor);
            //$db->exec($statistics_useronline);
            //$db->exec($categories);
            //$db->exec($posts);
            //$db->exec($postmeta);
//            $db->exec($products);
//            $db->exec($productmeta);
            //$db->exec($term_relationships);
//            $db->exec($orders);
            //$db->exec($pages);
            //$db->exec($links);
            //$db->exec($files);
            //$db->exec($menu);
//            $db->exec($sliders);
            //$db->exec($rss);
            //$db->exec($favorite_links);
            //$db->exec($blacklist_domains);
            //$db->exec($report_links);

            ## Default data for table Options
//            $db->insert(TABLE_PREFIX . "options", array(
//                'option_name' => 'site_option',
//                'option_value' => serialize(array(
//                    'name' => 'Default title',
//                    'description' => '',
//                    'keywords' => ''
//                )),
//            ));

            ## Default data for table Laguages
//            $db->insert(TABLE_PREFIX . "languages", array(
//                'english_name' => 'Vietnamese',
//                'code' => "vi", // Eg: en
//                'iso' => "vi-VN", // Eg: en-US
//                'locale' => "vi_VN", // Eg: en_US
//                'active' => 1, // 1 or 0
//                'flag' => Registry::$siteurl . '/public/flags/VN.png' // URL flag icon
//            ));
            
            ## Default data for table Category
//            $db->insert(TABLE_PREFIX . "categories", array(
//                'lang_code' => DEFAULT_LANG,
//                'name' => 'Uncategories',
//                'slug' => 'uncategories',
//                'taxonomy' => 'post'
//            ));
//            $db->insert(TABLE_PREFIX . "categories", array(
//                'lang_code' => DEFAULT_LANG,
//                'name' => 'Uncategories',
//                'slug' => 'uncategories',
//                'taxonomy' => 'product'
//            ));

            ## Default data for table UserGroups
            $adminCapability = array(
                'options' => array('view' => 1, 'edit' => 1),
                'languages' => array('view' => 1, 'edit' => 1),
                'userGroups' => array('view' => 1, 'edit' => 1, 'permission' => 1),
                'users' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1, 'permission' => 1),
                'categories' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
                'posts' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
//                'products' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
//                'sliders' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
                'pages' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
                'links' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
                'files' => array('view' => 1, 'edit' => 1, 'upload' => 1, 'delete' => 1),
//                'orders' => array('view' => 1, 'edit' => 1, 'delete' => 1),
                'rss' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
                'blacklistDomains' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
                'report' => array('view' => 1, 'send' => 1, 'delete' => 1),
                'menu' => array('manage' => 1),
                'settings' => array('allow' => 1,),
            );
            $editorCapability = array(
                'options' => array('view' => 0, 'edit' => 0),
                'languages' => array('view' => 0, 'edit' => 0),
                'userGroups' => array('view' => 0, 'edit' => 0, 'permission' => 0),
                'users' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0, 'permission' => 0),
                'categories' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
                'posts' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
//                'products' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
//                'sliders' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
                'pages' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
                'links' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 1),
                'files' => array('view' => 1, 'edit' => 1, 'upload' => 1, 'delete' => 1),
//                'orders' => array('view' => 0, 'edit' => 0, 'delete' => 0),
                'rss' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 0),
                'blacklistDomains' => array('view' => 1, 'edit' => 1, 'create' => 1, 'delete' => 0),
                'report' => array('view' => 1, 'send' => 1, 'delete' => 1),
                'menu' => array('manage' => 0),
                'settings' => array('allow' => 0,),
            );
            $subscriberCapability = array(
                'options' => array('view' => 0, 'edit' => 0),
                'languages' => array('view' => 0, 'edit' => 0),
                'userGroups' => array('view' => 0, 'edit' => 0, 'permission' => 0),
                'users' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0, 'permission' => 0),
                'categories' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
                'posts' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
//                'products' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
//                'sliders' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
                'pages' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
                'links' => array('view' => 0, 'edit' => 0, 'create' => 1, 'delete' => 0),
                'files' => array('view' => 0, 'edit' => 0, 'upload' => 0, 'delete' => 0),
//                'orders' => array('view' => 0, 'edit' => 0, 'delete' => 0),
                'rss' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
                'blacklistDomains' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
                'report' => array('view' => 0, 'send' => 1, 'delete' => 0),
                'menu' => array('manage' => 0),
                'settings' => array('allow' => 0,),
            );
            $bannedCapability = array(
                'options' => array('view' => 0, 'edit' => 0),
                'languages' => array('view' => 0, 'edit' => 0),
                'userGroups' => array('view' => 0, 'edit' => 0, 'permission' => 0),
                'users' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0, 'permission' => 0),
                'categories' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
                'posts' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
//                'products' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
//                'sliders' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
                'pages' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
                'links' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
                'files' => array('view' => 0, 'edit' => 0, 'upload' => 0, 'delete' => 0),
//                'orders' => array('view' => 0, 'edit' => 0, 'delete' => 0),
                'rss' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
                'blacklistDomains' => array('view' => 0, 'edit' => 0, 'create' => 0, 'delete' => 0),
                'report' => array('view' => 0, 'send' => 0, 'delete' => 0),
                'menu' => array('manage' => 0),
                'settings' => array('allow' => 0,),
            );
            $db->insert(TABLE_PREFIX . "usergroups", array(
                'role' => 'administrator',
                'name' => 'Administrator',
                'capability' => serialize($adminCapability),
            ));
            $db->insert(TABLE_PREFIX . "usergroups", array(
                'role' => 'editor',
                'name' => 'Editor',
                'capability' => serialize($editorCapability),
            ));
            $db->insert(TABLE_PREFIX . "usergroups", array(
                'role' => 'subscriber',
                'name' => 'Subscriber',
                'capability' => serialize($subscriberCapability),
            ));
            $db->insert(TABLE_PREFIX . "usergroups", array(
                'role' => 'banned',
                'name' => 'Banned',
                'capability' => serialize($bannedCapability),
            ));

            ## Default data for table Users
            $salt = Utils::fetch_user_salt(30);
            $password = Utils::hash_password("1234567", $salt);
            $db->insert(TABLE_PREFIX . "users", array(
                'username' => "admin",
                'email' => 'ngothangit@gmail.com',
                'password' => $password,
                'salt' => $salt,
                'role' => 'administrator',
                'capability' => serialize($adminCapability),
            ));
            // Example User
//            for ($index = 0; $index < 20; $index++) {
//                $salt1 = Utils::fetch_user_salt(30);
//                $pwd = Utils::hash_password("1234567", $salt1);
//                $db->insert(TABLE_PREFIX . "users", array(
//                    'username' => "demo{$index}",
//                    'email' => "demo{$index}@gmail.com",
//                    'password' => $pwd,
//                    'salt' => $salt1,
//                    'role' => 'subscriber',
//                    'capability' => serialize($subscriberCapability),
//                ));
//            }
            // Example orders
//            $db->insert(TABLE_PREFIX . "orders", array(
//                'customer_id' => 0,
//                'customer_info' => serialize(array(
//                    'fullname' => 'nguyen van A', 
//                    'email' => 'email1@gmail.com',
//                    'phone' => '0123456789',
//                    'passport' => '123456789',
//                    'address' => 'Ba Dinh, Ha Noi',
//                    'city' => 'Ha Noi',
//                )),
//                'ship_info' => serialize(array(
//                    'fullname' => 'nguyen van A', 
//                    'email' => 'email1@gmail.com',
//                    'phone' => '0123456789',
//                    'passport' => '123456789',
//                    'address' => 'Ba Dinh, Ha Noi',
//                    'city' => 'Ha Noi',
//                )),
//                'payment_method' => 'Thanh toan tai van phong',
//                'total_amount' => 500000,
//                'products' => serialize(array(
//                    array(
//                        'id' => 1,
//                        'title' => 'san pham 1',
//                        'slug' => 'san-pham-1',
//                        'price' => 100000,
//                        'quantity' => 1,
//                        'amount' => 100000
//                    ),
//                    array(
//                        'id' => 2,
//                        'title' => 'san pham 2',
//                        'slug' => 'san-pham-2',
//                        'price' => 200000,
//                        'quantity' => 2,
//                        'amount' => 400000
//                    ),
//                )),
//                'created_at' => '2014-05-18 00:00:00'
//            ));
//            $db->insert(TABLE_PREFIX . "orders", array(
//                'customer_id' => 1,
//                'customer_info' => serialize(array(
//                    'fullname' => 'nguyen van B', 
//                    'email' => 'email1@gmail.com',
//                    'phone' => '0123456789',
//                    'passport' => '123456789',
//                    'address' => 'Ba Dinh, Ha Noi',
//                    'city' => 'Ha Noi',
//                )),
//                'ship_info' => serialize(array(
//                    'fullname' => 'nguyen van A', 
//                    'email' => 'email1@gmail.com',
//                    'phone' => '0123456789',
//                    'passport' => '123456789',
//                    'address' => 'Ba Dinh, Ha Noi',
//                    'city' => 'Ha Noi',
//                )),
//                'payment_method' => 'Thanh toan khi nhan hang',
//                'total_amount' => 500000,
//                'products' => serialize(array(
//                    array(
//                        'id' => 1,
//                        'title' => 'san pham 1',
//                        'slug' => 'san-pham-1',
//                        'price' => 100000,
//                        'quantity' => 1,
//                        'amount' => 100000
//                    ),
//                    array(
//                        'id' => 2,
//                        'title' => 'san pham 2',
//                        'slug' => 'san-pham-2',
//                        'price' => 200000,
//                        'quantity' => 2,
//                        'amount' => 400000
//                    ),
//                )),
//                'created_at' => '2014-05-19 00:00:00'
//            ));
//            $db->insert(TABLE_PREFIX . "orders", array(
//                'customer_id' => 1,
//                'customer_info' => serialize(array(
//                    'fullname' => 'nguyen van B', 
//                    'email' => 'email1@gmail.com',
//                    'phone' => '0123456789',
//                    'passport' => '123456789',
//                    'address' => 'Ba Dinh, Ha Noi',
//                    'city' => 'Ha Noi',
//                )),
//                'ship_info' => serialize(array(
//                    'fullname' => 'nguyen van A', 
//                    'email' => 'email1@gmail.com',
//                    'phone' => '0123456789',
//                    'passport' => '123456789',
//                    'address' => 'Ba Dinh, Ha Noi',
//                    'city' => 'Ha Noi',
//                )),
//                'payment_method' => 'Thanh toan khi nhan hang',
//                'total_amount' => 500000,
//                'products' => serialize(array(
//                    array(
//                        'id' => 1,
//                        'title' => 'san pham 1',
//                        'slug' => 'san-pham-1',
//                        'price' => 100000,
//                        'quantity' => 1,
//                        'amount' => 100000
//                    ),
//                    array(
//                        'id' => 2,
//                        'title' => 'san pham 2',
//                        'slug' => 'san-pham-2',
//                        'price' => 200000,
//                        'quantity' => 2,
//                        'amount' => 400000
//                    ),
//                )),
//                'created_at' => '2014-05-20 00:00:00'
//            ));

            /* $db->insert(TABLE_FILE, array(
              'parent_id' => 0,
              'name' => 'DATABASE',
              'content' => '',
              'size' => 0,
              'mtime' => 0,
              'mime' => 'directory',
              'read' => 1,
              'write' => 1,
              'locked' => 0,
              'hidden' => 0,
              'width' => 0,
              'height' => 0
              )); */
            /* Database connection is now back in autocommit mode */
            $db->commit();
        } catch (Exception $exc) {
            /* Recognize mistake and roll back changes */
            $db->rollBack();
            Debug::throwException("Database error!", $exc);
        }
    }

}
