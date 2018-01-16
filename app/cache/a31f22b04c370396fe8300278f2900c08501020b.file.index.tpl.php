<?php /* Smarty version Smarty-3.1.17, created on 2015-04-08 14:34:22
         compiled from "/home/customer/domains/baochi.vn/public_html/app/view/default/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:156614426855162478919fd7-87619742%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a31f22b04c370396fe8300278f2900c08501020b' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/default/index.tpl',
      1 => 1427855920,
      2 => 'file',
    ),
    '74264c6a727bf1f7e066d9dc825fa0866fddb88c' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/default/layout.tpl',
      1 => 1428478462,
      2 => 'file',
    ),
    'ce435ccbf5ae5062889fe22b126791d2d3cef04b' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/default/template/xemnhieu.tpl',
      1 => 1426740477,
      2 => 'file',
    ),
    '7fa583fb19630b8ddca4c8191a0881dd4ebc0543' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/default/template/xahoi.tpl',
      1 => 1426759483,
      2 => 'file',
    ),
    'e94b46575b496aa62363877ebc01b7120b526b95' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/default/template/giaoduc.tpl',
      1 => 1426759533,
      2 => 'file',
    ),
    'bad634a8f5612d4481207367b230306f3fc3e709' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/default/template/kinhte.tpl',
      1 => 1426759548,
      2 => 'file',
    ),
    '2b43e708dcd77fa6257e8477ebafbdcef485a360' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/default/template/giaitri.tpl',
      1 => 1427106546,
      2 => 'file',
    ),
    '574a05bb1d711f0a2369b136e69d01d1734f10df' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/default/template/thethao.tpl',
      1 => 1426759558,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '156614426855162478919fd7-87619742',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_551624799e2731_63242993',
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
<?php if ($_valid && !is_callable('content_551624799e2731_63242993')) {function content_551624799e2731_63242993($_smarty_tpl) {?><?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; echo smarty_php_tag(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

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
/" />

    <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['option']->value->keywords;?>
" />
    <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['option']->value->description;?>
" />

    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" />
    <meta property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
" />
    <meta property="og:site_name" content="<?php echo $_smarty_tpl->tpl_vars['option']->value->name;?>
" />
    <meta property="og:description" content="<?php echo $_smarty_tpl->tpl_vars['option']->value->description;?>
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
    

    <!-- begin top news -->
    <div class="container top-news">
        <div class="pull-left col-700">
            <div class="slider-news">
                <ul class="bxslider">
                    <?php  $_smarty_tpl->tpl_vars['ps'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ps']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts_slider']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['ps']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['ps']->key => $_smarty_tpl->tpl_vars['ps']->value) {
$_smarty_tpl->tpl_vars['ps']->_loop = true;
 $_smarty_tpl->tpl_vars['ps']->index++;
?>
                        <?php if ($_smarty_tpl->tpl_vars['ps']->index%2==0) {?>
                            <li>
                                <div class="col-slider pdl0">
                                    <div class="bg"></div>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['ps']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['ps']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['ps']->value['title'];?>
" target="_blank">
                                        <img width="352" height="415" src="<?php echo $_smarty_tpl->tpl_vars['ps']->value['thumbnail'];?>
" />
                                    </a>
                                    <div class="sl-info">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['ps']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['ps']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['ps']->value['title'];?>
" target="_blank">
                                            <h3 class="title"><?php echo $_smarty_tpl->tpl_vars['ps']->value['title'];?>
</h3>
                                        </a>
                                        <p class="source"><?php echo $_smarty_tpl->tpl_vars['ps']->value['sourcename'];?>
</p>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-slider">
                                    <div class="bg"></div>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['ps']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['ps']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['ps']->value['title'];?>
" target="_blank">
                                        <img width="352" height="415" src="<?php echo $_smarty_tpl->tpl_vars['ps']->value['thumbnail'];?>
" />
                                    </a>
                                    <div class="sl-info">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['ps']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['ps']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['ps']->value['title'];?>
" target="_blank">
                                            <h3 class="title"><?php echo $_smarty_tpl->tpl_vars['ps']->value['title'];?>
</h3>
                                        </a>
                                        <p class="source"><?php echo $_smarty_tpl->tpl_vars['ps']->value['sourcename'];?>
</p>
                                    </div>
                                </div>
                            </li>   
                        <?php }?>
                    <?php } ?>
                </ul>
                <div class="outside">
                    <p><span id="slider-prev"></span><span id="slider-next"></span></p>
                </div>
            </div>
        </div>
        <div class="pull-right col-300">
            <div class="bcqc mb15">
                <?php echo $_smarty_tpl->tpl_vars['ads']->value->ads_home_top1;?>

            </div>
            <div class="bcqc">
                <?php echo $_smarty_tpl->tpl_vars['ads']->value->ads_home_top2;?>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end top news -->

    <!-- begin sub top news -->
    <div class="container sub-top-news">
        <div class="pull-left col-700">
            <?php  $_smarty_tpl->tpl_vars['ps'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ps']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['newposts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['ps']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['ps']->key => $_smarty_tpl->tpl_vars['ps']->value) {
$_smarty_tpl->tpl_vars['ps']->_loop = true;
 $_smarty_tpl->tpl_vars['ps']->index++;
?>
            <div class="pull-left col-345 mb15 <?php if ($_smarty_tpl->tpl_vars['ps']->index%2==0) {?>mr22<?php }?>">
                <div class="thumb">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['ps']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['ps']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['ps']->value['title'];?>
" target="_blank">
                        <img alt="<?php echo $_smarty_tpl->tpl_vars['ps']->value['title'];?>
" width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['ps']->value['thumbnail'];?>
">
                    </a>
                </div>
                <div class="details">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['ps']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['ps']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['ps']->value['title'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['ps']->value['title'];?>
</a>
                    <div class="mt5 source"><?php echo $_smarty_tpl->tpl_vars['ps']->value['sourcename'];?>
</div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="pull-right col-300">
            <div class="bcqc">
                <?php echo $_smarty_tpl->tpl_vars['ads']->value->ads_home_top1;?>

            </div>
            
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end sub top news -->

    

    <?php /*  Call merged included template "template/xemnhieu.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('template/xemnhieu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '156614426855162478919fd7-87619742');
content_5524d9ff0bf9c4_06691588($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "template/xemnhieu.tpl" */?>
    
    <?php /*  Call merged included template "template/xahoi.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('template/xahoi.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '156614426855162478919fd7-87619742');
content_5524d9ff147348_33600201($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "template/xahoi.tpl" */?>
    <?php /*  Call merged included template "template/giaoduc.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('template/giaoduc.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '156614426855162478919fd7-87619742');
content_5524d9ff594d52_71050533($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "template/giaoduc.tpl" */?>
    <?php /*  Call merged included template "template/kinhte.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('template/kinhte.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '156614426855162478919fd7-87619742');
content_5524d9ff6b99f7_94283780($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "template/kinhte.tpl" */?>
    <?php /*  Call merged included template "template/giaitri.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('template/giaitri.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '156614426855162478919fd7-87619742');
content_5524d9ffa74647_83141054($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "template/giaitri.tpl" */?>
    <?php /*  Call merged included template "template/thethao.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('template/thethao.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '156614426855162478919fd7-87619742');
content_5524d9ffcd7239_88380824($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "template/thethao.tpl" */?>

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

    <script type="text/javascript">
        $("select.pull-left")
                .change(function () {
                    var type = "";
                    $("select option:selected").each(function () {
                        type = $(this).val();
                    });
                    if (type == 'yahoo') {
                        $('.txt-header-search').attr('name', 'p');
                        $('.frmsearch').attr('action', 'https://vn.search.yahoo.com/search');
                    } else if (type == 'bing') {
                        $('.txt-header-search').attr('name', 'q');
                        $('.frmsearch').attr('action', 'http://www.bing.com/search');
                    } else {
                        $('.txt-header-search').attr('name', 'q');
                        $('.frmsearch').attr('action', 'http://www.google.com.vn/search');
                    }
                })
                .change();

        $('.bxslider').bxSlider({
            nextSelector: '#slider-next',
            prevSelector: '#slider-prev',
            nextText: '',
            prevText: ''
        });
        $('.tab-news-mostview').bxSlider({
            nextSelector: '#btn-next',
            prevSelector: '#btn-prev',
            nextText: '<span class="glyphicon glyphicon-chevron-right"></span>',
            prevText: '<span class="glyphicon glyphicon-chevron-left"></span>',
            minSlides: 4,
            maxSlides: 4,
            slideWidth: 240,
            slideMargin: 15
        });
    </script>


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
<?php /* Smarty version Smarty-3.1.17, created on 2015-04-08 14:34:23
         compiled from "/home/customer/domains/baochi.vn/public_html/app/view/default/template/xemnhieu.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5524d9ff0bf9c4_06691588')) {function content_5524d9ff0bf9c4_06691588($_smarty_tpl) {?><!-- begin tab news -->
<div class="container tab-news">

    <!-- Nav tabs -->
    <div class="title">
        <ul class="cat-news tintuc">
            <li>
                <h2>Xem nhiều
                    <span class="glyphicon glyphicon-chevron-right cat-arrow"></span>
                </h2>
            </li>
            <li class="pull-right btn-slider">
                <span id="btn-prev"></span><span id="btn-next"></span>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- Tab panes -->
    <div class="tab-content tab-news-content">
        <div class="tab-pane active" id="xemnhieu">
            <ul class="tab-news-ul tab-news-mostview">
                <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['hotposts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
                    <li>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                            <img height="136" width="240" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" />
                        </a>
                        <h3 class="tab-news-title">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                        </h3>
                        <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<!-- end tab news --><?php }} ?>
<?php /* Smarty version Smarty-3.1.17, created on 2015-04-08 14:34:23
         compiled from "/home/customer/domains/baochi.vn/public_html/app/view/default/template/xahoi.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5524d9ff147348_33600201')) {function content_5524d9ff147348_33600201($_smarty_tpl) {?><!-- begin block news -->
<div class="container block-news">
    <div class="title">
        <ul class="cat-news tintuc">
            <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['xahoicat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                <li>
                    <h2>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/category/<?php echo $_smarty_tpl->tpl_vars['c']->value['slug'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['name'];?>
</a>
                        <span class="glyphicon glyphicon-chevron-right cat-arrow"></span>
                    </h2>
                </li>
                <?php  $_smarty_tpl->tpl_vars['cc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['c']->value['childs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cc']->key => $_smarty_tpl->tpl_vars['cc']->value) {
$_smarty_tpl->tpl_vars['cc']->_loop = true;
?>
                    <li class="sub-cat"><a href='<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/category/<?php echo $_smarty_tpl->tpl_vars['cc']->value['slug'];?>
'><?php echo $_smarty_tpl->tpl_vars['cc']->value['name'];?>
</a></li>
                    <?php } ?>
                <?php } ?>
        </ul>
    </div>
    <div class="block-news-content">
        <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['xahoi']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['p']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['p']->index++;
?>
            <?php if ($_smarty_tpl->tpl_vars['p']->index==0) {?>
                <div class="pull-left <?php echo $_smarty_tpl->tpl_vars['p']->index;?>
 col-330 first mr22">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                        <img height="210" width="325" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
"/>
                    </a>
                    <div class="meta">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                            <h3>
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </h3>
                        </a>
                        <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                    </div>
                </div>
                <div class="pull-left <?php echo $_smarty_tpl->tpl_vars['p']->index;?>
 col-330 sub-news mr22">
                <?php } elseif (($_smarty_tpl->tpl_vars['p']->index<3)) {?>
                    <div class="item">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['p']->index==3) {?>
                    <div class="item item mb0 pdb0" style="border-bottom: none;">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                </div>
                <div class="pull-left col-330 sub-news">
                <?php } elseif (($_smarty_tpl->tpl_vars['p']->index<6)) {?>
                    <div class="item">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                <?php } elseif (($_smarty_tpl->tpl_vars['p']->index==6)) {?>
                    <div class="item item mb0 pdb0" style="border-bottom: none;">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                </div>
            <?php }?>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
</div>
<!-- end block news --><?php }} ?>
<?php /* Smarty version Smarty-3.1.17, created on 2015-04-08 14:34:23
         compiled from "/home/customer/domains/baochi.vn/public_html/app/view/default/template/giaoduc.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5524d9ff594d52_71050533')) {function content_5524d9ff594d52_71050533($_smarty_tpl) {?>
<!-- begin block news -->
<div class="container block-news">
    <div class="title">
        <ul class="cat-news tintuc">
            <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['giaoduccat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                <li>
                    <h2>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/category/<?php echo $_smarty_tpl->tpl_vars['c']->value['slug'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['name'];?>
</a>
                        <span class="glyphicon glyphicon-chevron-right cat-arrow"></span>
                    </h2>
                </li>
                <?php  $_smarty_tpl->tpl_vars['cc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['c']->value['childs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cc']->key => $_smarty_tpl->tpl_vars['cc']->value) {
$_smarty_tpl->tpl_vars['cc']->_loop = true;
?>
                    <li class="sub-cat"><a href='<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/category/<?php echo $_smarty_tpl->tpl_vars['cc']->value['slug'];?>
'><?php echo $_smarty_tpl->tpl_vars['cc']->value['name'];?>
</a></li>
                    <?php } ?>
                <?php } ?>
        </ul>
    </div>
    <div class="block-news-content">
        <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['giaoduc']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['p']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['p']->index++;
?>
            <div class="pull-left col-330 first <?php if ($_smarty_tpl->tpl_vars['p']->index<2) {?>mr22<?php }?>">
                <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                    <img height="210" width="325" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
"/>
                </a>
                <div class="meta">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                        <h3>
                            <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                        </h3>
                    </a>
                    <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                </div>
            </div>
        <?php } ?>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end block news --><?php }} ?>
<?php /* Smarty version Smarty-3.1.17, created on 2015-04-08 14:34:23
         compiled from "/home/customer/domains/baochi.vn/public_html/app/view/default/template/kinhte.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5524d9ff6b99f7_94283780')) {function content_5524d9ff6b99f7_94283780($_smarty_tpl) {?><!-- begin block news -->
<div class="container block-news">
    <div class="title">
        <ul class="cat-news tintuc">
            <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['kinhtecat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                <li>
                    <h2>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/category/<?php echo $_smarty_tpl->tpl_vars['c']->value['slug'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['name'];?>
</a>
                        <span class="glyphicon glyphicon-chevron-right cat-arrow"></span>
                    </h2>
                </li>
                <?php  $_smarty_tpl->tpl_vars['cc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['c']->value['childs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cc']->key => $_smarty_tpl->tpl_vars['cc']->value) {
$_smarty_tpl->tpl_vars['cc']->_loop = true;
?>
                    <li class="sub-cat"><a href='<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/category/<?php echo $_smarty_tpl->tpl_vars['cc']->value['slug'];?>
'><?php echo $_smarty_tpl->tpl_vars['cc']->value['name'];?>
</a></li>
                    <?php } ?>
                <?php } ?>
        </ul>
    </div>
    <div class="block-news-content">
        <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['kinhte']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['p']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['p']->index++;
?>
            <?php if ($_smarty_tpl->tpl_vars['p']->index==0) {?>
                <div class="pull-left <?php echo $_smarty_tpl->tpl_vars['p']->index;?>
 col-330 first mr22">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                        <img height="210" width="325" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
"/>
                    </a>
                    <div class="meta">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                            <h3>
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </h3>
                        </a>
                        <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                    </div>
                </div>
                <div class="pull-left <?php echo $_smarty_tpl->tpl_vars['p']->index;?>
 col-330 sub-news mr22">
                <?php } elseif (($_smarty_tpl->tpl_vars['p']->index<3)) {?>
                    <div class="item">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['p']->index==3) {?>
                    <div class="item item mb0 pdb0" style="border-bottom: none;">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                </div>
                <div class="pull-left col-330 sub-news">
                <?php } elseif (($_smarty_tpl->tpl_vars['p']->index<6)) {?>
                    <div class="item">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                <?php } elseif (($_smarty_tpl->tpl_vars['p']->index==6)) {?>
                    <div class="item item mb0 pdb0" style="border-bottom: none;">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                </div>
            <?php }?>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
</div>
<!-- end block news --><?php }} ?>
<?php /* Smarty version Smarty-3.1.17, created on 2015-04-08 14:34:23
         compiled from "/home/customer/domains/baochi.vn/public_html/app/view/default/template/giaitri.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5524d9ffa74647_83141054')) {function content_5524d9ffa74647_83141054($_smarty_tpl) {?><!-- begin block news -->
<div class="container block-news">
    <div class="title">
        <ul class="cat-news tintuc">
            <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['giaitricat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                <li>
                    <h2>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/category/<?php echo $_smarty_tpl->tpl_vars['c']->value['slug'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['name'];?>
</a>
                        <span class="glyphicon glyphicon-chevron-right cat-arrow"></span>
                    </h2>
                </li>
                <?php  $_smarty_tpl->tpl_vars['cc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['c']->value['childs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cc']->key => $_smarty_tpl->tpl_vars['cc']->value) {
$_smarty_tpl->tpl_vars['cc']->_loop = true;
?>
                    <li class="sub-cat"><a href='<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/category/<?php echo $_smarty_tpl->tpl_vars['cc']->value['slug'];?>
'><?php echo $_smarty_tpl->tpl_vars['cc']->value['name'];?>
</a></li>
                    <?php } ?>
                <?php } ?>
        </ul>
    </div>
    <div class="block-news-content">
        <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['giaitri']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['p']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['p']->index++;
?>
            <?php if ($_smarty_tpl->tpl_vars['p']->index==0) {?>
                <div class="pull-left <?php echo $_smarty_tpl->tpl_vars['p']->index;?>
 col-330 first mr22">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                        <img height="210" width="325" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
"/>
                    </a>
                    <div class="meta">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                            <h3>
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </h3>
                        </a>
                        <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                    </div>
                </div>
                <div class="pull-left <?php echo $_smarty_tpl->tpl_vars['p']->index;?>
 col-330 sub-news mr22">
                <?php } elseif (($_smarty_tpl->tpl_vars['p']->index<3)) {?>
                    <div class="item">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['p']->index==3) {?>
                    <div class="item item mb0 pdb0" style="border-bottom: none;">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                </div>
            <?php }?>
        <?php } ?>
        <div class="pull-left col-330 sub-news">
            <a href='#'>
                <img src='http://baochi.vn/public/static/imgtmp/846.jpg' />
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- end block news --><?php }} ?>
<?php /* Smarty version Smarty-3.1.17, created on 2015-04-08 14:34:23
         compiled from "/home/customer/domains/baochi.vn/public_html/app/view/default/template/thethao.tpl" */ ?>
