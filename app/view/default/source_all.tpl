{extends file="layout.tpl"}
{block name="meta"}
    <link rel="canonical" href="{$siteurl}/source/{$source_cached['id']}/" />

    <meta name="keywords" content="{$option->keywords}" />
    <meta name="description" content="{$option->description}" />

    <meta property="og:description" content="{$option->description}" />

    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="blog" />
    <meta property="og:title" content="{$source_cached['name']}" />
    <meta property="og:url" content="{$siteurl}/source/{$source_cached['id']}/" />
    <meta property="og:site_name" content="{$source_cached['name']}" />
{/block}
{block name="body"}
    <div class="container source-page">
        <div class="title">
            <span>Có {$count} nguồn tin</span>
        </div>
        <div class="source-list">
            {foreach $sources as $s}
                <div class="pull-left col-330 {if $s@index % 3 == 0}ml0{/if}">
                    <div class="thumb">
                        <a href="{$siteurl}/source/{$s['slug']}/" title="{$s['name']}">
                            <img src="{$s['image']}" alt="{$s['name']}">
                        </a>
                    </div>
                    <div class="details">
                        <a href="{$siteurl}/source/{$s['slug']}/" title="{$s['name']}">{$s['name']}</a>
                        <p class="post-count">{$s['countpost']} tin bài</p>
                        <p class="mt10">
                            <span class="icon pull-left">
                                <img src="http://grabicon.com/icon?domain=/{$s['website']}" />
                            </span>
                            <a class="source-link pull-left" href="http://{$s['website']}">{$s['website']}</a>
                        </p>
                    </div>
                </div>
            {/foreach}

        </div>
    </div>
{/block}