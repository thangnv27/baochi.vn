<?php include(ADMIN_PATH . 'view' . DS . 'header.php'); ?>
<!--MAIN-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 main">
            <div class="action-bar">
                <div class="btn-bar pull-left">
                    <a href="../" class="btn btn-primary">&laquo; <?php echo Language::$phrases['navigation']['back']; ?></a>
                    <?php if ($current_user['capability']['products']['create'] == 1) : ?>
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
                                            <li><a href="#tab_details" data-toggle="tab"><?php echo Language::$phrases['context']['details']; ?></a></li>
                                            <li><a href="#tab_img" data-toggle="tab"><?php echo Language::$phrases['context']['images']; ?></a></li>
                                            <li><a href="#tab_seo" data-toggle="tab">SEO</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <!--tab thong tin co ban-->
                                    <div class="tab-pane active" id="cat_general">
                                        <?php
                                        $post = $this->product;
                                        echo $this->form->get('title');
                                        echo $this->form->get('slug');
                                        echo $this->form->get('categories');
                                        echo $this->form->get('content');
                                        echo $this->form->get('excerpt');
                                        echo $this->form->get('tags');
                                        if ($post['thumbnail'] != ""):
                                            ?>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"></label>
                                                <div class="col-sm-5">
                                                    <img src="<?php echo $post['thumbnail']; ?>" width="150" height="150" />
                                                </div>
                                            </div>
                                            <?php
                                        endif;
                                        echo $this->form->get('thumbnail');

                                        $seo = @unserialize($post['seo']);
                                        echo $this->form->get('post_status');
                                        ?>
                                    </div>

                                    <!--Tab thong tin chi tiet-->
                                    <div class="tab-pane" id="tab_details">
                                        <?php
                                        echo $this->form->get('price');
                                        echo $this->form->get('product_status');
                                        ?>
                                    </div>

                                    <!--Tab product img-->
                                    <div id="tab_img" class="tab-pane">
                                        <div class="table-responsive">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <table class="table table-striped" id="tbl_product_img">
                                                    <tbody>
                                                        <?php foreach ($post['images'] as $key => $value) : ?>
                                                        <tr id="prod_img_row_<?php echo $key; ?>">
                                                            <td class="col-lg-11">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="prod_img_<?php echo $key; ?>" name="images[<?php echo $key; ?>]" value="<?php echo $value; ?>" />
                                                                    <span class="input-group-btn">
                                                                        <button type="button" class="btn btn-default" onclick="openFileDialog('prod_img_<?php echo $key; ?>')">Browse</button>
                                                                    </span>
                                                                </div><!-- /input-group -->
                                                            </td><!-- /.col-lg-6 -->
                                                            <td class="col-lg-1">
                                                                <a class="btn btn-sm btn-default tr_remove" href="#">Remove</a>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                        <tr id="tr_add">
                                                            <td colspan="5" class="col-lg-6">
                                                                <a href="#" class="btn btn-sm btn-primary" id="tr_add_btn"><?php echo Language::$phrases['action']['add']; ?></a>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr id="tr_clone" style="display:none">
                                                            <td class="col-lg-11">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" />
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-default" type="button"><?php echo Language::$phrases['context']['browse']; ?></button>
                                                                    </span>
                                                                </div><!-- /input-group -->
                                                            </td><!-- /.col-lg-6 -->
                                                            <td class="col-lg-1">
                                                                <a href="#" class="btn btn-sm btn-default tr_remove"><?php echo Language::$phrases['action']['remove']; ?></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Tab seo-->
                                    <div class="tab-pane seo" id="tab_seo">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?php echo Language::$phrases['seo']['preview']; ?></label>
                                            <div class="col-sm-5">
                                                <div id="seo_snippet">
                                                <a class="title" href="javascript://"><?php echo ($seo['seo_title'] and $seo['seo_title'] != "") ? $seo['seo_title'] : $post['title']; ?></a>
                                                <a class="url" href="javascript://"><?php the_permalink($post['slug'], "product"); ?></a>
                                                <p class="desc">
                                                    <span class="content">
                                                    <?php echo ($seo['seo_description'] != "") ? $seo['seo_description'] : Utils::get_short_content($post['content'], 160); ?>
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
                                                <div id="focuskwresults"></div>
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