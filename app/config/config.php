<?php

$config = array();
################ CONFIGURATION #################################################
/* Domain Name */
$config['domain'] = 'baochi.vn';
/* URL of your website. Note: do not add a trailing slash. ('/') */
$config['site_url'] = 'http://baochi.vn';
/* Default controller for Frontend */
$config['front_controller'] = 'Welcome';
/* Default controller for Backend */
$config['admin_controller'] = 'WelcomeAdmin';
/* Set limit */
$config['limit_posts_tamdiem']      = 14;
$config['limit_posts_by_source']    = 14;
$config['limit_posts_mobile']       = 15;
$config['limit_new_links']          = 9;
$config['limit_rss']                = 50;
$config['limit_sitemap']            = 400;
/* Time check rss dead link */
$config['num_day']                  = 3;
/* Facebook configuration */
$config['fb']['appId']  = '1618433671711401';
$config['fb']['secret'] = '6689b6b2ef16693a8e1fe991f06428ec';
$config['fb']['cookie'] = true;
/* Email configuration */
$config['swiftmailer']['host'] = "smtp.gmail.com"; // Default: localhost
$config['swiftmailer']['port'] = 465; // Default: 25
$config['swiftmailer']['auth'] = TRUE;
$config['swiftmailer']['username'] = "elpro1995@gmail.com";
$config['swiftmailer']['password'] = "unnmfwpvytmboggx";
$config['swiftmailer']['security'] = 'ssl'; // 'ssl', 'tls' and NULL available
/* Definition */
define('THEME_NAME', 'default');
define('DEFAULT_LANG', 'vi');
define('DEBUG', FALSE);
define('DEBUG_THEME', FALSE);
define('CACHE', FALSE);
define('CACHE_PREFIX', 'da_ndt_');
define('MINIFY_HTML', FALSE);

################ DATABASE ######################################################
/* Database type: mysql, mysqli, etc. */
define('DB_TYPE', 'mysql');

/* Database name */
define('DB_NAME', 'customer_baochi');

/* Database username */
define('DB_USER', 'customer_demo');

/* Database password */
define('DB_PASSWORD', 'ppodemo123##');

/* Hostname Server: 'localhost' or IP address */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', 'utf8_general_ci');

/** Prefix name of tables */
define('TABLE_PREFIX', '');

/** Name of table files */
define('TABLE_FILE', TABLE_PREFIX . 'files');

################ FTP ###########################################################
define('FTP_SERVER', 'localhost');
define('FTP_PORT', 21);
define('FTP_USERNAME', '');
define('FTP_PASSWORD', '');

################ Set default timezone ##########################################
date_default_timezone_set('Asia/Ho_Chi_Minh');
