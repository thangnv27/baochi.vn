{extends file="layout.tpl"}
{block name="meta"}
    <link rel="canonical" href="{$siteurl}/mobile/webhay/" />

    <meta name="keywords" content="{$option->keywords}" />
    <meta name="description" content="{$option->description}" />

    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="blog" />
    <meta property="og:title" content="{$title}" />
    <meta property="og:url" content="{$siteurl}/mobile/webhay/" />
    <meta property="og:site_name" content="{$title}" />
    <meta property="og:description" content="{$option->description}" />
{/block}
{block name="body"}
    {foreach from=$categories key=k item=cat}
        <div class="list-web">
            <h3 class="list-web-title" data-record="{$k}" id="list_cat_{$k}">{$cat}<span class="down-arrow"></span></h3>
            <ul class="weblist-ul weblist-content-{$k}" style="display: none;"></ul>
        </div>
    {/foreach}
    <div class="ndtqc">
        <a href=" " title=" ">
            <img src="{$siteurl}/public/mb/images/ads.png" />
        </a>
    </div>
    <div class="list-web">
        <h3 class="list-web-title">Star<span class="down-arrow"></span></h3>
        <div class="list-web-content" style="display: none"></div>
    </div>
    <div class="list-web">
        <h3 class="list-web-title">Star<span class="down-arrow"></span></h3>
        <div class="list-web-content" style="display: none"></div>
    </div>
    <div class="list-web">
        <h3 class="list-web-title">Star<span class="down-arrow"></span></h3>
        <div class="list-web-content" style="display: none"></div>
    </div>
{/block}
{block name="script"}
    <script type="text/javascript">
        function addFavoriteLink(link_id) {
            window.location.href = siteurl + '/details/?id=' + link_id;
        }
        $(function () {
            $('#list_cat_2').click();
        });
    </script>
{/block}