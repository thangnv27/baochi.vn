{php}
include(APP_PATH . 'view' . DS . THEME_NAME . DS . 'functions.php');
{/php}
{assign var="lang" value=Language::$lang_code}
{assign var="siteurl" value=Registry::$siteurl scope="global"}
{assign var="option" value=TPL::getSiteOption() scope="global"}
{assign var="contact" value=TPL::getContactInfo() scope="global"}
{assign var="menu" value=TPL::getMenu() scope="global"}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#" dir="ltr" lang="vi-VN">
    <head>
        <title>{$title}</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="{$siteurl}/public/ie7/style.css" rel="stylesheet" type="text/css"/>
        <link href="{$siteurl}/public/ie7/reset.css" rel="stylesheet" type="text/css"/>
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
                    <img alt="" src="{$siteurl}/public/ie7/images/top-banner.jpg" />
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
                    {$menu['primary_menu']}<!--main-menu-->
                </div>

            </div>
            <div class="search">
                <div class="sleft">
                    <div style="margin-bottom: 5px;" class="fb-follow" data-href="https://www.facebook.com/nhungtrangwebvietnam" data-colorscheme="light" data-layout="button_count" data-show-faces="false"></div>
                    <!-- Đặt thẻ này vào phần đầu hoặc ngay trước thẻ đóng phần nội dung của bạn. -->
                    <script src="https://apis.google.com/js/platform.js" async defer>
                        {*                        {lang: 'vi'}*}
                    </script>

                    <!-- Đặt thẻ này vào nơi bạn muốn tiện ích con kết xuất. -->
                    <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/u/0/112988584468229775831" data-rel="author"></div>
                    {*                    <img class="img_bot" src="{$siteurl}/public/ie7/images/go_rank.png" alt=""/>*}
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
                   {$webhay}
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
                        <a href="{$siteurl}/?switch_theme=mobile">
                            Phiên bản mobile
                        </a>
                    </li>
                    <li class="no-border">
                        <a href="#" onclick="this.style.behavior = 'url(#default#homepage)';
                                this.setHomePage('{$siteurl}');">
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
