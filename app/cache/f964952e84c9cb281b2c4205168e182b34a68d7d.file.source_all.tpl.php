<?php /* Smarty version Smarty-3.1.17, created on 2015-04-08 14:38:52
         compiled from "/home/customer/domains/baochi.vn/public_html/app/view/default/source_all.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1830959035516376d3f50a9-38000700%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f964952e84c9cb281b2c4205168e182b34a68d7d' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/default/source_all.tpl',
      1 => 1427338570,
      2 => 'file',
    ),
    '74264c6a727bf1f7e066d9dc825fa0866fddb88c' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/default/layout.tpl',
      1 => 1428478462,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1830959035516376d3f50a9-38000700',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5516376d5ed161_82716219',
  'variables' => 
  array (
    'lang' => 0,
    'title' => 0,
    'siteurl' => 0,
    'option' => 0,
    'menu' => 0,
    'ads' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5516376d5ed161_82716219')) {function content_5516376d5ed161_82716219($_smarty_tpl) {?><?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; echo smarty_php_tag(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

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
<?php if (isset($_smarty_tpl->tpl_vars["menu"])) {$_smarty_tpl->tpl_vars["menu"] = clone $_smarty_tpl->tpl_vars["menu"];
$_smarty_tpl->tpl_vars["menu"]->value = TPL::getMenu(); $_smarty_tpl->tpl_vars["menu"]->nocache = null; $_smarty_tpl->tpl_vars["menu"]->scope = 3;
} else $_smarty_tpl->tpl_vars["menu"] = new Smarty_variable(TPL::getMenu(), null, 3);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars["menu"] = clone $_smarty_tpl->tpl_vars["menu"]; $_ptr = $_ptr->parent; }
Smarty::$global_tpl_vars["menu"] = clone $_smarty_tpl->tpl_vars["menu"];?>
<?php if (isset($_smarty_tpl->tpl_vars["ads"])) {$_smarty_tpl->tpl_vars["ads"] = clone $_smarty_tpl->tpl_vars["ads"];
$_smarty_tpl->tpl_vars["ads"]->value = TPL::getADS(); $_smarty_tpl->tpl_vars["ads"]->nocache = null; $_smarty_tpl->tpl_vars["ads"]->scope = 3;
} else $_smarty_tpl->tpl_vars["ads"] = new Smarty_variable(TPL::getADS(), null, 3);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars["ads"] = clone $_smarty_tpl->tpl_vars["ads"]; $_ptr = $_ptr->parent; }
Smarty::$global_tpl_vars["ads"] = clone $_smarty_tpl->tpl_vars["ads"];?>
<?php if (isset($_smarty_tpl->tpl_vars["catparent"])) {$_smarty_tpl->tpl_vars["catparent"] = clone $_smarty_tpl->tpl_vars["catparent"];
$_smarty_tpl->tpl_vars["catparent"]->value = TPL::getListCatFooter(); $_smarty_tpl->tpl_vars["catparent"]->nocache = null; $_smarty_tpl->tpl_vars["catparent"]->scope = 3;
} else $_smarty_tpl->tpl_vars["catparent"] = new Smarty_variable(TPL::getListCatFooter(), null, 3);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars["catparent"] = clone $_smarty_tpl->tpl_vars["catparent"]; $_ptr = $_ptr->parent; }
Smarty::$global_tpl_vars["catparent"] = clone $_smarty_tpl->tpl_vars["catparent"];?>
<?php if (isset($_smarty_tpl->tpl_vars["social"])) {$_smarty_tpl->tpl_vars["social"] = clone $_smarty_tpl->tpl_vars["social"];
$_smarty_tpl->tpl_vars["social"]->value = TPL::getSocialLink(); $_smarty_tpl->tpl_vars["social"]->nocache = null; $_smarty_tpl->tpl_vars["social"]->scope = 3;
} else $_smarty_tpl->tpl_vars["social"] = new Smarty_variable(TPL::getSocialLink(), null, 3);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars["social"] = clone $_smarty_tpl->tpl_vars["social"]; $_ptr = $_ptr->parent; }
Smarty::$global_tpl_vars["social"] = clone $_smarty_tpl->tpl_vars["social"];?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
> <!--<![endif]-->
    <head>
        <meta http-equiv="Cache-control" content="no-store; no-cache"/>
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Expires" content="0"/>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta name="robots" content="index, follow" /> 
        <meta name="googlebot" content="index, follow" />
        <meta name="bingbot" content="index, follow" />
        <meta name="geo.region" content="VN" />
        <meta name="geo.position" content="14.058324;108.277199" />
        <meta name="ICBM" content="14.058324, 108.277199" />
        <meta property="fb:app_id" content="248263725370755" />

        
        <!--[if lte IE 7]>
        <script type="text/javascript">
            window.location.href = "<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/ie7";
        </script>            
        <![endif]-->

    
    <link rel="canonical" href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/source/<?php echo $_smarty_tpl->tpl_vars['source_cached']->value['id'];?>
/" />

    <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['option']->value->keywords;?>
" />
    <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['option']->value->description;?>
" />

    <meta property="og:description" content="<?php echo $_smarty_tpl->tpl_vars['option']->value->description;?>
" />

    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="blog" />
    <meta property="og:title" content="<?php echo $_smarty_tpl->tpl_vars['source_cached']->value['name'];?>
" />
    <meta property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/source/<?php echo $_smarty_tpl->tpl_vars['source_cached']->value['id'];?>
/" />
    <meta property="og:site_name" content="<?php echo $_smarty_tpl->tpl_vars['source_cached']->value['name'];?>
" />

    
    <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/static/css/common.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/static/css/style.css" rel="stylesheet" type="text/css"/>

    <link rel="icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['option']->value->favicon;?>
" />


<script>
    var siteurl = '<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
';
</script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/static/js/bootstrap.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/static/js/jquery.bxslider.min.js"></script>


<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/css/ie.css" type="text/css" media="all" />
<![endif]-->
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
    <!-- begin top -->
    <div class="header-top">
        <div class="container">
            <?php echo $_smarty_tpl->tpl_vars['menu']->value['second_menu'];?>

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
                <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['option']->value->logo;?>
" />
                </a>
            </div>
            <div class="main-menu">
                <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
">Thông tin</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/source/">Nguồn tin</a>
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
                    <?php echo $_smarty_tpl->tpl_vars['menu']->value['primary_menu'];?>

                </div>
            </div>
        </div>
    </div>
    <!-- end header -->
    <!-- begin main -->
    <div class="main">
    

    <div class="container source-page">
        <div class="title">
            <span>Có <?php echo $_smarty_tpl->tpl_vars['count']->value;?>
 nguồn tin</span>
        </div>
        <div class="source-list">
            <?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['s']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sources']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['s']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value) {
$_smarty_tpl->tpl_vars['s']->_loop = true;
 $_smarty_tpl->tpl_vars['s']->index++;
?>
                <div class="pull-left col-330 <?php if ($_smarty_tpl->tpl_vars['s']->index%3==0) {?>ml0<?php }?>">
                    <div class="thumb">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/source/<?php echo $_smarty_tpl->tpl_vars['s']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['s']->value['name'];?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['s']->value['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['s']->value['name'];?>
">
                        </a>
                    </div>
                    <div class="details">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/source/<?php echo $_smarty_tpl->tpl_vars['s']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['s']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['s']->value['name'];?>
</a>
                        <p class="post-count"><?php echo $_smarty_tpl->tpl_vars['s']->value['countpost'];?>
 tin bài</p>
                        <p class="mt10">
                            <span class="icon pull-left">
                                <img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['s']->value['website'];?>
" />
                            </span>
                            <a class="source-link pull-left" href="http://<?php echo $_smarty_tpl->tpl_vars['s']->value['website'];?>
"><?php echo $_smarty_tpl->tpl_vars['s']->value['website'];?>
</a>
                        </p>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>

</div>
<!-- begin quang cao full -->
<div class="container bcqc-full">
    <?php echo $_smarty_tpl->tpl_vars['ads']->value->ads_home_footer;?>

</div>
<!-- end quang cao full -->
</div>
<!-- end main -->
<!-- doi tac -->
<div class="brand container">
    <div class="slide-logo">
        <?php echo $_smarty_tpl->tpl_vars['menu']->value['footer_menu'];?>

    </div>
</div>
<!-- end doi tac -->
<!-- begin footer -->
<div class="footer">

    <?php echo $_smarty_tpl->getSubTemplate ('template/footer-category.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <!-- end footer sub -->
    <div class="container">
        <div class="footer-info">
            <div class="pull-left col-300">
                <img src="<?php echo $_smarty_tpl->tpl_vars['option']->value->logo_footer;?>
" />
            </div>
            <div class="pull-right col-700">
                <div class="pull-left info">
                    <?php echo $_smarty_tpl->tpl_vars['option']->value->footer_info;?>

                </div>
                <div class="pull-left">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['option']->value->logo_chuquan;?>
" width="200" />
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>



</div>
<!-- end footer -->



<!-- script references -->


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
</html><?php }} ?>
