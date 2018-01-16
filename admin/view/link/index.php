<?php include(ADMIN_PATH . 'view' . DS . 'header.php'); ?>
<!--MAIN-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 main">
            <form action="" method="get">
                <!--Table-->
                <div class="action-bar">
                    <a href="./"><span class="label label-primary"><?php echo Language::$phrases['context']['all']; ?></span></a>
                    <a href="./?status=draft"><span class="label label-default"><?php echo Language::$phrases['context']['draft']; ?></span></a>
                    <a href="./?status=pending_approval"><span class="label label-warning"><?php echo Language::$phrases['context']['pending_approval']; ?></span></a>
                    <a href="./?status=trashed"><span class="label label-danger"><?php echo Language::$phrases['context']['trash']; ?></span></a>
                </div>
                <div class="action-bar">
                    <div class="btn-bar pull-left">
                        <?php if ($current_user['capability']['links']['create'] == 1) : ?>
                            <a href="addnew" class="btn btn-success"><?php echo Language::$phrases['action']['addnew']; ?></a>
                        <?php endif; ?>
                        <select name="action">
                            <option value=""><?php echo Language::$phrases['action']['bulkActions']; ?></option>
                            <?php if ($current_user['capability']['links']['edit'] == 1) : ?>
                                <option value="publish"><?php echo Language::$phrases['action']['publish']; ?></option>
                                <option value="move2trash"><?php echo Language::$phrases['action']['move2trash']; ?></option>
                            <?php endif; ?>
                            <?php if ($current_user['capability']['links']['delete'] == 1) : ?>
                                <option value="delete"><?php echo Language::$phrases['action']['delete_permanently']; ?></option>
                            <?php endif; ?>
                        </select>
                        <button type="submit" class="btn btn-primary"><?php echo Language::$phrases['action']['apply']; ?></button>
                        <select name="author" style="width:180px">
                            <option value=""><?php echo Language::$phrases['context']['view_all_user']; ?></option>
                            <?php
                            foreach ($this->filter_user as $key => $value) {
                                if ($this->request->get('author') == $value['id']) {
                                    echo "<option value=\"{$value['id']}\" selected=\"selected\">{$value['username']}</option>";
                                } else {
                                    echo "<option value=\"{$value['id']}\">{$value['username']}</option>";
                                }
                            }
                            ?>
                        </select>
                        <select name="category" style="width:180px">
                            <option value=""><?php echo Language::$phrases['context']['view_all_categories']; ?></option>
                            <?php
                            foreach ($this->categories as $key => $value) {
                                if ($this->request->get('category') == $key) {
                                    echo "<option value=\"{$key}\" selected=\"selected\">{$value}</option>";
                                } else {
                                    echo "<option value=\"{$key}\">{$value}</option>";
                                }
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-primary"><?php echo Language::$phrases['action']['filter']; ?></button>
                        <select name="move2category" style="width:180px">
                            <option value=""><?php echo Language::$phrases['context']['select_category']; ?></option>
                            <?php
                            foreach ($this->categories as $key => $value) {
                                if ($this->request->get('move2category') == $key) {
                                    echo "<option value=\"{$key}\" selected=\"selected\">{$value}</option>";
                                } else {
                                    echo "<option value=\"{$key}\">{$value}</option>";
                                }
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-primary"><?php echo Language::$phrases['action']['move']; ?></button>
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