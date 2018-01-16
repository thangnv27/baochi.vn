{extends file="layout.tpl"}
{block name="body"}
    <div class="page-menu" id="menu-page">
        <ul class="menu-ul">
            {if $smarty.session.user_logged_in == null}
                <li><a href="{$siteurl}/user/myweb"><span class="icon-star"></span>Danh sách website của tôi</a></li>
            {else}
                <li><a href="{$siteurl}/user/myweb"><span class="icon-star"></span>Danh sách website của {$smarty.session.user_logged_in.username}</a></li>
            {/if}
            {if $smarty.session.user_logged_in == null}
                <li><a style="cursor: pointer;" onclick="alert( 'Bạn cần đăng nhập bằng tài khoản Facebook để thực hiện chức năng này!' );"><span class="icon-star"></span>Thêm link vào danh bạ</a></li>
            {else}
                <li><a href="{$siteurl}/user/addlink"><span class="icon-star"></span>Thêm link vào danh bạ</a></li>
            {/if}
            <li><a href="{$siteurl}/mobile/webhay/"><span class="icon-star"></span>Danh sách Web HAY</a></li>
            <li><a href="{$siteurl}/news/hot/" class="a-hot"><span class="icon-news"></span>TIN HOT</a></li>
            <li><a href="{$siteurl}/news/"><span class="icon-news"></span>Tin mới</a></li>
            <li>
                <a href="#"><span class="icon-news"></span>Tin theo nguồn</a>
                <ul class="menu-ul-sub">
                    {foreach $sources as $source}
                        <li><a href="{$siteurl}/source/{$source['id']}">{$source['name']}</a></li>
                    {/foreach}
                </ul>
            </li>
            {*<li><a href="#"><span class="icon-news"></span>Tin theo chủ đề</a>
                <ul class="menu-ul-sub">
                    {foreach from=$categoriesNews key=k item=catNews}
                        <li><a href="{$siteurl}/category/{$k}">{$catNews}</a></li>
                        {/foreach}
                </ul>
            </li>*}
            <li><span class="menu-ul-li-text"><span class="icon-add-me"></span>Theo dõi chúng tôi</span>
                <ul class="menu-ul-sub follow">
                    <li><a href="{$option->fanpage_url}">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Google</a></li>
                </ul>
            </li>
            <li><a href="mailto:{$contact->email}?subject=Thư góp ý"><span class="icon-email"></span>Góp ý cho chúng tôi</a></li>
            <li><a href="mailto:{$contact->email}?subject=Thư liên hệ về việc"><span class="icon-email"></span>Liên hệ</a></li>
            <li><a href="{$siteurl}?switch_theme=desktop"><span class="icon-switch"></span>Giao diện desktop</a></li>
        </ul>

    </div>
{/block}
{block name="script"}
    <script type="text/javascript">
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
    </script>
{/block}