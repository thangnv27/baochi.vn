<?php /* Smarty version Smarty-3.1.17, created on 2015-03-28 11:28:46
         compiled from "/home/customer/domains/baochi.vn/public_html/app/view/mobile/post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:110983933055162dfe72f030-06038315%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1fd8bd1ef070f82912ae045b8c4364dd7e43a64' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/mobile/post.tpl',
      1 => 1426647462,
      2 => 'file',
    ),
    'd0323dadd4837e0ddb4c9568664b52e0a86b6f01' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/mobile/layout_post.tpl',
      1 => 1426647462,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110983933055162dfe72f030-06038315',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'option' => 0,
    'siteurl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_55162dfee4bc70_96108767',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55162dfee4bc70_96108767')) {function content_55162dfee4bc70_96108767($_smarty_tpl) {?><?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; echo smarty_php_tag(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

include(APP_PATH . 'view' . DS . THEME_NAME . DS . 'functions.php');
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_php_tag(array(), $_block_content, $_smarty_tpl, $_block_repeat); } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php if (isset($_smarty_tpl->tpl_vars["lang"])) {$_smarty_tpl->tpl_vars["lang"] = clone $_smarty_tpl->tpl_vars["lang"];
$_smarty_tpl->tpl_vars["lang"]->value = Language::$lang_code; $_smarty_tpl->tpl_vars["lang"]->nocache = null; $_smarty_tpl->tpl_vars["lang"]->scope = 0;
} else $_smarty_tpl->tpl_vars["lang"] = new Smarty_variable(Language::$lang_code, null, 0);?>
<?php if (isset($_smarty_tpl->tpl_vars["siteurl"])) {$_smarty_tpl->tpl_vars["siteurl"] = clone $_smarty_tpl->tpl_vars["siteurl"];
$_smarty_tpl->tpl_vars["siteurl"]->value = Registry::$siteurl; $_smarty_tpl->tpl_vars["siteurl"]->nocache = null; $_smarty_tpl->tpl_vars["siteurl"]->scope = 3;
} else $_smarty_tpl->tpl_vars["siteurl"] = new Smarty_variable(Registry::$siteurl, null, 3);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars["siteurl"] = clone $_smarty_tpl->tpl_vars["siteurl"]; $_ptr = $_ptr->parent; }
Smarty::$global_tpl_vars["siteurl"] = clone $_smarty_tpl->tpl_vars["siteurl"];?>
<?php if (isset($_smarty_tpl->tpl_vars["option"])) {$_smarty_tpl->tpl_vars["option"] = clone $_smarty_tpl->tpl_vars["option"];
$_smarty_tpl->tpl_vars["option"]->value = TPL::getSiteOption(); $_smarty_tpl->tpl_vars["option"]->nocache = null; $_smarty_tpl->tpl_vars["option"]->scope = 3;
} else $_smarty_tpl->tpl_vars["option"] = new Smarty_variable(TPL::getSiteOption(), null, 3);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars["option"] = clone $_smarty_tpl->tpl_vars["option"]; $_ptr = $_ptr->parent; }
Smarty::$global_tpl_vars["option"] = clone $_smarty_tpl->tpl_vars["option"];?>
<?php if (isset($_smarty_tpl->tpl_vars["contact"])) {$_smarty_tpl->tpl_vars["contact"] = clone $_smarty_tpl->tpl_vars["contact"];
$_smarty_tpl->tpl_vars["contact"]->value = TPL::getContactInfo(); $_smarty_tpl->tpl_vars["contact"]->nocache = null; $_smarty_tpl->tpl_vars["contact"]->scope = 3;
} else $_smarty_tpl->tpl_vars["contact"] = new Smarty_variable(TPL::getContactInfo(), null, 3);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars["contact"] = clone $_smarty_tpl->tpl_vars["contact"]; $_ptr = $_ptr->parent; }
Smarty::$global_tpl_vars["contact"] = clone $_smarty_tpl->tpl_vars["contact"];?>

<?php if (isset($_smarty_tpl->tpl_vars["categories"])) {$_smarty_tpl->tpl_vars["categories"] = clone $_smarty_tpl->tpl_vars["categories"];
$_smarty_tpl->tpl_vars["categories"]->value = TPL::getCategories(); $_smarty_tpl->tpl_vars["categories"]->nocache = null; $_smarty_tpl->tpl_vars["categories"]->scope = 3;
} else $_smarty_tpl->tpl_vars["categories"] = new Smarty_variable(TPL::getCategories(), null, 3);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars["categories"] = clone $_smarty_tpl->tpl_vars["categories"]; $_ptr = $_ptr->parent; }
Smarty::$global_tpl_vars["categories"] = clone $_smarty_tpl->tpl_vars["categories"];?>

<?php if (isset($_smarty_tpl->tpl_vars["sources"])) {$_smarty_tpl->tpl_vars["sources"] = clone $_smarty_tpl->tpl_vars["sources"];
$_smarty_tpl->tpl_vars["sources"]->value = TPL::getSources(); $_smarty_tpl->tpl_vars["sources"]->nocache = null; $_smarty_tpl->tpl_vars["sources"]->scope = 3;
} else $_smarty_tpl->tpl_vars["sources"] = new Smarty_variable(TPL::getSources(), null, 3);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars["sources"] = clone $_smarty_tpl->tpl_vars["sources"]; $_ptr = $_ptr->parent; }
Smarty::$global_tpl_vars["sources"] = clone $_smarty_tpl->tpl_vars["sources"];?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Cache-control" content="no-store; no-cache"/>
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Expires" content="0"/>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <!-- Run in full-screen mode. -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <!-- Make the status bar black with white text. -->
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <!-- Customize home screen title. -->
        <meta name="apple-mobile-web-app-title" content="Mobile Web App">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Icons -->

        <link rel="icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['option']->value->favicon;?>
" />

        <!-- iOS 7 iPad (retina) -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-icon-152x152.png"
              sizes="152x152"
              rel="apple-touch-icon">

        <!-- iOS 6 iPad (retina) -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-icon-144x144.png"
              sizes="144x144"
              rel="apple-touch-icon">

        <!-- iOS 7 iPhone (retina) -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-icon-120x120.png"
              sizes="120x120"
              rel="apple-touch-icon">

        <!-- iOS 6 iPhone (retina) -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-icon-114x114.png"
              sizes="114x114"
              rel="apple-touch-icon">

        <!-- iOS 7 iPad -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-icon-76x76.png"
              sizes="76x76"
              rel="apple-touch-icon">

        <!-- iOS 6 iPad -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-icon-72x72.png"
              sizes="72x72"
              rel="apple-touch-icon">

        <!-- iOS 6 iPhone -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-icon-57x57.png"
              sizes="57x57"
              rel="apple-touch-icon">

        <!-- Startup images -->

        <!-- iOS 6 & 7 iPad (retina, portrait) -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-startup-image-1536x2008.png"
              media="(device-width: 768px) and (device-height: 1024px)
              and (orientation: portrait)
              and (-webkit-device-pixel-ratio: 2)"
              rel="apple-touch-startup-image">

        <!-- iOS 6 & 7 iPad (retina, landscape) -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-startup-image-1496x2048.png"
              media="(device-width: 768px) and (device-height: 1024px)
              and (orientation: landscape)
              and (-webkit-device-pixel-ratio: 2)"
              rel="apple-touch-startup-image">

        <!-- iOS 6 iPad (portrait) -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-startup-image-768x1004.png"
              media="(device-width: 768px) and (device-height: 1024px)
              and (orientation: portrait)
              and (-webkit-device-pixel-ratio: 1)"
              rel="apple-touch-startup-image">

        <!-- iOS 6 iPad (landscape) -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-startup-image-748x1024.png"
              media="(device-width: 768px) and (device-height: 1024px)
              and (orientation: landscape)
              and (-webkit-device-pixel-ratio: 1)"
              rel="apple-touch-startup-image">

        <!-- iOS 6 & 7 iPhone 5 -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-startup-image-640x1096.png"
              media="(device-width: 320px) and (device-height: 568px)
              and (-webkit-device-pixel-ratio: 2)"
              rel="apple-touch-startup-image">

        <!-- iOS 6 & 7 iPhone (retina) -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-startup-image-640x920.png"
              media="(device-width: 320px) and (device-height: 480px)
              and (-webkit-device-pixel-ratio: 2)"
              rel="apple-touch-startup-image">

        <!-- iOS 6 iPhone -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/apple/apple-touch-startup-image-320x460.png"
              media="(device-width: 320px) and (device-height: 480px)
              and (-webkit-device-pixel-ratio: 1)"
              rel="apple-touch-startup-image">
        
        
    <link rel="canonical" href="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
" />

    <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['option']->value->keywords;?>
" />
    <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['option']->value->description;?>
" />

    <meta property="og:description" content="<?php echo $_smarty_tpl->tpl_vars['option']->value->description;?>
" />

    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" />
    <meta property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
" />
    <meta property="og:site_name" content="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" />

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,700,600italic,300,300italic&subset=vietnamese' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic&subset=latin,vietnamese' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/css/common.css" rel="stylesheet" media="all" />
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mb/style.css" />

        <script>
            var siteurl = '<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
';
        </script>
        <?php if ($_smarty_tpl->tpl_vars['option']->value->ga_id!='') {?>
            <script type="text/javascript">

                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', '<?php echo $_smarty_tpl->tpl_vars['option']->value->ga_id;?>
']);
                _gaq.push(['_trackPageview']);

                (function () {
                    var ga = document.createElement('script');
                    ga.type = 'text/javascript';
                    ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(ga, s);
                })();

            </script>
        <?php }?>
    </head>
    <body>
        <div class="header">
            <h1 class="fl"><a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
">NGƯỜI ĐƯA TIN .net</a></h1>
            <div class="fr">
                <div class="login fl">
                    <?php if ($_SESSION['user_logged_in']==null) {?>
                        <a class="login_btn" href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/user/login_facebook/">Đăng nhập</a>
                    <?php } else { ?>
                        <a class="login_btn" href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/user/logout/">Đăng xuất</a>
                    <?php }?>
                </div>
                <div class="menu fl">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/menu" title="Menu"><span class="icon-menubar"></span></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
                
    <div class="main">
        
    <div class="advertisement-468-60">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- ndt detail news mobile top 2 -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:320px;height:50px"
             data-ad-client="ca-pub-8791311737735591"
             data-ad-slot="1034032471"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>

        <!-- BEGIN BODY -->
        
    <?php if ($_smarty_tpl->tpl_vars['post_link']->value==null) {?>
        <!-- DETAIL NEWS -->
        <div class="post-details">
            <h1><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
            <div class="post-share">
                <div class="addthis_toolbox addthis_default_style">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                </div>
            </div>
            <div class="post-content">
                <?php echo $_smarty_tpl->tpl_vars['post']->value['content'];?>

            </div>
            <div class="ndtqc">
                <a href=" " title=" ">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mb/images/ads.png" />
                </a>
            </div>
            <div class="post-share">
                <div class="addthis_toolbox addthis_default_style">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                </div>
            </div>
        </div>
        <div class="post-comment">
            <div class="fb-comments" data-href="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
        </div>
        <!-- tin cung chuyen muc -->
        <div class="post-related">
            <div class="post-related-title">
                <h3 class="rlt">Tin cùng chuyên mục</h3>
            </div>
            <div class="post-related-content">
                <?php if (count($_smarty_tpl->tpl_vars['relatedPost']->value)>0) {?>
                    <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['relatedPost']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['post']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['post']->iteration=0;
 $_smarty_tpl->tpl_vars['post']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
 $_smarty_tpl->tpl_vars['post']->iteration++;
 $_smarty_tpl->tpl_vars['post']->index++;
 $_smarty_tpl->tpl_vars['post']->first = $_smarty_tpl->tpl_vars['post']->index === 0;
 $_smarty_tpl->tpl_vars['post']->last = $_smarty_tpl->tpl_vars['post']->iteration === $_smarty_tpl->tpl_vars['post']->total;
?>
                        <?php if ($_smarty_tpl->tpl_vars['post']->first) {?>
                            <div class="news-item">
                                <div class="ni-thumb fl">
                                    <a title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['post']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['post']->value['slug'];?>
/">
                                        <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['post']->value['thumbnail'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1!=null) {?>
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['post']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"/>
                                        <?php } else { ?>
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/images/no_image_93x69.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"/>
                                        <?php }?>
                                    </a>
                                </div>
                                <div class="ni-title fl">
                                    <h2><a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['post']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['post']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a></h2>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <ul class="news-related">
                            <?php } else { ?>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['post']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['post']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a></li>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['post']->last) {?>
                            </ul>
                        <?php }?>
                    <?php } ?>
                <?php }?>
            </div>
        </div>
        <!-- end tin cung chuyen muc -->
        <!-- tin quan tam -->
        <div class="post-related">
            <div class="post-related-title">
                <h3 class="rlt">Có thể bạn quan tâm</h3>
            </div>
            <div class="post-related-content">
                <div class="news-item-2">
                    <?php if (count($_smarty_tpl->tpl_vars['tamdiem_suggest']->value)>0) {?>
                        <?php if (count($_smarty_tpl->tpl_vars['tamdiem_suggest']->value)>4) {?>
                            <?php if (isset($_smarty_tpl->tpl_vars['max'])) {$_smarty_tpl->tpl_vars['max'] = clone $_smarty_tpl->tpl_vars['max'];
$_smarty_tpl->tpl_vars['max']->value = 3; $_smarty_tpl->tpl_vars['max']->nocache = null; $_smarty_tpl->tpl_vars['max']->scope = 0;
} else $_smarty_tpl->tpl_vars['max'] = new Smarty_variable(3, null, 0);?>
                        <?php } else { ?>
                            <?php if (isset($_smarty_tpl->tpl_vars['max'])) {$_smarty_tpl->tpl_vars['max'] = clone $_smarty_tpl->tpl_vars['max'];
$_smarty_tpl->tpl_vars['max']->value = count($_smarty_tpl->tpl_vars['tamdiem_suggest']->value)-1; $_smarty_tpl->tpl_vars['max']->nocache = null; $_smarty_tpl->tpl_vars['max']->scope = 0;
} else $_smarty_tpl->tpl_vars['max'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['tamdiem_suggest']->value)-1, null, 0);?>
                        <?php }?>
                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['max']->value+1 - (0) : 0-($_smarty_tpl->tpl_vars['max']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                            <?php if ($_smarty_tpl->tpl_vars['i']->value%2==0) {?>
                                <div class="ni2 mr2p">
                                <?php } else { ?>
                                    <div class="ni2">
                                    <?php }?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['tamdiem_suggest']->value[$_smarty_tpl->tpl_vars['i']->value]['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['tamdiem_suggest']->value[$_smarty_tpl->tpl_vars['i']->value]['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['tamdiem_suggest']->value[$_smarty_tpl->tpl_vars['i']->value]['title'];?>
">
                                        <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['tamdiem_suggest']->value[$_smarty_tpl->tpl_vars['i']->value]['thumbnail'];?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2!=null) {?>
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['tamdiem_suggest']->value[$_smarty_tpl->tpl_vars['i']->value]['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['tamdiem_suggest']->value[$_smarty_tpl->tpl_vars['i']->value]['title'];?>
" />
                                        <?php } else { ?>
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/images/no_image_93x69.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['tamdiem_suggest']->value[$_smarty_tpl->tpl_vars['i']->value]['title'];?>
" />
                                        <?php }?>
                                    </a>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['tamdiem_suggest']->value[$_smarty_tpl->tpl_vars['i']->value]['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['tamdiem_suggest']->value[$_smarty_tpl->tpl_vars['i']->value]['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['tamdiem_suggest']->value[$_smarty_tpl->tpl_vars['i']->value]['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['tamdiem_suggest']->value[$_smarty_tpl->tpl_vars['i']->value]['title'];?>
</a>
                                </div>
                            <?php }} ?>
                        <?php }?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end tin quan tam -->
            <!-- tin da dang -->
            <div class="post-related">
                <div class="post-related-title">
                    <h3 class="rlt">Tin đã đăng</h3>
                </div>
                <div class="post-related-content">
                    <?php if (count($_smarty_tpl->tpl_vars['otherpost']->value)>0) {?>
                        <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['otherpost']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['post']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['post']->iteration=0;
 $_smarty_tpl->tpl_vars['post']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
 $_smarty_tpl->tpl_vars['post']->iteration++;
 $_smarty_tpl->tpl_vars['post']->index++;
 $_smarty_tpl->tpl_vars['post']->first = $_smarty_tpl->tpl_vars['post']->index === 0;
 $_smarty_tpl->tpl_vars['post']->last = $_smarty_tpl->tpl_vars['post']->iteration === $_smarty_tpl->tpl_vars['post']->total;
?>
                            <?php if ($_smarty_tpl->tpl_vars['post']->first) {?>
                                <div class="news-item">
                                    <div class="ni-thumb fl">
                                        <a title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['post']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['post']->value['slug'];?>
/">
                                            <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['post']->value['thumbnail'];?>
<?php $_tmp3=ob_get_clean();?><?php if ($_tmp3!=null) {?>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['post']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"/>
                                            <?php } else { ?>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/images/no_image_93x69.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"/>
                                            <?php }?>
                                        </a>
                                    </div>
                                    <div class="ni-title fl">
                                        <h2><a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['post']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['post']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a></h2>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <ul class="news-related">
                                <?php } else { ?>
                                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['post']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['post']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a></li>
                                    <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['post']->last) {?>
                                </ul>
                            <?php }?>
                        <?php } ?>
                    <?php }?>
                </div>
            </div>
            <!-- end tin da dang -->
            <div class="ndtqc">
                <a href="" title="">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mb/images/ads.png" />
                </a>
            </div>
            <!-- END DETAIL NEWS -->
        <?php } else { ?>
            <div class="type-link">
                <iframe width="100%" frameborder="0" src="<?php echo $_smarty_tpl->tpl_vars['post_link']->value;?>
" class="ilink"></iframe>
            </div>
        <?php }?>
    
        <!-- END BODY -->
    </div>
    <!-- BEGIN FIXED FOOTER -->
    <div class="footer-fix">
        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/menu" class="btn-footer btn-menu"><img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mb/images/icon_menubar.png" /></a>
            
        <?php if ($_SESSION['user_logged_in']==null) {?>
            <a onclick="alert('Bạn cần đăng nhập để lưu địa chỉ bài viết này để đọc sau');" class="btn-footer btn-save-post" style="cursor: pointer;">+</a>
        <?php } else { ?>
            <a onclick="if (confirm('Bạn có muốn lưu địa chỉ bài viết vào danh bạ riêng không?'))
                        save_post();" class="btn-footer btn-save-post" style="cursor: pointer;">+</a>
        <?php }?>
    
        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
" class="btn-footer btn-text">Web hay</a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/news/hot" class="btn-footer btn-text">Đọc nhiều</a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/news/hot" class="btn-footer btn-text">Tâm điểm</a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/news/hot" class="btn-footer btn-text">Đã lưu</a>
    </div>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mb/js/jquery-scrolltofixed-min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mb/js/app.js"></script>
    
        <script type="text/javascript">
            function save_post() {
                var link = window.location.toString();
                if ($("iframe.ilink").length > 0) {
                    link = $("iframe.ilink").attr('src');
                }

                $.ajax({
                    url: siteurl + "/welcome/add_link", type: "POST", dataType: "json", cache: false,
                    data: {
                        title: $("title").text(),
                        link: link,
                        categories: 1
                    },
                    success: function (response, textStatus, XMLHttpRequest) {
                        if (response && response.status == 'success') {
                            alert(response.message);
                        } else if (response && response.status == 'error') {
                            alert(response.message);
                        }
                    },
                    error: function (MLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    },
                    complete: function () {
                    }
                });
            }
        </script>

        
            <script type="text/javascript">var addthis_config = {"data_track_addressbar": false};</script>
        
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e5a517830ae061f"></script>

    
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- BEGIN: Facebook API -->
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <!-- END: Facebook API -->
</body>
</html>
<?php }} ?>
