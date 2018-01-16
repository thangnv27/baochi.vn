<?php include(ADMIN_PATH . 'view' . DS . 'header.php'); ?>
<!--MAIN-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 main">
            <div class="row">
                <form class="form-horizontal" role="form" action="" method="post">
                    <div class="col-md-12 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><?php echo $this->title; ?></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_general" data-toggle="tab"><?php echo Language::$phrases['context']['general']; ?></a></li>
                                            <li><a href="#tab_contact" data-toggle="tab"><?php echo Language::$phrases['context']['contact_info']; ?></a></li>
                                            <li><a href="#tab_social" data-toggle="tab">Mạng xã hội</a></li>
                                            <li><a href="#tab_ads" data-toggle="tab">ADS</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <!--tab thong tin co ban-->
                                    <div class="tab-pane active" id="tab_general">
                                        <?php
                                        echo $this->form->get('name');
                                        echo $this->form->get('slug');
                                        echo $this->form->get('description');
                                        echo $this->form->get('keywords');
                                        echo $this->form->get('logo');
                                        echo $this->form->get('logo_footer');
                                        echo $this->form->get('logo_chuquan');
                                        echo $this->form->get('favicon');
                                        echo $this->form->get('sologan');
                                        echo $this->form->get('fanpage_url');
                                        echo $this->form->get('admin_email');
                                        echo $this->form->get('ga_id');
                                        echo $this->form->get('footer_info');
                                        ?>
                                    </div>
                                    
                                    <div class="tab-pane" id="tab_contact">
                                        <?php
                                        echo $this->form->get('email');
                                        echo $this->form->get('phone');
                                        echo $this->form->get('address');
                                        ?>
                                    </div>
                                    <div class="tab-pane" id="tab_social">
                                        <?php
                                        echo $this->form->get('social_fb');
                                        echo $this->form->get('social_google');
                                        echo $this->form->get('social_linkedin');
                                        echo $this->form->get('social_twitter');
                                        echo $this->form->get('social_instagram');
                                        echo $this->form->get('social_youtube');
                                        echo $this->form->get('social_pinterest');
                                        ?>
                                    </div>
                                    <div class="tab-pane" id="tab_ads">
                                        <?php
                                        echo $this->form->get('ads_home_top1');
                                        echo $this->form->get('ads_home_top2');
                                        echo $this->form->get('ads_home_footer');
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-5">
                                        <input type="submit" class="btn btn-primary" value="<?php echo Language::$phrases['action']['update']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!--END MAIN-->
<?php include(ADMIN_PATH . 'view' . DS . 'footer.php'); ?>