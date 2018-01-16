{extends file="layout.tpl"}
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
{block name="body"}

    <!-- begin quang cao full -->
    <div class="container bcqc-full cat-cover">
    </div>
    <!-- end quang cao full -->


    <div class="container post">
        <div class="pull-left col-700">
            <h1>{$title}</h1>
            <div class="post-content">
                {$post['content']}
            </div>
        </div>
        <div class="pull-right col-300">
            <div class="bcqc mb15">
                {$ads->ads_home_top1}
            </div>
            <div class="bcqc">
                {$ads->ads_home_top2}
            </div>
            <div class="new-news">
                <div class="title">Tin được xem nhiều</div>
                <div class="most-view">
                    {foreach $xemnhieu as $p}
                        <div class="col-30 most-view-item">
                            <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                <img height="210" width="325" src="{$p['thumbnail']}">
                            </a>
                            <div class="meta">
                                <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                    <h3>
                                        {$p['title']}
                                    </h3>
                                </a>
                                <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/{$p['website']}" /></span>{$p['sourcename']}</div>
                            </div>
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

<!-- end sub top news -->

{/block}