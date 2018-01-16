{extends file="layout.tpl"}
{block name="body"}
    <div class="main">
        <div class="link-details">
            <h2>{$link['title']}</h2>
            <a class="add-favor" onclick="addFavoriteLink({$link['id']});" style="cursor: pointer;">Thêm trang này vào danh sách riêng của bạn</a>
            <ul class="social-links">
                <li>Chia sẻ</li>
                <li class="facebook-link"><a target="_blank" href="http://www.facebook.com/sharer.php?u={$siteurl}/link/vnexpress-net/&amp;t=VNexpress.net">Facebook</a></li>
                <li class="gplus-link"><a target="_blank" href="https://plus.google.com/share?url={$siteurl}/link/vnexpress-net/">Google+</a></li>
                <li class="email-link"><a target="_blank" href="mailto:?subject=VNexpress.net&amp;body=Giới thiệu với bạn trang %3Ca%20href%3D%27{$siteurl}/link/vnexpress-net/%27%3EVNexpress.net%3C/a%3E%0D%0ALink này được giới thiệu bởi %3Ca%20href%3D%22http%3A//nguoiduatin.net/%22%3Enhững trang web Việt Nam%3C/a%3E. Hãy follow chúng tôi %3Ca%20href%3D%22https://www.facebook.com/nhungtrangwebvietnam%22%3Etại đây%3C/a%3E để cập những website hay nhất và những tin tức nóng hổi.">Email</a></li>
                <li class="xem-link"><a target="_blank" href="{$siteurl}/link/{$link['slug']}"><b>Truy cập</b></a></li>
            </ul>
            <div class="clearfix"></div>
            <form class="frmReport-{$link['id']}" id="frmReport" method="post">
                <ul class="check-list clearfix">
                    <li><label><input type="checkbox" name="le" /> Báo link bị lỗi, hỏng</label></li>
                    <li><label><input type="checkbox" name="ce" /> Báo up sai chuyên mục</label></li>
                    <li><label><input type="checkbox" name="sex" /> Báo nội dung xấu, đồ trụy</label></li>
                    <li><label><input type="checkbox" name="wl" /> Web chất lượng thấp</label></li>
                    <li><label><input type="checkbox" name="spam" /> Báo spam</label></li>
                    <li><label><input type="checkbox" name="ec" /> Lý do khác</label></li>
                </ul>
                <input type="hidden" value="{$link['id']}" name="link_id">
                <div style="margin-bottom: 10px" class="contact-button">
                    <div class="g-recaptcha" data-sitekey="6Lf8qf8SAAAAAGkPErXQtqIu88T3vE36dU1CyF6c"></div>
                    {*<input type="text" style="border: 1px solid #ccc;padding: 5px; float: left;" name="captcha">
                    <img width="100" height="30" src="{$siteurl}/public/captcha.php">
                    <br/>*}
                    <input type="button" value="Gửi đi" class="" id="submit" />
                </div>
            </form>
        </div>
    </div>
{/block}
{block name="script"}
    <script type="text/javascript" src="{$siteurl}/public/js/jquery.validate.js"></script>
    <script type="text/javascript">
        $("#submit").click( function() {
            $.ajax( {
                url: siteurl + "/welcome/send_report", type: "POST", dataType: "json", cache: false,
                data: $('#frmReport').serialize(),
                success: function( response, textStatus, XMLHttpRequest ) {
                    if ( response && response.status == 'success' ) {
                        alert( response.message );
                        $('#frmReport').reset();
                    } else if ( response && response.status == 'error' ) {
                        alert( response.message );
                    }
                },
                error: function( MLHttpRequest, textStatus, errorThrown ) {
                    alert( errorThrown );
                },
                complete: function() {
                }
            } );
            return false;
        });
        

        function addFavoriteLink( link_id ) {
            $.ajax( {
                url: siteurl + "/welcome/add_favorite_link", type: "POST", dataType: "json", cache: false,
                data: {
                    link_id: link_id
                },
                success: function( response, textStatus, XMLHttpRequest ) {
                    if ( response && response.status == 'success' ) {
                        alert( response.message );
                    } else if ( response && response.status == 'error' ) {
                        alert( response.message );
                    }
                },
                error: function( MLHttpRequest, textStatus, errorThrown ) {
                    alert( errorThrown );
                },
                complete: function() {
                }
            } );
        }
        function removeFavoriteLink( link_id ) {
            $.ajax( {
                url: siteurl + "/welcome/mobile_remove_favorite_link", type: "POST", dataType: "json", cache: false,
                data: {
                    link_id: link_id
                },
                success: function( response, textStatus, XMLHttpRequest ) {
                    if ( response && response.status == 'success' ) {
                        alert( response.message );
                        $( ".link-cat-sub" ).html( response.favorites ).html();

                    } else if ( response && response.status == 'error' ) {
                        alert( response.message );
                    }
                },
                error: function( MLHttpRequest, textStatus, errorThrown ) {
                    alert( errorThrown );
                },
                complete: function() {
                }
            } );
        }
    </script>
{/block}