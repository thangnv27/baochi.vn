<div class="header">
    <div class="logo">
        <a href="{$siteurl}" title="{$option->name}"><img alt="{$option->name}" src="{$siteurl}/public/images/logo2.png" /></a>
    </div><!--/.logo-->
    <div class="google-search">
        <form target="google_window" action="http://www.google.com.vn/search" method="get">
            <a href="http://www.google.com/"><img border="0" alt="Google" src="http://www.google.com/images/errors/logo_sm_2.png"/></a>
            <input type="text" id="sbi" value="Tìm kiếm với Google" maxlength="255" size="20" name="q" 
                  onBlur="if (this.value == '') this.value = this.defaultValue;" onFocus="if (this.value == this.defaultValue) this.value = '';" />
            <input type="submit" id="sbb" value="" name="sa">
        </form>
    </div><!--/.google-search-->
    <div class="toplinks">
        <a href="{$siteurl}" title="{$option->name}">Web hay</a> | 
        <a href="http://tamdiem.today" title="Tâm điểm">Tâm điểm</a> | 
        <a href="#" title="Tin đọc nhiều">Tin đọc nhiều</a> | 
        {if $smarty.session.user_logged_in == null}
            <a href="{$siteurl}/user/login_facebook/">Đăng nhập</a>
        {else}
            <a href="{$siteurl}/user/logout/">Thoát</a>
        {/if}
    </div>
    <div class="clear"></div>
    <div class="menu">
        <a href="#" title="Xã hội">Xã hội</a> | 
        <a href="#" title="Văn hoá">Văn hoá</a> | 
        <a href="#" title="Đời sống">Đời sống</a> | 
        <a href="#" title="Thể thao">Thể thao</a> | 
        <a href="#" title="Công nghệ">Công nghệ</a> | 
        <a href="#" title="Quân sự">Quân sự</a>
    </div>
</div>
<!-- /.header -->