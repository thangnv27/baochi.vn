<?php /* Smarty version Smarty-3.1.17, created on 2015-03-30 03:57:36
         compiled from "/home/customer/domains/baochi.vn/public_html/app/view/default/ie7.tpl" */ ?>
<?php /*%%SmartyHeaderCode:892989591551867400ea271-14643372%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2f3afc2be1cd719abc5396a48c28989231bffd6f' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/default/ie7.tpl',
      1 => 1426647461,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '892989591551867400ea271-14643372',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'siteurl' => 0,
    'menu' => 0,
    'webhay' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_55186740257cc5_55484118',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55186740257cc5_55484118')) {function content_55186740257cc5_55484118($_smarty_tpl) {?><?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; echo smarty_php_tag(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#" dir="ltr" lang="vi-VN">
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/ie7/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/ie7/reset.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" language="JavaScript">
            // Set Bookmark
            function bookmark_us(){
                /*
                // firefox
                if (window.sidebar)
                    window.sidebar.addPanel(location.href, document.title, "");
                // opera
                else if(window.opera && window.print){
                    var elem = document.createElement('a');
                    elem.setAttribute('href',location.href);
                    elem.setAttribute('title',document.title);
                    elem.setAttribute('rel','sidebar');
                    elem.click();
                }
                // ie
                else if(document.all)
                    window.external.AddFavorite(location.href, document.title);
                */
               alert("Nhấn Ctrl + D để lưu vào danh sách yêu thích của bạn!");
            }
            //End Set Bookmark
        </script>
    </head>
    <body>
        <div class="container">
            <div id="header">
                <div id="top-banner">
                    <img alt="" src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/ie7/images/top-banner.jpg" />
                    <div class="top-conner-box clearfix">
                        <a href="" onclick="this.style.behavior = 'url(#default#homepage)';
                                this.setHomePage('index.html');" class="set-homepage">Đặt ntwvn.com làm trang chủ</a>
                        <a class="signin" href="#">Đăng nhập bằng TK Facebook</a> 
                        <span class="right-corner"></span> 
                        <span class="left-corner"></span>
                    </div>
                    <p>NHỮNG TRANG WEB ĐƯỢC YÊU THÍCH NHẤT VIỆT NAM</p>
                </div>
                <div id="main-nav">
                    <?php echo $_smarty_tpl->tpl_vars['menu']->value['primary_menu'];?>
<!--main-menu-->
                </div>

            </div>
            <div class="search">
                <div class="sleft">
                    <div style="margin-bottom: 5px;" class="fb-follow" data-href="https://www.facebook.com/nhungtrangwebvietnam" data-colorscheme="light" data-layout="button_count" data-show-faces="false"></div>
                    <!-- Đặt thẻ này vào phần đầu hoặc ngay trước thẻ đóng phần nội dung của bạn. -->
                    <script src="https://apis.google.com/js/platform.js" async defer>
                        
                    </script>

                    <!-- Đặt thẻ này vào nơi bạn muốn tiện ích con kết xuất. -->
                    <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/u/0/112988584468229775831" data-rel="author"></div>
                    
                </div>
                <div class="scenter">
                    <form target="google_window" action="http://www.google.com.vn/search" method="get">
                        <input class="t-submit" type="text" name="q" id="search" value="Tìm kiếm với google" 
                               onclick="if (this.value === this.defaultValue)
                                           this.value = '';"
                               onblur="if (this.value === '')
                                           this.value = this.defaultValue;"/> 
                        <input type="submit" id="ssearch" class="btn-submit" value="" />
                    </form>

                </div>
                <div class="scenter">
                    <form action="http://1tudien.com/" method="get" target="_blank">
                        <input class="t-submit" name="w" type="text" id="t-translate" value="Tra từ Anh - Pháp - Việt" 
                               onclick="if (this.value === this.defaultValue)
                                           this.value = '';"
                               onblur="if (this.value === '')
                                           this.value = this.defaultValue;"/> 
                        <input type="submit" id="translate" class="btn-submit" value=""/>
                    </form>
                </div>
            </div>

            <div class="main">
                <div class="m-left">
                    <div class="tr-ads">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- ndt ie6 top -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:160px;height:600px"
                             data-ad-client="ca-pub-8791311737735591"
                             data-ad-slot="6391712070"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                    <div class="tr-ads">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- ndt ie6 mid -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:160px;height:600px"
                             data-ad-client="ca-pub-8791311737735591"
                             data-ad-slot="1821911678"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                    <div class="tr-ads">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- ndt ie6 bottom -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:160px;height:600px"
                             data-ad-client="ca-pub-8791311737735591"
                             data-ad-slot="6252111270"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
                <div class="m-right">
                   <?php echo $_smarty_tpl->tpl_vars['webhay']->value;?>

                </div>
            </div>

            <div class="footer">
                <ul>
                    <li>
                        <a href="mailto:nhungtrangwebvietnam@gmail.com">
                            Liên hệ với web master
                        </a>
                    </li>
                    <li>
                        <a href="mailto:nhungtrangwebvietnam@gmail.com">
                            Báo link hỏng
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/?switch_theme=mobile">
                            Phiên bản mobile
                        </a>
                    </li>
                    <li class="no-border">
                        <a href="#" onclick="this.style.behavior = 'url(#default#homepage)';
                                this.setHomePage('<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
');">
                            Đặt ntwvn.com làm trang chủ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    </body>
</html>
<?php }} ?>
