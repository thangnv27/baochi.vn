{extends file="layout.tpl"}

{block name="body"}
        <div class="main">
            {if $smarty.session.user_logged_in == null}
                <div style="text-align: center"><a data-ajax="false" href="{$siteurl}/user/login_facebook/" class="ui-btn-text btn-login-fb" title="Đăng nhập bằng Facebook"><img src="{$siteurl}/public/mobile/img/btn_login_fb.png" /></a></div>
                    {else}
                <div class="addlink">
                    <h2>Thêm link vào danh bạ</h2>
                    <div class="t_red" id="add_result"></div>
                    <form id="frmAddLink" method="post">
                        <input type="text" maxlength="100" value="Tiêu đề (tối đa 100 ký tự)" onfocus="if (this.value == this.defaultValue)
                                    this.value = '';" onblur="if (this.value == '')
                                                this.value = this.defaultValue;" name="title" id="link-title" >

                        <input type="text" value="Link, vd: http://dantri.vn" onfocus="if (this.value == this.defaultValue)
                                    this.value = '';" onblur="if (this.value == '')
                                                this.value = this.defaultValue;" name="link" id="link-url" class="valid">

                        <select id="link-categories" name="categories">
                            {foreach from=$categories key="cat_id" item="name"}
                                <option value="{$cat_id}">{$name}</option>
                            {/foreach}
                        </select>
                        <div class="g-recaptcha" data-sitekey="6Lf8qf8SAAAAAGkPErXQtqIu88T3vE36dU1CyF6c"></div>
                        {*<input type="text" class="valid" name="captcha" id="link_code" onblur="if (this.value == '')
                                                                this.value = this.defaultValue;" onfocus="if (this.value == this.defaultValue)
                                                    this.value = '';" value="Điền mã hình bên">
                        
                        <img width="100" height="30" src="{$siteurl}/public/captcha.php" alt="" />*}
                        
                        <input type="submit" id="submit-share-link" value="Thêm link">
                    </form>
                </div>
            {/if}
        </div>
{/block}
{block name="script"}
    <script type="text/javascript" src="{$siteurl}/public/js/jquery.validate.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var $result = $("#add_result");
            $("#frmAddLink").validate({
                rules: {
                    title: {
                        required: true,
                        maxlength: 100
                    },
                    link: {
                        required: true
                    },
                    categories: {
                        required: true
                    },
                    captcha: {
                        required: true
                    }
                },
                errorPlacement: function(error, element) {
                },
                submitHandler: function(form) {
                    $result.html("Đang thêm...");
                    $.ajax({
                        url: siteurl + "/welcome/add_link", type: "POST", dataType: "json", cache: false,
                        data: $(form).serialize(),
                        success: function(response, textStatus, XMLHttpRequest) {
                            if (response && response.status === 'success') {
                                $result.html(response.message.replace("\n", "<br />"));
                            } else if (response && response.status === 'error') {
                                $result.html(response.message.replace("\n", "<br />"));
                                if (response.redirect !== '') {
                                    window.location = response.redirect;
                                }
                            }
                        },
                        error: function(MLHttpRequest, textStatus, errorThrown) {
                            $result.html(errorThrown);
                        },
                        complete: function() {
                        }
                    });
                }
            });
        });
    </script>
{/block}