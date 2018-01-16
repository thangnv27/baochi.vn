{extends file="layout.tpl"}
{block name="body"}
    <div class="main" id="home">
        {foreach from=$categories key=k item=cat}
            <div class="weblist">
                <h3 class="weblist-head" data-record="{$k}" id="list_cat_{$k}">{$cat}</h3>
                <ul class="weblist-ul weblist-content-{$k}" style="display: none;"></ul>
            </div>
            {if $cat@first}
                <div class="weblist">
                    <div class="advertisement-468-60 mt0 mb0">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- ndt mobile danhba top responsive -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-8791311737735591"
                             data-ad-slot="8024405677"
                             data-ad-format="auto"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
            {/if}
            {if $cat@last}
                <div class="weblist">
                    <div class="advertisement-468-60 mt0 mb0">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- ndt mobile danhba bottom responsive -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-8791311737735591"
                             data-ad-slot="3454605276"
                             data-ad-format="auto"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
            {/if}
        {/foreach}
    </div>
{/block}
{block name="script"}
    <script type="text/javascript" src="{$siteurl}/public/js/jquery.validate.js"></script>
    <script type="text/javascript">
        function addFavoriteLink( link_id ) {
            window.location.href = siteurl+ '/details/?id=' + link_id;
        }
        $(function (){
            $('#list_cat_2').click();
        });
    </script>
{/block}