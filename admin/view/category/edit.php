<?php include(ADMIN_PATH . 'view' . DS . 'header.php'); ?>
<!--MAIN-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 main">
            <div class="action-bar">
                <div class="btn-bar pull-left">
                    <a href="../" class="btn btn-primary">&laquo; <?php echo Language::$phrases['navigation']['back']; ?></a>
                    <?php if ($current_user['capability']['categories']['create'] == 1) : ?>
                    <a href="../addnew" class="btn btn-success"><?php echo Language::$phrases['action']['addnew']; ?></a>
                    <?php endif; ?>
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
                                        $category = $this->category;
                                        echo stripslashes($this->form->get('name'));
                                        echo $this->form->get('slug');
                                        echo $this->form->get('parent');
                                        echo $this->form->get('description');
                                        echo $this->form->get('website');
                                        if ($category['image'] != ""):
                                            ?>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"></label>
                                                <div class="col-sm-5">
                                                    <img src="<?php echo $category['image']; ?>" width="150" height="" />
                                                </div>
                                            </div>
                                            <?php
                                        endif;
                                        echo $this->form->get('image');
                                        echo $this->form->get('cover');
                                        echo $this->form->get('style');
                                        echo $this->form->get('displayorder');
                                        echo $this->form->get('hidemobile');
                                        
                                        $seo = @unserialize($category['seo']);
                                        ?>
                                    </div>

                                    <!--Tab seo-->
                                    <div class="tab-pane seo" id="cat_seo">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo Language::$phrases['seo']['preview']; ?></label>
                                            <div class="col-sm-5">
                                                <div id="seo_snippet">
                                                <a class="title" href="javascript://"><?php echo ($seo['seo_title'] and $seo['seo_title'] != "") ? $seo['seo_title'] : $category['name']; ?></a>
                                                <a class="url" href="javascript://"><?php the_permalink($category['slug'], "category"); ?></a>
                                                <p class="desc">
                                                    <span class="content">
                                                    <?php echo ($seo['seo_description'] != "") ? $seo['seo_description'] : $category['description']; ?>
                                                    </span>
                                                </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="seo_keyword" class="col-sm-2 control-label"><?php echo Language::$phrases['seo']['keyword']; ?></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="seo_keyword" id="seo_focuskw" value="<?php echo $seo['seo_keyword']; ?>" />
                                                <br/>
                                                <div id="focuskwresults">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="seo_title" class="col-sm-2 control-label"><?php echo Language::$phrases['seo']['title']; ?></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="seo_title" id="seo_title" value="<?php echo $seo['seo_title']; ?>" />
                                                <div><?php echo Language::$phrases['seo']['title.desc']; ?></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="seo_metadesc" class="col-sm-2 control-label"><?php echo Language::$phrases['seo']['description']; ?></label>
                                            <div class="col-sm-5">
                                                <textarea id="seo_metadesc" name="seo_description" rows="4"><?php echo $seo['seo_description']; ?></textarea>
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