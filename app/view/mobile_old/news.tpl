{extends file="layout.tpl"}

{block name="ads_head"}
    <div class="advertisement-468-60">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- ndt tinmoi mobile top -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:320px;height:50px"
             data-ad-client="ca-pub-8791311737735591"
             data-ad-slot="3987498873"></ins>
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
        function next(x) {
            window.location = "{$siteurl}/news/?page=" + x;
        }        
        function prev(x) {
            window.location = "{$siteurl}/news/?page=" + x;
        }
    </script>
{/block}