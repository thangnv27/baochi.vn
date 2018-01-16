<?php /* Smarty version Smarty-3.1.17, created on 2015-03-28 14:37:57
         compiled from "/home/customer/domains/baochi.vn/public_html/app/view/default/template/footer-category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:93460584855162479a7bfe6-41950807%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8cedf2a74b556958905980e96f439003b4cede8a' => 
    array (
      0 => '/home/customer/domains/baochi.vn/public_html/app/view/default/template/footer-category.tpl',
      1 => 1427528272,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '93460584855162479a7bfe6-41950807',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_55162479b41e76_94343804',
  'variables' => 
  array (
    'social' => 0,
    'siteurl' => 0,
    'catparent' => 0,
    'cp' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55162479b41e76_94343804')) {function content_55162479b41e76_94343804($_smarty_tpl) {?><div class="container">
    <div class="footer-tool">
        <div class="col-330">
            <div class="social">
                <a target="_blank" href='<?php echo $_smarty_tpl->tpl_vars['social']->value->social_fb;?>
' class="fb"><img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/static/images/icon/fb.png" /></a>
                <a target="_blank" href='<?php echo $_smarty_tpl->tpl_vars['social']->value->social_google;?>
' class="google"><img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/static/images/icon/google.png" /></a>
                <a target="_blank" href='<?php echo $_smarty_tpl->tpl_vars['social']->value->social_linkedin;?>
' class="linkin"><img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/static/images/icon/in.png" /></a>
                <a target="_blank" href='<?php echo $_smarty_tpl->tpl_vars['social']->value->social_twitter;?>
' class="twitter"><img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/static/images/icon/twitter.png" /></a>
                <a target="_blank" href='<?php echo $_smarty_tpl->tpl_vars['social']->value->social_instagram;?>
' class="instagram"><img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/static/images/icon/instagram.png" /></a>
                <a target="_blank" href='<?php echo $_smarty_tpl->tpl_vars['social']->value->social_youtube;?>
' class="youtube"><img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/static/images/icon/youtube.png" /></a>
                <a target="_blank" href='<?php echo $_smarty_tpl->tpl_vars['social']->value->social_pinterest;?>
' class="pinterest"><img src="<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/public/static/images/icon/pinterest.png" /></a>
            </div>
        </div>
        <div class="col-330">
            <div class="footer-link">
                <a href="#" class="nhantin">Nhận bản tin</a>
                <a href="#" class="mobile">Phiên bản Mobile</a>
                <a href="#" class="guibai">Gửi bài viết</a>
            </div>
        </div>
        <div class="col-330 pull-right footer-link-right">
            <a href="#" class="rss">Rss</a>
            <a href="#" class="quangcao">Quảng cáo</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php  $_smarty_tpl->tpl_vars['cp'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cp']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['catparent']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cp']->key => $_smarty_tpl->tpl_vars['cp']->value) {
$_smarty_tpl->tpl_vars['cp']->_loop = true;
?>
        <div class="col-footer">
            <h3><a href='<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/category/<?php echo $_smarty_tpl->tpl_vars['cp']->value['slug'];?>
'><?php echo $_smarty_tpl->tpl_vars['cp']->value['name'];?>
</a></h3>
            <ul class="cat">
                <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cp']->value['childs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                    <li><a href='<?php echo $_smarty_tpl->tpl_vars['siteurl']->value;?>
/category/<?php echo $_smarty_tpl->tpl_vars['c']->value['slug'];?>
'><?php echo $_smarty_tpl->tpl_vars['c']->value['name'];?>
</a></li>
                    <?php } ?>
            </ul>
        </div>
    <?php } ?>
    <div class="clearfix"></div>

</div><?php }} ?>
