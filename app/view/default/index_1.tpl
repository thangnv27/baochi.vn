{extends file="layout.tpl"}
{block name="stylesheet"}
    <link href="{$siteurl}/public/style.css" rel="stylesheet" media="all" />
{/block}
{block name="meta"}
    <link rel="canonical" href="{$siteurl}/" />

    <meta name="keywords" content="{$option->keywords}" />
    <meta name="description" content="{$option->description}" />

    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{$title}" />
    <meta property="og:url" content="{$siteurl}" />
    <meta property="og:site_name" content="{$option->name}" />
    <meta property="og:description" content="{$option->description}" />
{/block}
{block name="home-news"}
    <!-- begin top news -->
    <div class="container top-news">
        <div class="pull-left col-700">
            <div class="slider-news">
                <ul class="bxslider">
                    <li>
                        <div class="col-slider pdl0">
                            <div class="bg"></div>
                            <a href="#">
                                <img src="http://img.s-msn.com/tenant/amp/entityid/AA9OzMT.img?h=415&w=352&m=6&q=60&u=t&o=t&l=f&f=jpg&x=1481&y=279" />
                            </a>
                            <div class="sl-info">
                                <a href="#">
                                    <h3 class="title">Chào mừng bạn đến với website tin tức tổng hợp baochi.vn</h3>
                                </a>
                                <p class="source">Dantri.vn</p>
                            </div>
                        </div>
                        <div class="col-slider">
                            <div class="bg"></div>
                            <a href="#">
                                <img src="http://img.s-msn.com/tenant/amp/entityid/AA9OzMT.img?h=415&w=352&m=6&q=60&u=t&o=t&l=f&f=jpg&x=1481&y=279" />
                            </a>
                            <div class="sl-info">
                                <a href="#">
                                    <h3 class="title">Chào mừng bạn đến với website tin tức tổng hợp baochi.vn</h3>
                                </a>
                                <p class="source">Dantri.vn</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="col-slider pdl0">
                            <p>2A</p>
                        </div>
                        <div class="col-slider">
                            <p>2B</p>
                        </div>
                    </li>
                    <li>
                        <div class="col-slider pdl0">
                            <p>3A</p>
                        </div>
                        <div class="col-slider">
                            <p>3B</p>
                        </div>
                    </li>
                </ul>
                <div class="outside">
                    <p><span id="slider-prev"></span><span id="slider-next"></span></p>
                </div>
            </div>
        </div>
        <div class="pull-right col-300">
            <div class="bcqc mb15">
                <a href="#">
                    <img src="{$siteurl}/public/static/imgtmp/846.jpg" />
                </a>
            </div>
            <div class="bcqc">
                <a href="#">
                    <img src="http://placehold.it/300x125/ccc/fff/&text=ADS+HERE" />
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end top news 
{/block}
{block name="body"}
    <div id="headlines">
        <div class="wrapper">
            <span class="title">Headline: </span>
            <marquee style="width: 729px;" direction="left" scrolldelay="8" scrollamount="1" onMouseOut="this.start()" onMouseOver="this.stop()">
    {$headline}
</marquee>
</div>
</div>
<div id="search">
<div class="wrapper">
<div class="word-search">
    <form target="_blank" action="http://1tudien.com/" method="get" name="vdict"> 
        <input type="text" maxlength="100" onBlur="if (this.value == '')
                    this.value = this.defaultValue;" onFocus="if (this.value == this.defaultValue)
                                this.value = '';" value="Tra từ A-F-V" id="word" name="w">  
        <input type="submit" value="" name="Submit"/>
    </form>
</div><!--word-search-->
    <div class="google-search">
        <form target="google_window" action="http://www.google.com.vn/search" method="get">
            <a href="http://www.google.com/"><img border="0" alt="Google" src="http://www.google.com/images/errors/logo_sm_2.png"/></a>
            <input type="text" id="sbi" value="Tìm kiếm với Google" maxlength="255" size="20" name="q" 
                   onBlur="if (this.value == '')
                               this.value = this.defaultValue;" onFocus="if (this.value == this.defaultValue)
                                           this.value = '';" />
            <input type="submit" id="sbb" value="" name="sa">
        </form>
    </div><!--google-search-->
    <div class="xu-huong">
        <span class="title">Xu hướng:</span>
        {foreach $xuhuong as $item}
            <a href="{$item['link']}" title="{$item['title']}" target="_blank">{$item['title']}</a>&nbsp;
        {/foreach}
    </div><!--Xu huong-->
