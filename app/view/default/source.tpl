{extends file="layout.tpl"}
{block name="stylesheet"}
    <link href="{$siteurl}/public/style.css" rel="stylesheet" media="all" />
{/block}
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
{block name="body"}


    <!-- begin quang cao full -->
    <div class="container bcqc-full cat-cover">
        <img src="{$source['cover']}" />
    </div>
    <!-- end quang cao full -->
    <!-- TAB -->
    <div class="container">
        <div class="cat-title">
            <h2>{$source['name']}</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <div  class="container sub-top-news ">
        <div class="pull-left col-700">
            {foreach $posts as $p}
                {if $p@index eq 0}
                    <div class="slider-news first-cat mb15">
                        <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                            <img class="first-cat-img" src='{$p['thumbnail']}' title="{$p['title']}" />
                        </a>
                        <div class="meta">
                            <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                <h3 class="title">{$p['title']}</h3>
                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/{$source['website']}" /></span>{$source['name']}</div>
                        </div>
                    </div>
                {else}
                    <div class="pull-left col-345 mb15 {if $p@index % 2}mr22{/if}">
                        <div class="thumb">
                            <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                <img alt="{$p['title']}" height="95" width="150" src="{$p['thumbnail']}">
                            </a>
                        </div>
                        <div class="details">
                            <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                {$p['title']}
                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/{$source['website']}" /></span>{$source['name']}</div>
                        </div>
                    </div>
                {/if}
            {/foreach}
            <div class="clearfix"></div>
            <div class="paging">{$pagelist}</div>
        </div>
        {*        col-right*}
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
{block name="script"}
{/block}