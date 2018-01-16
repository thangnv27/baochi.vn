{php}
include(APP_PATH . 'view' . DS . THEME_NAME . DS . 'functions.php');
{/php}
{assign var="lang" value=Language::$lang_code}
{assign var="siteurl" value=Registry::$siteurl scope="global"}
{assign var="option" value=TPL::getSiteOption() scope="global"}
{assign var="contact" value=TPL::getContactInfo() scope="global"}
{assign var="menu" value=TPL::getMenu() scope="global"}
{*MOBILE*}
{assign var="categories" value=TPL::getCategories() scope="global"}
{assign var="categoriesNews" value=TPL::getCategoriesNews() scope="global"}
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
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
        <link rel="stylesheet" href="{$siteurl}/public/mobile2/css/style.css" />
        <link rel="stylesheet" href="{$siteurl}/public/mobile2/css/responsive.css" />
        <link href="{$siteurl}/public/css/common.css" rel="stylesheet" media="all" />

        <script>
            var siteurl = '{$siteurl}';
        </script>
{if $option->ga_id != ""}
    <script type="text/javascript">
        
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '{$option->ga_id}']);
        _gaq.push(['_trackPageview']);
        
        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    
    </script>
{/if}
    </head>
    <body>
        <div class="header">
            <h1><a href="{$siteurl}">Người đưa tin .net</a></h1>
            <div class="login">
                {if $smarty.session.user_logged_in == null}
                    <a class="login_btn" href="{$siteurl}/user/login_facebook/">Đăng nhập</a>
                {else}
                    <a class="login_btn" href="{$siteurl}/user/logout/">Đăng xuất</a>
                {/if}
            </div>
        </div>
    {block name="ads_head"}{/block}
    {block name="body"}{/block}
<div class="footer">
    <a href="{$siteurl}/menu" class="btn-footer btn-menu">Menu</a>
    {block name="savepost"}
    {/block}
    <a  style="cursor: pointer" onclick="goBack();" class="btn-footer btn-back"> < </a>
    <a href="{$siteurl}" class="btn-footer btn-text">Web hay</a>
    <a href="{$siteurl}/news/hot" class="btn-footer btn-text">Tin hot</a>
    {block name="like_page"}
        <a href="#" class="btn-footer btn-like"><div class="fb-like" data-href="{$option->fanpage_url}" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div></a>
    {/block}
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="{$siteurl}/public/mobile2/js/jquery-scrolltofixed-min.js"></script>
<script src="{$siteurl}/public/mobile2/js/app.js"></script>
{block name="script"}{/block}
<script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>
