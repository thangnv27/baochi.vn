<?php /* Smarty version Smarty-3.1.17, created on 2015-03-30 23:33:10
         compiled from "/home/customer/domains/baochi.vn/public_html/app/view/mobile/myweb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160190663455197ac66cb893-21895104%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '151104b7f4099f63d3aef1799bd06a732d7d3547' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/mobile/myweb.tpl',
      1 => 1426647462,
      2 => 'file',
    ),
    '911bdb431717b378a288477b60d4adcba0c7f54c' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/mobile/layout.tpl',
      1 => 1426647462,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160190663455197ac66cb893-21895104',
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
  'unifunc' => 'content_55197ac6899829_44424269',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55197ac6899829_44424269')) {function content_55197ac6899829_44424269($_smarty_tpl) {?><?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; echo smarty_php_tag(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

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
        <!-- ndt mobile tinhot top2 -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:320px;height:50px"
             data-ad-client="ca-pub-8791311737735591"
             data-ad-slot="1173633276"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    
        <!-- BEGIN BODY -->
        
    <div class="container home">
        <div class="home-link">
            <?php if ($_SESSION['user_logged_in']==null) {?>
                <div style="text-align: center"><a data-ajax="false" href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/user/login_facebook/" class="ui-btn-text btn-login-fb" title="Đăng nhập bằng Facebook"><img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mobile/img/btn_login_fb.png" /></a></div>
                    <?php } else { ?>
                <div class="list-web">
                    <h3 class="list-web-title">Web của bạn</h3>
                    <ul class="weblist-ul">
                        <li>
                            <ul class="link-cat-sub">
                                <?php if ($_smarty_tpl->tpl_vars['userlink']->value!=null) {?>
                                    <?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['userlink']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->_loop = true;
?>
                                        <li class="link-item">
                                            <span class="favicon16" onclick="details_link(<?php echo $_smarty_tpl->tpl_vars['link']->value['id'];?>
 );"><img width="16" height="16" title="<?php echo $_smarty_tpl->tpl_vars['link']->value['title'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['link']->value['thumbnail'];?>
"></span>
                                            <a class="link-item-a" href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/link/<?php echo $_smarty_tpl->tpl_vars['link']->value['slug'];?>
/" target="_blank">
                                                <span><?php echo $_smarty_tpl->tpl_vars['link']->value['title'];?>
</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                <?php }?>
                            </ul>
                        </li>
                    </ul>
                </div>
            <?php }?>
        </div>
        <div class="advertisement-468-60">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- ndt mobile dba canhan -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:320px;height:50px"
                 data-ad-client="ca-pub-8791311737735591"
                 data-ad-slot="5324631278"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>

        <!-- END BODY -->
    </div>

    <div class="footer">
        <div class="ft-category">
            <a href="#">Xã hội</a>
            <a href="#">Văn Hoá</a>
            <a href="#">Đời sống</a>
            <a href="#">Thể thao</a>
            <a href="#">Công nghệ</a>
            <a href="#">Quân sự</a>
        </div>
        <div class="ft-search">
            <form action="" class="frm-search">
                <input type="text" class="txt" name="s" />
                <input type="submit" class="btn-search" value="" />
            </form>
        </div>
        <div class="ft-menu">
            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
" title="Về trang chủ">Về trang chủ</a>
            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/mobile/webhay/" title="Web hay">Web hay</a>
            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/news/hot" title="Đọc nhiều">Đọc nhiều</a>
            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/news/hot" title="Đọc nhiều">Tâm điểm</a>
        </div>
    </div>
    <!-- END FOOTER -->
    <!-- BEGIN FIXED FOOTER -->
    <div class="footer-fix">
        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/menu" class="btn-footer btn-menu"><img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mb/images/icon_menubar.png" /></a>
            
            <a href="#" class="btn-footer btn-save-post">+</a>
        
        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/mobile/webhay/" class="btn-footer btn-text">Web hay</a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/news/hot" class="btn-footer btn-text">Đọc nhiều</a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/news/hot" class="btn-footer btn-text">Tâm điểm</a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/user/myweb" class="btn-footer btn-text">Đã lưu</a>
    </div>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mb/js/jquery-scrolltofixed-min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/mb/js/app.js"></script>
    
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/js/jquery.validate.js"></script>
    <script type="text/javascript">

        function details_link( link_id ) {
            window.location.href = siteurl + '/details/mydetails?id=' + link_id;
        }

        function removeFavoriteLink( link_id ) {
            $.ajax( {
                url: siteurl + "/welcome/mobile_remove_favorite_link", type: "POST", dataType: "json", cache: false,
                data: {
                    link_id: link_id
                },
                success: function( response, textStatus, XMLHttpRequest ) {
                    if ( response && response.status == 'success' ) {
                        alert( response.message );
                        $( ".link-cat-sub" ).html( response.favorites ).html();

                    } else if ( response && response.status == 'error' ) {
                        alert( response.message );
                    }
                },
                error: function( MLHttpRequest, textStatus, errorThrown ) {
                    alert( errorThrown );
                },
                complete: function() {
                }
            } );
        }
    </script>

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