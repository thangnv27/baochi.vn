<?php include(ADMIN_PATH . 'view' . DS . 'header.php'); ?>
<!--MAIN-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 main">
            <div class="action-bar">
                <div class="btn-bar pull-left">
                    <a href="./" class="btn btn-primary">&laquo; <?php echo Language::$phrases['navigation']['back']; ?></a>
                </div>
            </div>

            <!--Add new form-->

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
                                            <li class="active"><a href="#cat_general" data-toggle="tab"><?php echo Language::$phrases['context']['general']; ?></a></li>
                                            <li><a href="#cat_seo" data-toggle="tab">SEO</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <!--tab thong tin co ban-->
                                    <div class="tab-pane active" id="cat_general">
                                        <?php
                                        echo $this->form->get('title');
                                        echo $this->form->get('slug');
                                        echo $this->form->get('categories');
                                        echo $this->form->get('source');
                                        echo $this->form->get('content');
                                        echo $this->form->get('excerpt');
                                        echo $this->form->get('link');
                                        echo $this->form->get('tags');
                                        echo $this->form->get('thumbnail');
                                        echo $this->form->get('viewcount');
                                        echo $this->form->get('post_status');
                                        echo $this->form->get('show_in_slider');
                                        ?>
                                    </div>

                                    <!--Tab seo-->
                                    <div class="tab-pane seo" id="cat_seo">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo Language::$phrases['seo']['preview']; ?></label>
                                            <div class="col-sm-5">
                                                <div id="seo_snippet">
                                                    <a class="title" href="javascript://"></a>
                                                    <a class="url" href="javascript://"><?php the_permalink($post['slug'], "post"); ?></a>
                                                    <p class="desc">
                                                        <span class="content"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="seo_keyword" class="col-sm-2 control-label"><?php echo Language::$phrases['seo']['keyword']; ?></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="seo_keyword" id="seo_focuskw" value="" />
                                                <br/>
                                                <div id="focuskwresults">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="seo_title" class="col-sm-2 control-label"><?php echo Language::$phrases['seo']['title']; ?></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="seo_title" id="seo_title" value="" />
                                                <div><?php echo Language::$phrases['seo']['title.desc']; ?></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="seo_metadesc" class="col-sm-2 control-label"><?php echo Language::$phrases['seo']['description']; ?></label>
                                            <div class="col-sm-5">
                                                <textarea id="seo_metadesc" name="seo_description" rows="4"></textarea>
                                                <div>
                                                    <?php echo Language::$phrases['seo']['description.desc']; ?>
                                                    <div id="seo_metadesc_notice"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-5">
                                        <input type="submit" class="btn btn-primary" value="<?php echo Language::$phrases['action']['addnew']; ?>" />
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