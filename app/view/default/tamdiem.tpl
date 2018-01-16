{extends file="layout.tpl"}
{block name="stylesheet"}
    <link href="{$siteurl}/public/css/style2.css" rel="stylesheet" media="all" />
{/block}
{block name="meta"}
    <link rel="canonical" href="{$siteurl}/tamdiem/" />

    <meta name="keywords" content="{$option->keywords}" />
    <meta name="description" content="{$option->description}" />

    <meta property="og:description" content="{$option->description}" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{$title}" />
    <meta property="og:url" content="{$siteurl}" />
    <meta property="og:site_name" content="{$option->name}" />
{/block}
{block name="body"}
    <div class="wrapper">
        {include 'header.tpl'}
        
        <div class="main">
            <div class="col1">
                <div id="banner-slide">
                    <ul class="bjqs">
                        {for $i=0 to 3}
                            <li><a href="{$siteurl}/post/{$posts[$i]['rss_id']}-{$posts[$i]['slug']}/"><img src="{$posts[$i]['thumbnail']}" title="{$posts[$i]['title']}"></a></li>
                        {/for}
                    </ul>
                </div>
                <!-- End: Slide -->
                
                <div class="post-entry">
                    {foreach $posts as $post}
                        {if $post@index mod 2 == 0}
                        <div class="entry">
                        {else}
                        <div class="entry mr0">
                        {/if}
                            <a href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/">
                                {if {$post['thumbnail']} != null}
                                <img src="{$post['thumbnail']}" alt="{$post['title']}"/>
                                {else}
                                <img src="{$siteurl}/public/images/no_image_93x69.jpg" alt="{$post['title']}"/>
                                {/if}
                            </a>
                            <a href="{$siteurl}/post/{$post['rss_id']}-{$post['slug']}/" title="{$post['title']}" class="title"><h3>{$post['title']}</h3></a>
                            <div class="des">{$post['content']|truncate:100:"...":true}</div>
                        </div>
                    {/foreach}
                </div>
                <!-- /.post-entry-->
                
                <div class="paging">
                    <a href="{$siteurl}/tamdiem/?page={$prev}" title="Trang trước">< Trang trước</a>
                    <a href="{$siteurl}/tamdiem/?page={$next}" title="Xem tiếp">Xem tiếp ></a>
                </div>
                <!-- /.paging-->
                
                <div class="suggest-posts">
                    <h2>Có thể bạn quan tâm</h2>
                    <ul>
                        {if $tamdiem_suggest|@count gt 0}
                            {for $i=0 to 5}
                                <li><a href="{$siteurl}/post/{$tamdiem_suggest[$i]['rss_id']}-{$tamdiem_suggest[$i]['slug']}/" title="{$tamdiem_suggest[$i]['title']}" class="title"><h3>{$tamdiem_suggest[$i]['title']}</h3></a></li>
                            {/for}
                        {/if}
                    </ul>
                </div>
            </div>
            <div class="col2">
                <img src="{$siteurl}/public/images/ads300x600.png" />
                <img src="{$siteurl}/public/images/ads300x600.png" />
                <img src="{$siteurl}/public/images/ads300x600.png" />
            </div>
            <div class="col3">
                {if $tamdiem_suggest|@count gt 6}
                    {for $i=6 to 14}
                        <div class="entry">
                            <a href="{$siteurl}/post/{$tamdiem_suggest[$i]['rss_id']}-{$tamdiem_suggest[$i]['slug']}/" class="thumbnail" title="{$tamdiem_suggest[$i]['title']}"><img src="{$tamdiem_suggest[$i]['thumbnail']}" title="{$tamdiem_suggest[$i]['title']}"></a>
                            <a href="{$siteurl}/post/{$tamdiem_suggest[$i]['rss_id']}-{$tamdiem_suggest[$i]['slug']}/" title="{$tamdiem_suggest[$i]['title']}" class="title"><h3>{$tamdiem_suggest[$i]['title']}</h3></a>
                        </div>
                    {/for}
                {/if}
            </div>
            <div class="clear"></div>
        </div>
        <!-- /.main -->
        
        {include 'footer.tpl'}
    </div>
{/block}
{block name="script"}
    <script type="text/javascript" src="{$siteurl}/public/js/bjqs-1.3.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#banner-slide').bjqs({
                height      : 310,
                width       : 482,
                responsive  : true
            });
        });
    </script>
{/block}