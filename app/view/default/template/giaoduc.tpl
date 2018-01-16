
<!-- begin block news -->
<div class="container block-news">
    <div class="title">
        <ul class="cat-news tintuc">
            {foreach $giaoduccat as $c}
                <li>
                    <h2>
                        <a href="{$siteurl}/category/{$c['slug']}">{$c['name']}</a>
                        <span class="glyphicon glyphicon-chevron-right cat-arrow"></span>
                    </h2>
                </li>
                {foreach $c['childs'] as $cc}
                    <li class="sub-cat"><a href='{$siteurl}/category/{$cc['slug']}'>{$cc['name']}</a></li>
                    {/foreach}
                {/foreach}
        </ul>
    </div>
    <div class="block-news-content">
        {foreach $giaoduc as $p}
            <div class="pull-left col-330 first {if $p@index < 2}mr22{/if}">
                <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                    <img height="210" width="325" src="{$p['thumbnail']}"/>
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
        <div class="clearfix"></div>
    </div>
</div>
<!-- end block news -->