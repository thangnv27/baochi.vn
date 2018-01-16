{extends file="layout.tpl"}
{block name="ads_head"}
    <div class="advertisement-468-60">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- ndt mobile tinhot top2 -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:320px;height:50px"
             data-ad-client="ca-pub-8791311737735591"
             data-ad-slot="1173633276"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    {/block}

{block name="body"}
    <div class="container home">
        <div class="home-link">
            {if $smarty.session.user_logged_in == null}
                <div style="text-align: center"><a data-ajax="false" href="{$siteurl}/user/login_facebook/" class="ui-btn-text btn-login-fb" title="Đăng nhập bằng Facebook"><img src="{$siteurl}/public/mobile/img/btn_login_fb.png" /></a></div>
                    {else}
                <div class="weblist">
                    <h3 class="weblist-head">Web của bạn</h3>
                    <ul class="weblist-ul">
                        <li>
                            <ul class="link-cat-sub">
                                {if $userlink != null}
                                    {foreach $userlink as $link}
                                        <li class="link-item">
                                            <span class="favicon16" onclick="details_link({$link['id']} );"><img width="16" height="16" title="{$link['title']}" src="{$link['thumbnail']}"></span>
                                            <a class="link-item-a" href="{$siteurl}/link/{$link['slug']}/" target="_blank">
                                                <span>{$link['title']}</span>
                                            </a>
                                        </li>
                                    {/foreach}
                                {/if}
                            </ul>
                        </li>
                    </ul>
                </div>
            {/if}
        </div>
        <div class="advertisement-468-60">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- ndt mobile dba canhan -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:320px;height:50px"
                 data-ad-client="ca-pub-8791311737735591"
                 data-ad-slot="5324631278"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
{/block}
{block name="script"}
    <script type="text/javascript" src="{$siteurl}/public/js/jquery.validate.js"></script>
    <script type="text/javascript">

        function details_link( link_id ) {
            window.location.href = siteurl + '/details/mydetails?id=' + link_id;
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