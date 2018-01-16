{extends file="layout.tpl"}
{block name="ads_head"}
    <div class="advertisement-468-60">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- ndt mobile top theo nguon&chude -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:320px;height:50px"
             data-ad-client="ca-pub-8791311737735591"
             data-ad-slot="5603832873"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
{/block}

{block name="body"}
    <div class="main">
        <div class="list-news">
            {$list}
        </div>
    </div>
{/block}
{block name="script"}
    <script type="text/javascript">
        $(window).load(function() {
            //$(".list-news").load("{$siteurl}/tmp/mobile_source/{$sourceID}_p1.html").html($(".list-news").html());
        });

        function next(x) {
            //$(".list-news").load("{$siteurl}/tmp/mobile_source/{$sourceID}_p" + x + ".html").html($(".list-news").html());
            window.location = "{$siteurl}/category/{$catID}/?page=" + x;
        }

        function prev(x) {
            //$(".list-news").load("{$siteurl}/tmp/mobile_source/{$sourceID}_p" + x + ".html").html($(".list-news").html());
            window.location = "{$siteurl}/category/{$catID}/?page=" + x;
            
        }
    </script>
{/block}