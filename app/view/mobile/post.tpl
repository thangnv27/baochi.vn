
{extends file="layout_post.tpl"}
{block name="meta"}
    <link rel="canonical" href="{$link}" />

    <meta name="keywords" content="{$option->keywords}" />
    <meta name="description" content="{$option->description}" />

    <meta property="og:description" content="{$option->description}" />

    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{$title}" />
    <meta property="og:url" content="{$link}" />
    <meta property="og:site_name" content="{$title}" />
{/block}
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

        {literal}
            <script type="text/javascript">var addthis_config = {"data_track_addressbar": false};</script>
        {/literal}
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e5a517830ae061f"></script>

    {/block}
{block name="body"}
    {if $post_link == null}
        <!-- DETAIL NEWS -->
        <div class="post-details">
            <h1>{$title}</h1>
            <div class="post-share">
                <div class="addthis_toolbox addthis_default_style">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                </div>
            </div>
            <div class="post-content">
                {$post.content}
            </div>
            <div class="ndtqc">
                <a href=" " title=" ">
                    <img src="{$siteurl}/public/mb/images/ads.png" />
                </a>
            </div>
            <div class="post-share">
                <div class="addthis_toolbox addthis_default_style">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                </div>
            </div>
        </div>
        <div class="post-comment">
            <div class="fb-comments" data-href="{$link}" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
        </div>
        <!-- tin cung chuyen muc -->
        <div class="post-related">
            <div class="post-related-title">
                <h3 class="rlt">Tin cùng chuyên mục</h3>
            </div>
            <div class="post-related-content">
                {if $relatedPost|@count gt 0}
                    {foreach $relatedPost as $post}
                        {if $post@first}
                            <div class="news-item">
                                <div class="ni-thumb fl">
                                    <a title="{$post['title']}" href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/">
                                        {if {$post['thumbnail']} != null}
                                            <img src="{$post['thumbnail']}" alt="{$post['title']}"/>
                                        {else}
                                            <img src="{$siteurl}/public/images/no_image_93x69.jpg" alt="{$post['title']}"/>
                                        {/if}
                                    </a>
                                </div>
                                <div class="ni-title fl">
                                    <h2><a href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/" title="{$post['title']}">{$post['title']}</a></h2>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <ul class="news-related">
                            {else}
                                <li><a href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/" title="{$post['title']}">{$post['title']}</a></li>
                                {/if}
                                {if $post@last}
                            </ul>
                        {/if}
                    {/foreach}
                {/if}
            </div>
        </div>
        <!-- end tin cung chuyen muc -->
        <!-- tin quan tam -->
        <div class="post-related">
            <div class="post-related-title">
                <h3 class="rlt">Có thể bạn quan tâm</h3>
            </div>
            <div class="post-related-content">
                <div class="news-item-2">
                    {if $tamdiem_suggest|@count gt 0}
                        {if $tamdiem_suggest|@count gt 4}
                            {$max = 3}
                        {else}
                            {$max = $tamdiem_suggest|@count - 1}
                        {/if}
                        {for $i=0 to $max}
                            {if $i mod 2 == 0}
                                <div class="ni2 mr2p">
                                {else}
                                    <div class="ni2">
                                    {/if}
                                    <a href="{$siteurl}/post/{$tamdiem_suggest[$i]['rss_id']}-{$tamdiem_suggest[$i]['slug']}/" title="{$tamdiem_suggest[$i]['title']}">
                                        {if {$tamdiem_suggest[$i]['thumbnail']} != null}
                                            <img src="{$tamdiem_suggest[$i]['thumbnail']}" alt="{$tamdiem_suggest[$i]['title']}" />
                                        {else}
                                            <img src="{$siteurl}/public/images/no_image_93x69.jpg" alt="{$tamdiem_suggest[$i]['title']}" />
                                        {/if}
                                    </a>
                                    <a href="{$siteurl}/post/{$tamdiem_suggest[$i]['rss_id']}-{$tamdiem_suggest[$i]['slug']}/" title="{$tamdiem_suggest[$i]['title']}">{$tamdiem_suggest[$i]['title']}</a>
                                </div>
                            {/for}
                        {/if}
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end tin quan tam -->
            <!-- tin da dang -->
            <div class="post-related">
                <div class="post-related-title">
                    <h3 class="rlt">Tin đã đăng</h3>
                </div>
                <div class="post-related-content">
                    {if $otherpost|@count gt 0}
                        {foreach $otherpost as $post}
                            {if $post@first}
                                <div class="news-item">
                                    <div class="ni-thumb fl">
                                        <a title="{$post['title']}" href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/">
                                            {if {$post['thumbnail']} != null}
                                                <img src="{$post['thumbnail']}" alt="{$post['title']}"/>
                                            {else}
                                                <img src="{$siteurl}/public/images/no_image_93x69.jpg" alt="{$post['title']}"/>
                                            {/if}
                                        </a>
                                    </div>
                                    <div class="ni-title fl">
                                        <h2><a href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/" title="{$post['title']}">{$post['title']}</a></h2>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <ul class="news-related">
                                {else}
                                    <li><a href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/" title="{$post['title']}">{$post['title']}</a></li>
                                    {/if}
                                    {if $post@last}
                                </ul>
                            {/if}
                        {/foreach}
                    {/if}
                </div>
            </div>
            <!-- end tin da dang -->
            <div class="ndtqc">
                <a href="" title="">
                    <img src="{$siteurl}/public/mb/images/ads.png" />
                </a>
            </div>
            <!-- END DETAIL NEWS -->
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
    