<!-- begin tab news -->
<div class="container tab-news">

    <!-- Nav tabs -->
    <div class="title">
        <ul class="cat-news tintuc">
            <li>
                <h2>Xem nhiều
                    <span class="glyphicon glyphicon-chevron-right cat-arrow"></span>
                </h2>
            </li>
            <li class="pull-right btn-slider">
                <span id="btn-prev"></span><span id="btn-next"></span>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- Tab panes -->
    <div class="tab-content tab-news-content">
        <div class="tab-pane active" id="xemnhieu">
            <ul class="tab-news-ul tab-news-mostview">
                {foreach $hotposts as $p}
                    <li>
                        <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                            <img height="136" width="240" src="{$p['thumbnail']}" />
                        </a>
                        <h3 class="tab-news-title">
                            <a href="{$siteurl}/post/{$p['rss_id']}-{$p['slug']}/" title="{$p['title']}" target="_blank">
                                {$p['title']}
                            </a>
                        </h3>
                        <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/{$p['website']}" /></span>{$p['sourcename']}</div>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
</div>
<!-- end tab news -->