<?php include(ADMIN_PATH . 'view' . DS . 'header.php'); ?>
<!--MAIN-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 main">
            <div class="action-bar">
                <div class="btn-bar pull-left">
                    <a href="../" class="btn btn-primary">&laquo; <?php echo Language::$phrases['navigation']['back']; ?></a>
                    <?php if ($current_user['capability']['rss']['create'] == 1) : ?>
                    <a href="../addnew" class="btn btn-success"><?php echo Language::$phrases['action']['addnew']; ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <!--Add new form-->

            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <?php echo $this->formview; ?>
                </div>
            </div>

        </div>
    </div>
</div>
<!--END MAIN-->
<?php include(ADMIN_PATH . 'view' . DS . 'footer.php'); ?>