{php}
include(APP_PATH . 'view' . DS . THEME_NAME . DS . 'functions.php');
{/php}
{assign var="lang" value=Language::$lang_code}
{assign var="siteurl" value=Registry::$siteurl scope="global"}
{assign var="option" value=TPL::getSiteOption() scope="global"}
{assign var="contact" value=TPL::getContactInfo() scope="global"}
{*MOBILE*}
{assign var="categories" value=TPL::getCategories() scope="global"}
{*{assign var="categoriesNews" value=TPL::getCategoriesNews() scope="global"}*}
{assign var="sources" value=TPL::getSources() scope="global"}
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Cache-control" content="no-store; no-cache"/>
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Expires" content="0"/>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>{$title}</title>
        <!-- Run in full-screen mode. -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <!-- Make the status bar black with white text. -->
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <!-- Customize home screen title. -->
        <meta name="apple-mobile-web-app-title" content="Mobile Web App">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Icons -->

        <link rel="icon" type="image/x-icon" href="{$option->favicon}" />

        <!-- iOS 7 iPad (retina) -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-icon-152x152.png"
              sizes="152x152"
              rel="apple-touch-icon">

        <!-- iOS 6 iPad (retina) -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-icon-144x144.png"
              sizes="144x144"
              rel="apple-touch-icon">

        <!-- iOS 7 iPhone (retina) -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-icon-120x120.png"
              sizes="120x120"
              rel="apple-touch-icon">

        <!-- iOS 6 iPhone (retina) -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-icon-114x114.png"
              sizes="114x114"
              rel="apple-touch-icon">

        <!-- iOS 7 iPad -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-icon-76x76.png"
              sizes="76x76"
              rel="apple-touch-icon">

        <!-- iOS 6 iPad -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-icon-72x72.png"
              sizes="72x72"
              rel="apple-touch-icon">

        <!-- iOS 6 iPhone -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-icon-57x57.png"
              sizes="57x57"
              rel="apple-touch-icon">

        <!-- Startup images -->

        <!-- iOS 6 & 7 iPad (retina, portrait) -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-startup-image-1536x2008.png"
              media="(device-width: 768px) and (device-height: 1024px)
              and (orientation: portrait)
              and (-webkit-device-pixel-ratio: 2)"
              rel="apple-touch-startup-image">

        <!-- iOS 6 & 7 iPad (retina, landscape) -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-startup-image-1496x2048.png"
              media="(device-width: 768px) and (device-height: 1024px)
              and (orientation: landscape)
              and (-webkit-device-pixel-ratio: 2)"
              rel="apple-touch-startup-image">

        <!-- iOS 6 iPad (portrait) -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-startup-image-768x1004.png"
              media="(device-width: 768px) and (device-height: 1024px)
              and (orientation: portrait)
              and (-webkit-device-pixel-ratio: 1)"
              rel="apple-touch-startup-image">

        <!-- iOS 6 iPad (landscape) -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-startup-image-748x1024.png"
              media="(device-width: 768px) and (device-height: 1024px)
              and (orientation: landscape)
              and (-webkit-device-pixel-ratio: 1)"
              rel="apple-touch-startup-image">

        <!-- iOS 6 & 7 iPhone 5 -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-startup-image-640x1096.png"
              media="(device-width: 320px) and (device-height: 568px)
              and (-webkit-device-pixel-ratio: 2)"
              rel="apple-touch-startup-image">

        <!-- iOS 6 & 7 iPhone (retina) -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-startup-image-640x920.png"
              media="(device-width: 320px) and (device-height: 480px)
              and (-webkit-device-pixel-ratio: 2)"
              rel="apple-touch-startup-image">

        <!-- iOS 6 iPhone -->
        <link href="{$siteurl}/public/mobile/img/apple/apple-touch-startup-image-320x460.png"
              media="(device-width: 320px) and (device-height: 480px)
              and (-webkit-device-pixel-ratio: 1)"
              rel="apple-touch-startup-image">
        
        {block name="meta"}{/block}
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,700,600italic,300,300italic&subset=vietnamese' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic&subset=latin,vietnamese' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
        <link href="{$siteurl}/public/css/common.css" rel="stylesheet" media="all" />
        <link rel="stylesheet" href="{$siteurl}/public/mb/style.css" />

        <script>
            var siteurl = '{$siteurl}';
        </script>
        {if $option->ga_id != ""}
            <script type="text/javascript">

                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', '{$option->ga_id}']);
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
        {/if}
    </head>
    <body>
        <div class="header">
            <h1 class="fl"><a href="{$siteurl}">NGƯỜI ĐƯA TIN .net</a></h1>
            <div class="fr">
                <div class="login fl">
                    {if $smarty.session.user_logged_in == null}
                        <a class="login_btn" href="{$siteurl}/user/login_facebook/">Đăng nhập</a>
                    {else}
                        <a class="login_btn" href="{$siteurl}/user/logout/">Đăng xuất</a>
                    {/if}
                </div>
                <div class="menu fl">
                    <a href="{$siteurl}/menu" title="Menu"><span class="icon-menubar"></span></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
                
    <div class="main">
        {block name="ads_head"}{/block}
        <!-- BEGIN BODY -->
        {block name="body"}{/block}
        <!-- END BODY -->
    </div>
    <!-- BEGIN FIXED FOOTER -->
    <div class="footer-fix">
        <a href="{$siteurl}/menu" class="btn-footer btn-menu"><img src="{$siteurl}/public/mb/images/icon_menubar.png" /></a>
            {block name="savepost"}
            <a href="#" class="btn-footer btn-save-post">+</a>
        {/block}
        <a href="{$siteurl}" class="btn-footer btn-text">Web hay</a>
        <a href="{$siteurl}/news/hot" class="btn-footer btn-text">Đọc nhiều</a>
        <a href="{$siteurl}/news/hot" class="btn-footer btn-text">Tâm điểm</a>
        <a href="{$siteurl}/news/hot" class="btn-footer btn-text">Đã lưu</a>
    </div>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="{$siteurl}/public/mb/js/jquery-scrolltofixed-min.js"></script>
    <script src="{$siteurl}/public/mb/js/app.js"></script>
    {block name="script"}{/block}
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
