{extends file="layout.tpl"}
{block name="ads_head"}
    <div class="advertisement-468-60"> <img alt="Advertisement" src="{$siteurl}/public/mobile/img/adv-468-60.jpg"> </div>
    {/block}

{block name="body"}
    <div class="main">
        <div class="link-details">
            <h2>Chi tiết về {$link['title']}</h2>
            <a class="add-favor" onclick="removeFavoriteLink({$link['id']});" style="cursor: pointer;">Xóa link khỏi dach sách riêng</a>
            <ul class="social-links">
                <li>Chia sẻ</li>
                <li class="facebook-link"><a target="_blank" href="http://www.facebook.com/sharer.php?u={$siteurl}/link/vnexpress-net/&amp;t=VNexpress.net">Facebook</a></li>
                <li class="gplus-link"><a target="_blank" href="https://plus.google.com/share?url={$siteurl}/link/vnexpress-net/">Google+</a></li>
                <li class="email-link"><a target="_blank" href="mailto:?subject=VNexpress.net&amp;body=Giới thiệu với bạn trang %3Ca%20href%3D%27{$siteurl}/link/vnexpress-net/%27%3EVNexpress.net%3C/a%3E%0D%0ALink này được giới thiệu bởi %3Ca%20href%3D%22http%3A//nguoiduatin.net/%22%3Enhững trang web Việt Nam%3C/a%3E. Hãy follow chúng tôi %3Ca%20href%3D%22https://www.facebook.com/nhungtrangwebvietnam%22%3Etại đây%3C/a%3E để cập những website hay nhất và những tin tức nóng hổi.">Email</a></li>
                <li class="xem-link"><a target="_blank" href="{$siteurl}/link/{$link['slug']}"><b>Truy cập</b></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
{/block}
{block name="script"}
    <script type="text/javascript" src="{$siteurl}/public/js/jquery.validate.js"></script>
    <script type="text/javascript">
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
                    window.location.href = siteurl + '/user/myweb/';
                }
            } );
        }
    </script>
{/block}