<?php if ($_valid && !is_callable('content_5524d9ffcd7239_88380824')) {function content_5524d9ffcd7239_88380824($_smarty_tpl) {?><!-- begin block news -->
<div class="container block-news">
    <div class="title">
        <ul class="cat-news tintuc">
            <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['thethaocat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                <li>
                    <h2>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/category/<?php echo $_smarty_tpl->tpl_vars['c']->value['slug'];?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value['name'];?>
</a>
                        <span class="glyphicon glyphicon-chevron-right cat-arrow"></span>
                    </h2>
                </li>
                <?php  $_smarty_tpl->tpl_vars['cc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['c']->value['childs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cc']->key => $_smarty_tpl->tpl_vars['cc']->value) {
$_smarty_tpl->tpl_vars['cc']->_loop = true;
?>
                    <li class="sub-cat"><a href='<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/category/<?php echo $_smarty_tpl->tpl_vars['cc']->value['slug'];?>
'><?php echo $_smarty_tpl->tpl_vars['cc']->value['name'];?>
</a></li>
                    <?php } ?>
                <?php } ?>
        </ul>
    </div>
    <div class="block-news-content">
        <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['thethao']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['p']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['p']->index++;
?>
            <?php if ($_smarty_tpl->tpl_vars['p']->index==0) {?>
                <div class="pull-left <?php echo $_smarty_tpl->tpl_vars['p']->index;?>
 col-330 first mr22">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                        <img height="210" width="325" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
"/>
                    </a>
                    <div class="meta">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                            <h3>
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </h3>
                        </a>
                        <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                    </div>
                </div>
                <div class="pull-left <?php echo $_smarty_tpl->tpl_vars['p']->index;?>
 col-330 sub-news mr22">
                <?php } elseif (($_smarty_tpl->tpl_vars['p']->index<3)) {?>
                    <div class="item">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                <?php } elseif ($_smarty_tpl->tpl_vars['p']->index==3) {?>
                    <div class="item item mb0 pdb0" style="border-bottom: none;">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                </div>
                <div class="pull-left col-330 sub-news">
                <?php } elseif (($_smarty_tpl->tpl_vars['p']->index<6)) {?>
                    <div class="item">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                <?php } elseif (($_smarty_tpl->tpl_vars['p']->index==6)) {?>
                    <div class="item item mb0 pdb0" style="border-bottom: none;">
                        <div class="thumb">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <img width="150" height="95" src="<?php echo $_smarty_tpl->tpl_vars['p']->value['thumbnail'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
">
                                
                            </a>
                        </div>
                        <div class="details">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/post/<?php echo $_smarty_tpl->tpl_vars['p']->value['rss_id'];?>
-<?php echo $_smarty_tpl->tpl_vars['p']->value['slug'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>
" target="_blank">
                                <?php echo $_smarty_tpl->tpl_vars['p']->value['title'];?>

                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/<?php echo $_smarty_tpl->tpl_vars['p']->value['website'];?>
" /></span><?php echo $_smarty_tpl->tpl_vars['p']->value['sourcename'];?>
</div>
                        </div>
                    </div>
                </div>
            <?php }?>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
</div>
<!-- end block news --><?php }} ?>
