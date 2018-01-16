<div class="container">
    <div class="footer-tool">
        <div class="col-330">
            <div class="social">
                <a target="_blank" href='{$social->social_fb}' class="fb"><img src="{$siteurl}/public/static/images/icon/fb.png" /></a>
                <a target="_blank" href='{$social->social_google}' class="google"><img src="{$siteurl}/public/static/images/icon/google.png" /></a>
                <a target="_blank" href='{$social->social_linkedin}' class="linkin"><img src="{$siteurl}/public/static/images/icon/in.png" /></a>
                <a target="_blank" href='{$social->social_twitter}' class="twitter"><img src="{$siteurl}/public/static/images/icon/twitter.png" /></a>
                <a target="_blank" href='{$social->social_instagram}' class="instagram"><img src="{$siteurl}/public/static/images/icon/instagram.png" /></a>
                <a target="_blank" href='{$social->social_youtube}' class="youtube"><img src="{$siteurl}/public/static/images/icon/youtube.png" /></a>
                <a target="_blank" href='{$social->social_pinterest}' class="pinterest"><img src="{$siteurl}/public/static/images/icon/pinterest.png" /></a>
            </div>
        </div>
        <div class="col-330">
            <div class="footer-link">
                <a href="#" class="nhantin">Nhận bản tin</a>
                <a href="#" class="mobile">Phiên bản Mobile</a>
                <a href="#" class="guibai">Gửi bài viết</a>
            </div>
        </div>
        <div class="col-330 pull-right footer-link-right">
            <a href="#" class="rss">Rss</a>
            <a href="#" class="quangcao">Quảng cáo</a>
        </div>
        <div class="clearfix"></div>
    </div>
    {foreach $catparent as $cp}
        <div class="col-footer">
            <h3><a href='{$siteurl}/category/{$cp['slug']}'>{$cp['name']}</a></h3>
            <ul class="cat">
                {foreach $cp['childs'] as $c}
                    <li><a href='{$siteurl}/category/{$c['slug']}'>{$c['name']}</a></li>
                    {/foreach}
            </ul>
        </div>
    {/foreach}
    <div class="clearfix"></div>

</div>