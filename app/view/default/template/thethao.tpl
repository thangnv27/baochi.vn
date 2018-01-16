<!-- begin block news -->
<div class="container block-news">
    <div class="title">
        <ul class="cat-news tintuc">
            {foreach $thethaocat as $c}
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
        {foreach $thethao as $p}
            {if $p@index eq 0}
                <div class="pull-left {$p@index} col-330 first mr22">
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
                <div class="pull-left {$p@index} col-330 sub-news mr22">
                {elseif ($p@index < 3)}
                    <div class="item">
                        <div class="thumb">
                            <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                <img width="150" height="95" src="{$p['thumbnail']}" alt="{$p['title']}">
                                {*                                <span class="post-type glyphicon glyphicon-facetime-video"></span>*}
                            </a>
                        </div>
                        <div class="details">
                            <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                {$p['title']}
                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/{$p['website']}" /></span>{$p['sourcename']}</div>
                        </div>
                    </div>
                {elseif $p@index eq 3}
                    <div class="item item mb0 pdb0" style="border-bottom: none;">
                        <div class="thumb">
                            <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                <img width="150" height="95" src="{$p['thumbnail']}" alt="{$p['title']}">
                                {*                                <span class="post-type glyphicon glyphicon-facetime-video"></span>*}
                            </a>
                        </div>
                        <div class="details">
                            <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                {$p['title']}
                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/{$p['website']}" /></span>{$p['sourcename']}</div>
                        </div>
                    </div>
                </div>
                <div class="pull-left col-330 sub-news">
                {elseif ($p@index < 6)}
                    <div class="item">
                        <div class="thumb">
                            <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                <img width="150" height="95" src="{$p['thumbnail']}" alt="{$p['title']}">
                                {*                                <span class="post-type glyphicon glyphicon-facetime-video"></span>*}
                            </a>
                        </div>
                        <div class="details">
                            <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                {$p['title']}
                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/{$p['website']}" /></span>{$p['sourcename']}</div>
                        </div>
                    </div>
                {elseif ($p@index eq 6)}
                    <div class="item item mb0 pdb0" style="border-bottom: none;">
                        <div class="thumb">
                            <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                <img width="150" height="95" src="{$p['thumbnail']}" alt="{$p['title']}">
                                {*                                <span class="post-type glyphicon glyphicon-facetime-video"></span>*}
                            </a>
                        </div>
                        <div class="details">
                            <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                {$p['title']}
                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/{$p['website']}" /></span>{$p['sourcename']}</div>
                        </div>
                    </div>
                </div>
            {/if}
        {/foreach}
    </div>
    <div class="clearfix"></div>
</div>
<!-- end block news -->