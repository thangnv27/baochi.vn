{php}
include(APP_PATH . 'view' . DS . THEME_NAME . DS . 'functions.php');
{/php}
{assign var="lang" value=Language::$lang_code}
{assign var="siteurl" value=Registry::$siteurl scope="global"}
{assign var="option" value=TPL::getSiteOption() scope="global"}
{assign var="contact" value=TPL::getContactInfo() scope="global"}
{assign var="menu" value=TPL::getMenu() scope="global"}
{assign var="ads" value=TPL::getADS() scope="global"}
{assign var="catparent" value=TPL::getListCatFooter() scope="global"}
{assign var="social" value=TPL::getSocialLink() scope="global"}
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" {$lang}> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" {$lang}> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" {$lang}> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html {$lang}> <!--<![endif]-->
    <head>
        <meta http-equiv="Cache-control" content="no-store; no-cache"/>
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Expires" content="0"/>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>{$title}</title>
        <meta name="robots" content="index, follow" /> 
        <meta name="googlebot" content="index, follow" />
        <meta name="bingbot" content="index, follow" />
        <meta name="geo.region" content="VN" />
        <meta name="geo.position" content="14.058324;108.277199" />
        <meta name="ICBM" content="14.058324, 108.277199" />
        <meta property="fb:app_id" content="248263725370755" />

        {*        <meta name="viewport" content="width=device-width, initial-scale=1.0" />*}
        <!--[if lte IE 7]>
        <script type="text/javascript">
            window.location.href = "{$siteurl}/ie7";
        </script>            
        <![endif]-->

    {block name="meta"}{/block}
    {*    Style*}
    <link href="{$siteurl}/public/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="{$siteurl}/public/static/css/common.css" rel="stylesheet" type="text/css"/>
    <link href="{$siteurl}/public/static/css/style.css" rel="stylesheet" type="text/css"/>

    <link rel="icon" type="image/x-icon" href="{$option->favicon}" />

{block name="stylesheet"}{/block}
<script>
    var siteurl = '{$siteurl}';
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{$siteurl}/public/static/js/bootstrap.min.js"></script>
<script src="{$siteurl}/public/static/js/jquery.bxslider.min.js"></script>


<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <link rel="stylesheet" href="{$siteurl}/public/css/ie.css" type="text/css" media="all" />
<![endif]-->
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
    <!-- begin top -->
    <div class="header-top">
        <div class="container">
            {$menu['second_menu']}
            <div class="header-menu-other">
                <a href="#">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
            </div>
        </div>
    </div>
    <!-- end header top -->
    <!-- begin header -->
    <div class="header">
        <div class="container">
            <div class="logo">
                <a href="{$siteurl}" title="{$title}">
                    <img src="{$option->logo}" />
                </a>
            </div>
            <div class="main-menu">
                <a href="{$siteurl}">Thông tin</a>
                <a href="{$siteurl}/source/">Nguồn tin</a>
            </div>
            <div class="main-search">
                <form class="frmsearch" method="get" action="http://www.google.com.vn/search" target="google_window">
                    <input type="text" placeholder="Nhập từ khóa tìm kiếm..." class="txt-input txt-header-search pull-left" name="q" />
                    <select name="type-search" class="pull-left">
                        <option value="google">Google</option>
                        <option value="bing">Bing.Com</option>
                        <option value="yahoo">Yahoo</option>
                    </select>
                    <button type="submit" class="btn-input btn-search pull-left"><span class="glyphicon glyphicon-search"></span></button>
                </form>

            </div>
            <div class="clearfix"></div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active sub-menu" id="thongtin">
                    {$menu['primary_menu']}
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->
    <!-- begin main -->
    <div class="main">
    {block name="home-news"}{/block}
{block name="body"}{/block}
</div>
<!-- begin quang cao full -->
<div class="container bcqc-full">
    {$ads->ads_home_footer}
</div>
<!-- end quang cao full -->
</div>
<!-- end main -->
<!-- doi tac -->
<div class="brand container">
    <div class="slide-logo">
        {$menu['footer_menu']}
    </div>
</div>
<!-- end doi tac -->
<!-- begin footer -->
<div class="footer">

    {include 'template/footer-category.tpl'}
    <!-- end footer sub -->
    <div class="container">
        <div class="footer-info">
            <div class="pull-left col-300">
                <img src="{$option->logo_footer}" />
            </div>
            <div class="pull-right col-700">
                <div class="pull-left info">
                    {$option->footer_info}
                </div>
                <div class="pull-left">
                    <img src="{$option->logo_chuquan}" width="200" />
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>



</div>
<!-- end footer -->



<!-- script references -->
{block name="script"}{/block}

<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>