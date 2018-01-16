<?php include(ADMIN_PATH . 'view' . DS . 'header.php'); ?>
<!--MAIN-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 main">
            <form action="" method="get">
                <!--Table-->
                <div class="action-bar">
                    <a href="./?status=0"><span class="label label-primary"><?php echo Language::$phrases['context']['pending']; ?></span></a>
                    <a href="./?status=1"><span class="label label-warning"><?php echo Language::$phrases['context']['inprogress']; ?></span></a>
                    <a href="./?status=2"><span class="label label-success"><?php echo Language::$phrases['context']['paid']; ?></span></a>
                    <a href="./?status=3"><span class="label label-danger"><?php echo Language::$phrases['context']['canceled']; ?></span></a>
                    <a href="./"><span class="label label-info"><?php echo Language::$phrases['context']['all']; ?></span></a>
                </div>
                <div class="action-bar">
                    <div class="btn-bar pull-left">
                        <?php if ($_GET['status'] == 3): ?>
                        <select name="action">
                            <option value=""><?php echo Language::$phrases['action']['bulkActions']; ?></option>
                            <?php if ($current_user['capability']['orders']['delete'] == 1) : ?>
                                <option value="delete"><?php echo Language::$phrases['action']['delete']; ?></option>
                            <?php endif; ?>
                        </select>
                        <button type="submit" class="btn btn-primary"><?php echo Language::$phrases['action']['apply']; ?></button>
                        <?php endif; ?>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="startdate" 
                                   value="<?php echo $_GET['startdate']; ?>" data-date="<?php echo $_GET['startdate']; ?>" data-date-format="yyyy/mm/dd" 
                                   placeholder="<?php echo Language::$phrases['context']['start_date']; ?>" style="display: inline;margin-right: 1px;width: 120px;" />
                            <input type="text" class="form-control datepicker" name="enddate" 
                                   value="<?php echo $_GET['enddate']; ?>" data-date="<?php echo $_GET['enddate']; ?>" data-date-format="yyyy/mm/dd" 
                                   placeholder="<?php echo Language::$phrases['context']['end_date']; ?>" style="width: 120px;" />
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary"><?php echo Language::$phrases['action']['filter']; ?></button>
                            </span>
                        </div>
                    </div>
                    <div class="search pull-right">
                        <div class="input-group">
                            <input type="text" class="form-control" name="s" />
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit"><?php echo Language::$phrases['action']['search']; ?></button>
                            </span>
                        </div>
                    </div>
                </div>

                <?php echo $this->table; ?>
            </form>
        </div>
    </div>
</div>
<!--END MAIN-->
<?php include(ADMIN_PATH . 'view' . DS . 'footer.php'); ?>