<?php include(ADMIN_PATH . 'view' . DS . 'header.php'); ?>
<!--MAIN-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 main">
            <div class="action-bar">
                <div class="btn-bar pull-left">
                    <a href="../" class="btn btn-primary">&laquo; <?php echo Language::$phrases['navigation']['back']; ?></a>
                    <?php if ($current_user['capability']['links']['create'] == 1) : ?>
                    <a href="../addnew" class="btn btn-success"><?php echo Language::$phrases['action']['addnew']; ?></a>
                    <?php endif; ?>
                    <?php if ($current_user['capability']['links']['delete'] == 1) : ?>
                    <a href="<?php echo DASHBOARD_URL . '/link/' . $this->link['id'] . '/delete'; ?>" class="btn btn-danger" onclick="return confirm('<?php echo Language::$phrases['action']['delete.confirm']; ?>');"><?php echo Language::$phrases['action']['delete']; ?></a>
                    <?php endif; ?>
                    <?php if ($current_user['capability']['links']['edit'] == 1) : ?>
                    <a href="<?php echo DASHBOARD_URL . '/link/' . $this->link['id'] . '/approve'; ?>" class="btn btn-danger" onclick="return confirm('<?php echo Language::$phrases['action']['approve.confirm']; ?>');"><?php echo Language::$phrases['action']['approve']; ?></a>
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
                                <?php
                                echo $this->form->get('title');
                                echo $this->form->get('slug');
                                echo $this->form->get('categories');
                                echo $this->form->get('link');
                                echo $this->form->get('viewcount');
                                echo $this->form->get('custom_favicon');
                                echo $this->form->get('post_status');
                                ?>
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