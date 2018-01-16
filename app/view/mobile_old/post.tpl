{extends file="layout.tpl"}
{block name="ads_head"}
    <div class="advertisement-468-60">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- ndt detail news mobile top 2 -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:320px;height:50px"
             data-ad-client="ca-pub-8791311737735591"
             data-ad-slot="1034032471"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
{/block}


{block name="body"}
    {if $post_link == null}
        <div class="main">

            <article class="blog-article">
                <h3 class="post-title">{$title}</h3>
                <div class="post-content">
                    {$post.content}
                </div>
            </article>
            <div class="advertisement-468-60">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- ndt detail news mobile mid -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-8791311737735591"
                     data-ad-slot="2536275272"
                     data-ad-format="auto"></ins>
                <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <div class="t_center" style="background: #fff;padding: 10px 0;overflow: hidden;">
                <img src="{$siteurl}/public/mobile/img/follow_title.png" style="float: left;height: 30px" />
                <div class="fb-follow fl mt5" data-href="{$option->fanpage_url}" data-colorscheme="light" data-layout="button" data-show-faces="false"></div>
            </div>
            <div class="clearfix"></div>
            <div class="other-post">
                <div class="other-post-title">Đang được quan tâm</div>
                <div class="other-post-content">
                    <ul>
                        {foreach from=$otherpost item=other}
                            <li>
                                <a href="{$siteurl}/post/{if $other.rss_id == null}0{else}{$other.rss_id}{/if}-{$other.slug}" >{$other.title} 
                                    <!--({$other.posted_date|date_format:"%d/%m"})-->
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                </div>
            </div>
            <div class="advertisement-468-60">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- ndt detail news mobile bottom -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-8791311737735591"
                     data-ad-slot="9919941277"
                     data-ad-format="auto"></ins>
                <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
    {else}
        <div class="type-link">
            <iframe width="100%" frameborder="0" src="{$post_link}" class="ilink"></iframe>
        </div>
    {/if}
{/block}
{block name="savepost"}
    {if $smarty.session.user_logged_in == null}
        <a onclick="alert('Bạn cần đăng nhập để lưu địa chỉ bài viết này để đọc sau');" class="btn-footer btn-save-post" style="cursor: pointer;">+</a>
    {else}
        <a onclick="if (confirm('Bạn có muốn lưu địa chỉ bài viết vào danh bạ riêng không?'))
                    save_post();" class="btn-footer btn-save-post" style="cursor: pointer;">+</a>
    {/if}
{/block}
{block name="like_page"}
    <a href="#" class="btn-footer btn-like"><div class="fb-like" data-href="{$permalink}" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div></a>
    {/block}
    {block name="script"}
    <script type="text/javascript">
        function save_post() {
            var link = window.location.toString();
            if ($("iframe.ilink").length > 0) {
                link = $("iframe.ilink").attr('src');
            }

            $.ajax({
                url: siteurl + "/welcome/add_link", type: "POST", dataType: "json", cache: false,
                data: {
                    title: $("title").text(),
                    link: link,
                    categories: 1
                },
                success: function (response, textStatus, XMLHttpRequest) {
                    if (response && response.status == 'success') {
                        alert(response.message);
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
        }
    </script>

{/block}