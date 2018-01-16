<?php include(ADMIN_PATH . 'view' . DS . 'header.php'); ?>
<!--MAIN-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 main">
            <div class="action-bar">
                <div class="btn-bar pull-left">
                    <a href="../?status=0" class="btn btn-primary">&laquo; <?php echo Language::$phrases['navigation']['back']; ?></a>
                </div>
            </div>

            <!--Add new form-->

            <div class="row">
                <form class="form-horizontal" role="form" action="" method="post">
                    <div class="col-md-12 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><?php echo $this->title . " #" . $this->order['id']; ?></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_customer" data-toggle="tab"><?php echo Language::$phrases['page']['order']['customer_info']; ?></a></li>
                                            <li><a href="#tab_shipping" data-toggle="tab"><?php echo Language::$phrases['page']['order']['ship_info']; ?></a></li>
                                            <li><a href="#tab_order" data-toggle="tab"><?php echo Language::$phrases['page']['order']['order_info']; ?></a></li>
                                            <li><a href="#tab_product" data-toggle="tab"><?php echo Language::$phrases['page']['order']['products']; ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <!--tab thong tin co ban-->
                                    <div class="tab-pane active" id="tab_customer">
                                        <?php
                                        echo $this->customer->get('fullname');
                                        echo $this->customer->get('email');
                                        echo $this->customer->get('phone');
                                        echo $this->customer->get('passport');
                                        echo $this->customer->get('address');
                                        echo $this->customer->get('city');
                                        ?>
                                    </div>
                                    <div class="tab-pane" id="tab_shipping">
                                        <?php
                                        echo $this->shipping->get('receiver');
                                        echo $this->shipping->get('email');
                                        echo $this->shipping->get('phone');
                                        echo $this->shipping->get('passport');
                                        echo $this->shipping->get('address');
                                        echo $this->shipping->get('city');
                                        ?>
                                    </div>
                                    <div class="tab-pane" id="tab_order">
                                        <?php
                                        echo $this->order_info->get('payment_method');
                                        echo $this->order_info->get('discount');
                                        echo $this->order_info->get('total_amount');
                                        echo $this->order_info->get('status');
                                        echo $this->order_info->get('delivery_status');
                                        ?>
                                    </div>
                                    <div class="tab-pane" id="tab_product">
                                        <?php echo $this->table; ?>
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