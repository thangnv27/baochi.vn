{extends file="layout.tpl"}
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
    <!-- BEGIN LIST NEWS -->
    <div class="list-news">
        {foreach $posts as $post}
            <a href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/" title="{$post['title']}">
                <span class="news-item">
                    <div class="ni-thumb fl">
                        {if {$post['thumbnail']} != null}
                        <img src="{$post['thumbnail']}" alt="{$post['title']}"/>
                        {else}
                        <img src="{$siteurl}/public/images/no_image_93x69.jpg" alt="{$post['title']}"/>
                        {/if}
                    </div>
                    <div class="ni-title fl">
                        <h2>{$post['title']}</h2>
                    </div>
                    <div class="clearfix"></div>
                </span>
            </a>
            {if $post@index eq 6}
            <div class="ndtqc">
                <a href=" " title=" ">
                    <img src="{$siteurl}/public/mb/images/ads.png" />
                </a>
            </div>
            {/if}
        {/foreach}
    </div>
    <!-- END LIST NEWS -->
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
    <div class="t_center mt10 mb10">
        <span onclick="nextPrev({$next});" class="btnnav">Xem tiếp</span>
    </div>
{/block}
{block name="script"}
    <script type="text/javascript">
        function nextPrev(x) {
            window.location = "{$siteurl}/?page=" + x;
        }
    </script>
{/block}