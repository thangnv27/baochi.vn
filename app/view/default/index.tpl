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
{block name="body"}
    <!-- begin top news -->
    <div class="container top-news">
        <div class="pull-left col-700">
            <div class="slider-news">
                <ul class="bxslider">
                    {foreach $posts_slider as $ps}
                        {if $ps@index % 2 eq 0}
                            <li>
                                <div class="col-slider pdl0">
                                    <div class="bg"></div>
                                    <a href="{$siteurl}/post/{$ps['rss_id']}-{$ps['slug']}/" title="{$ps['title']}" target="_blank">
                                        <img width="352" height="415" src="{$ps['thumbnail']}" />
                                    </a>
                                    <div class="sl-info">
                                        <a href="{$siteurl}/post/{$ps['rss_id']}-{$ps['slug']}/" title="{$ps['title']}" target="_blank">
                                            <h3 class="title">{$ps['title']}</h3>
                                        </a>
                                        <p class="source">{$ps['sourcename']}</p>
                                    </div>
                                </div>
                            {else}
                                <div class="col-slider">
                                    <div class="bg"></div>
                                    <a href="{$siteurl}/post/{$ps['rss_id']}-{$ps['slug']}/" title="{$ps['title']}" target="_blank">
                                        <img width="352" height="415" src="{$ps['thumbnail']}" />
                                    </a>
                                    <div class="sl-info">
                                        <a href="{$siteurl}/post/{$ps['rss_id']}-{$ps['slug']}/" title="{$ps['title']}" target="_blank">
                                            <h3 class="title">{$ps['title']}</h3>
                                        </a>
                                        <p class="source">{$ps['sourcename']}</p>
                                    </div>
                                </div>
                            </li>   
                        {/if}
                    {/foreach}
                </ul>
                <div class="outside">
                    <p><span id="slider-prev"></span><span id="slider-next"></span></p>
                </div>
            </div>
        </div>
        <div class="pull-right col-300">
            <div class="bcqc mb15">
                {$ads->ads_home_top1}
            </div>
            <div class="bcqc">
                {$ads->ads_home_top2}
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end top news -->

    <!-- begin sub top news -->
    <div class="container sub-top-news">
        <div class="pull-left col-700">
            {foreach $newposts as $ps}
            <div class="pull-left col-345 mb15 {if $ps@index % 2 eq 0}mr22{/if}">
                <div class="thumb">
                    <a href="{$siteurl}/post/{$ps['rss_id']}-{$ps['slug']}/" title="{$ps['title']}" target="_blank">
                        <img alt="{$ps['title']}" width="150" height="95" src="{$ps['thumbnail']}">
                    </a>
                </div>
                <div class="details">
                    <a href="{$siteurl}/post/{$ps['rss_id']}-{$ps['slug']}/" title="{$ps['title']}" target="_blank">{$ps['title']}</a>
                    <div class="mt5 source">{$ps['sourcename']}</div>
                </div>
            </div>
            {/foreach}
        </div>
        <div class="pull-right col-300">
            <div class="bcqc">
                {$ads->ads_home_top1}
            </div>
            {*<div class="new-news">
                <div class="title">Tin mới cập nhật</div>
                <ul class="list-new-news">
                    {foreach $newposts as $np}
                        <li>
                            <a href="{$siteurl}/post/{$np['rss_id']}-{$np['slug']}/" title="{$np['title']}" target="_blank">
                                {$np['title']}
                            </a>
                            <div class="mt5 source"><span class="icon"><img src="http://grabicon.com/icon?domain=/{$np['website']}" /></span>{$np['sourcename']}</div>
                        </li>
                    {/foreach}
                </ul>
            </div>*}
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end sub top news -->

    {*    Xem nhieu*}

    {include 'template/xemnhieu.tpl'}
    {*    xem nhieu*}
    {include 'template/xahoi.tpl'}
    {include 'template/giaoduc.tpl'}
    {include 'template/kinhte.tpl'}
    {include 'template/giaitri.tpl'}
    {include 'template/thethao.tpl'}
{/block}
{block name="script"}
    <script type="text/javascript">
        $("select.pull-left")
                .change(function () {
                    var type = "";
                    $("select option:selected").each(function () {
                        type = $(this).val();
                    });
                    if (type == 'yahoo') {
                        $('.txt-header-search').attr('name', 'p');
                        $('.frmsearch').attr('action', 'https://vn.search.yahoo.com/search');
                    } else if (type == 'bing') {
                        $('.txt-header-search').attr('name', 'q');
                        $('.frmsearch').attr('action', 'http://www.bing.com/search');
                    } else {
                        $('.txt-header-search').attr('name', 'q');
                        $('.frmsearch').attr('action', 'http://www.google.com.vn/search');
                    }
                })
                .change();

        $('.bxslider').bxSlider({
            nextSelector: '#slider-next',
            prevSelector: '#slider-prev',
            nextText: '',
            prevText: ''
        });
        $('.tab-news-mostview').bxSlider({
            nextSelector: '#btn-next',
            prevSelector: '#btn-prev',
            nextText: '<span class="glyphicon glyphicon-chevron-right"></span>',
            prevText: '<span class="glyphicon glyphicon-chevron-left"></span>',
            minSlides: 4,
            maxSlides: 4,
            slideWidth: 240,
            slideMargin: 15
        });
    </script>
{/block}