</div>
</div>
<div class="wrapper">
    <div id="main-left">
        <div class="logo">
            <a href="{$siteurl}" title="{$option->name}"><img alt="{$option->name}" src="{$siteurl}/public/images/logo.png" /></a>
        </div>
        <div class="home-menu">
            <p>
                <a href="http://www18.24h.com.vn/ttcb/thoitiet/thoitiet.php?utm_source=24h.com.vn&utm_medium=banner&utm_campaign=click" title="Thời tiết" target="_blank" rel="nofollow">Thời tiết</a>
                <a href="http://banggia2.ssi.com.vn/" title="Giá CK" target="_blank" rel="nofollow">Giá CK</a>
            </p>
            <p>
                <a href="http://www.vietcombank.com.vn/ExchangeRates/Default.aspx" title="Tỷ giá" target="_blank" rel="nofollow">Tỷ giá</a>
                <a href="http://www.sjc.com.vn/" title="Giá vàng" target="_blank" rel="nofollow">Giá vàng</a>
            </p>
            <p>
                <a href="http://vtv.vn/lich-phat-song.htm" title="Lịch TV" target="_blank" rel="nofollow">Lịch TV</a>
                <a href="http://fptplay.net/livetv/vtv1" title="TV Trực tuyến" target="_blank" rel="nofollow" style="width: 84px">TV Trực tuyến</a>
            </p>
            <div class="clear"></div>
        </div>
        <div class="mt10 pdl4">
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
        <div class="user-guide">
            <ul>
                <li><span>Đăng nhập bằng Facebook để tạo danh bạ riêng của bạn. Đăng nhập <a href="{$siteurl}/user/login_facebook/" title="Đăng nhập Facebook">tại đây</a>.</span></li>
                <li><span>Click vào icon trên mỗi link để thêm/bớt link khỏi thanh bạ riêng. Báo link lỗi hoặc đưa ra ý kiến của riêng bạn.</span></li>
                <li><span>Theo dõi để được cập nhật link, tin mới nhất. Theo dõi <a href="{$option->fanpage_url}" title="Theo dõi">tại đây</a>.</span></li>
            </ul>
        </div>
        <div class="pdl4">
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
    </div>
    <div id="main-right">
        <!-- Ad Main Top-->
        <div class="main-right-top t_center">
            <div class="fl" style="width: 728px">
                <img src="{$siteurl}/public/images/ad728x90.png" />
            </div>
            <div class="fr" style="width: 74px">
                <div class="login">
                    {if $smarty.session.user_logged_in == null}
                        <a href="{$siteurl}/user/login_facebook/">Đăng nhập</a>
                    {else}
                        <a href="{$siteurl}/user/logout/">Thoát</a>
                    {/if}
                </div>
                <div class="fb-like" data-href="{$option->fanpage_url}" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
            </div>
            <div class="clear"></div>
        </div>
        <!-- /Ad Main Top-->

        <div class="col1">
            <div class="list-web">
                {$webhay}
                <div id="countrydivcontainer" class="web-tab-container">
                </div>
                <script type="text/javascript">
                    var countries = new ddajaxtabs("countrytabs", "countrydivcontainer");
                    countries.setpersist(true);
                    countries.setselectedClassTarget("link"); //"link" or "linkparent"
                    countries.init();
                    countries.onajaxpageload = function (pageurl) {
                        jQuery(".inline").colorbox({
                            inline: true,
                            width: "700px",
                            onComplete: function () {
                                var cbox = document.getElementById('cboxLoadedContent');
                                if (jQuery(cbox).find(".fb-comments").length === 0) {
                                    var html = '<div class="fb-comments" data-href="' + jQuery(cbox).find('input[name="url"]').val() + '" data-width="100%" data-numposts="1" data-colorscheme="light"></div>';
                                    jQuery(cbox).find(".textarea-block textarea").remove();
                                    jQuery(cbox).find(".textarea-block").append(html);
                                }
                                FB.XFBML.parse( );

                                if (jQuery(cbox).find("input[class^='sendReport-']").length > 0) {
                                    jQuery(cbox).find("input[class^='sendReport-']").click(function () {
                                        var form = jQuery(cbox).find("form[class^='frmReport-']");
                                        jQuery.ajax({
                                            url: siteurl + "/welcome/send_report", type: "POST", dataType: "json", cache: false,
                                            data: form.serialize(),
                                            success: function (response, textStatus, XMLHttpRequest) {
                                                if (response && response.status == 'success') {
                                                    alert(response.message);
                                                    form.get(0).reset();
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
                                        return false;
                                    });
                                }
                            }
                        });
                    };
                </script>

                {if $smarty.session.user_logged_in != null}
                    <a href="#inline-addlink" class="inline_link add-link"></a>
                    <div class="popover-box" style='display:none'>
                        <div id='inline-addlink' class="addlink-content">
                            <h3>Thêm link vào danh sách của bạn</h3>
                            <div id="addLinkResult"></div>
                            <form id="addlink-form" action="#" method="post">
                                <p class="input-block">
                                    <input type="text" value="Tiêu đề ( tối đa 100 ký tự )" onfocus="if (this.value == this.defaultValue)
                                                this.value = '';" onblur="if (this.value == '')
                                                            this.value = this.defaultValue;" id="link_subject" name="title" class="valid" maxlength="100" />
                                </p>
                                <p class="input-block">
                                    <input type="text" value="Link, vd: http://dantri.vn" onfocus="if (this.value == this.defaultValue)
                                                this.value = '';" onblur="if (this.value == '')
                                                            this.value = this.defaultValue;" id="link_url" name="link" class="valid" />
                                </p>
                                <p class="input-block">
                                    <select id="link_position" name="categories">
                                        {$categories}
                                    </select>
                                </p>
                                <p class="input-block input-code clearfix">
                                <div class="g-recaptcha" data-sitekey="6Lf8qf8SAAAAAGkPErXQtqIu88T3vE36dU1CyF6c"></div>
                                </p>
                                <p class="addlink-button clearfix">                    
                                    <input type="submit" value="Thêm" id="submit-link" class="input-submit">
                                </p>                   
                            </form>
                        </div>
                    </div>
                {/if}
            </div>
            <!-- End: List web -->
            <div class="list-web2">
                <div class="random-bookmark">
                    <div class="title">Web hay ngẫu nhiên</div>
                    {$random_links}
                </div>
                <div class="new-bookmark">
                    <div class="title">Web hay mới thêm vào danh bạ</div>
                    {$latest_links}
                </div>
            </div>
            <!-- End: List web 2 -->
        </div>
        <div class="col2">
            <div id="banner-slide">
                <ul class="bjqs">
                    {foreach $tamdiem as $post}
                        <li><a href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/"><img src="{$post['thumbnail']}" title="{$post['title']}"></a></li>
                            {/foreach}
                </ul>
            </div>
            <!-- End: Slide -->
            <div class="list-tamdiem">
                <ul>
                    {foreach $tamdiem as $post}
                        <li>
                            <a href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/" class="thumbnail" title="{$post['title']}"><img src="{$post['thumbnail']}" title="{$post['title']}"></a>
                            <a href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/" title="{$post['title']}" class="title"><h3>{$post['title']}</h3></a>
                        </li>
                    {/foreach}
                </ul>
                <div class="t_center">
                    <a href="{$siteurl}/tamdiem/" title="Xem thêm" class="view-more">Xem thêm</a>
                </div>
            </div>
            <!-- End: Tam diem -->
        </div>
        <div class="clear" style="height: 10px;"></div>

        <!-- BEGIN: News by source -->
        {$sources}
        <!-- END: News by source -->
    </div>
    <div class="clear"></div>
    <!--/Main Right-->

    <!--Tin quan tam - tam diem-->
    <div class="home-suggest">
        <h2>Có thể bạn quan tâm</h2>
        <ul>
            {foreach $tamdiem_suggest as $post}
                <li>
                    <a href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/" class="thumbnail" title="{$post['title']}"><img src="{$post['thumbnail']}" title="{$post['title']}"></a>
                    <a href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/" title="{$post['title']}" class="title"><h3>{$post['title']}</h3></a>
                </li>
            {/foreach}
        </ul>
    </div>
    <!--/Tin quan tam - tam diem-->

    {include 'footer.tpl'}
</div>
{/block}
{block name="script"}
    <script type="text/javascript">
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
{/block}