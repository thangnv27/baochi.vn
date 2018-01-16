<?php include(ADMIN_PATH . 'view' . DS . 'header.php'); ?>
<!--MAIN-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 main">
            <form action="" method="get">
                <!--Table-->
                <div class="action-bar">
                    <a href="./"><span class="label label-primary"><?php echo Language::$phrases['context']['all']; ?></span></a>
                    <a href="./?status=0"><span class="label label-success"><?php echo Language::$phrases['context']['live']; ?></span></a>
                    <a href="./?status=1"><span class="label label-warning"><?php echo Language::$phrases['context']['die']; ?></span></a>
                </div>
                <div class="action-bar">
                    <div class="btn-bar pull-left">
                        <?php if ($current_user['capability']['rss']['create'] == 1) : ?>
                        <a href="addnew" class="btn btn-success"><?php echo Language::$phrases['action']['addnew']; ?></a>
                        <?php endif; ?>
                        <select name="action">
                            <option value=""><?php echo Language::$phrases['action']['bulkActions']; ?></option>
                            <?php if ($current_user['capability']['rss']['delete'] == 1) : ?>
                            <option value="delete"><?php echo Language::$phrases['action']['delete']; ?></option>
                            <?php endif; ?>
                        </select>
                        <button type="submit" class="btn btn-primary"><?php echo Language::$phrases['action']['apply']; ?></button>
                        <select name="source">
                            <option value=""><?php echo Language::$phrases['context']['view_all_sources']; ?></option>
                            <?php
                            foreach ($this->filter_source as $key => $value) {
                                if ($this->request->get('source') == $key) {
                                    echo "<option value=\"{$key}\" selected=\"selected\">{$value}</option>";
                                } else {
                                    echo "<option value=\"{$key}\">{$value}</option>";
                                }
                            }
                            ?>
                        </select>
                        <select name="category">
                            <option value=""><?php echo Language::$phrases['context']['view_all_categories']; ?></option>
                            <?php
                            foreach ($this->filter_category as $key => $value) {
                                if ($this->request->get('category') == $key) {
                                    echo "<option value=\"{$key}\" selected=\"selected\">{$value}</option>";
                                } else {
                                    echo "<option value=\"{$key}\">{$value}</option>";
                                }
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-primary"><?php echo Language::$phrases['action']['filter']; ?></button>
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