<?php
$current_user = UserAdmin::checkLogin();
$optionAdmin = new OptionAdmin();
$option = $optionAdmin->get_option();
$site_option = $option->site_option;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="robots" content="noindex, nofollow" /> 
        <meta name="googlebot" content="noindex, nofollow" />
        <meta name="bingbot" content="noindex, nofollow" />

        <title><?php echo $this->title; ?> &laquo; <?php echo $site_option->name; ?></title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo Registry::$siteurl; ?>/public/admin/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Main styles for this template -->

        <link href="<?php echo Registry::$siteurl; ?>/public/admin/libs/select2/select2.css" rel="stylesheet" />
        <link href="<?php echo Registry::$siteurl; ?>/public/admin/libs/colorbox/colorbox.css" rel="stylesheet" />
        <link href="<?php echo Registry::$siteurl; ?>/public/admin/css/datepicker.css" rel="stylesheet" />
        <link href="<?php echo Registry::$siteurl; ?>/public/admin/css/switchButton.css" rel="stylesheet" />
        <link href="<?php echo Registry::$siteurl; ?>/public/admin/css/main.css" rel="stylesheet" />

        <!-- Include Scripts -->
        <script>
            var siteurl = "<?php echo Registry::$siteurl; ?>";
            var dashboard_url = "<?php echo DASHBOARD_URL; ?>";
            var login_url = "<?php echo get_admin_login_url(); ?>";
            var elfinder_url = siteurl + '/public/admin/elfinder/elfinder.php';
            var post_tags = [<?php echo $this->tags; ?>];
        </script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--BEGIN NAVIGATION-->
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo DASHBOARD_URL ?>">DASHBOARD</a> 
                    <a class="navbar-brand" href="<?php echo Registry::$siteurl ?>" target="_blank">SITE</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if ($current_user['capability']['blacklistDomains']['view'] == 1) : ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?php echo Language::$phrases['page']['blacklist_domain']['labels']; ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php if ($current_user['capability']['blacklistDomains']['view'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/domain/' ?>"><?php echo Language::$phrases['context']['all']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($current_user['capability']['blacklistDomains']['create'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/domain/addnew' ?>"><?php echo Language::$phrases['action']['addnew']; ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if ($current_user['capability']['rss']['view'] == 1) : ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">RSS <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php if ($current_user['capability']['rss']['view'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/rss/' ?>"><?php echo Language::$phrases['context']['all']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($current_user['capability']['rss']['create'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/rss/addnew' ?>"><?php echo Language::$phrases['action']['addnew']; ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if ($current_user['capability']['pages']['view'] == 1) : ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?php echo Language::$phrases['page']['page']['labels']; ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php if ($current_user['capability']['pages']['view'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/page/' ?>"><?php echo Language::$phrases['context']['all']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($current_user['capability']['pages']['create'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/page/addnew' ?>"><?php echo Language::$phrases['action']['addnew']; ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if ($current_user['capability']['links']['view'] == 1) : ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?php echo Language::$phrases['page']['link']['labels']; ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php if ($current_user['capability']['links']['view'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/link/' ?>"><?php echo Language::$phrases['context']['all']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($current_user['capability']['links']['create'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/link/addnew' ?>"><?php echo Language::$phrases['action']['addnew']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($current_user['capability']['categories']['view'] == 1) : ?>
                                        <li class="divider"></li>
                                        <li><a href="<?php echo DASHBOARD_URL . '/linkCategory/' ?>"><?php echo Language::$phrases['page']['category']['labels']; ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if ($current_user['capability']['posts']['view'] == 1) : ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?php echo Language::$phrases['page']['post']['labels']; ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php if ($current_user['capability']['posts']['view'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/post/' ?>"><?php echo Language::$phrases['context']['all']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($current_user['capability']['posts']['create'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/post/addnew' ?>"><?php echo Language::$phrases['action']['addnew']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($current_user['capability']['categories']['view'] == 1) : ?>
                                        <li class="divider"></li>
                                        <li><a href="<?php echo DASHBOARD_URL . '/category/' ?>"><?php echo Language::$phrases['page']['category']['labels']; ?></a></li>
                                        <li><a href="<?php echo DASHBOARD_URL . '/sourceCategory/' ?>"><?php echo Language::$phrases['context']['source']; ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php /*if ($current_user['capability']['products']['view'] == 1) : ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?php echo Language::$phrases['page']['product']['labels']; ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php if ($current_user['capability']['products']['view'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/product/'; ?>"><?php echo Language::$phrases['context']['all']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($current_user['capability']['products']['create'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/product/addnew'; ?>"><?php echo Language::$phrases['action']['addnew']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($current_user['capability']['categories']['view'] == 1) : ?>
                                        <li class="divider"></li>
                                        <li><a href="<?php echo DASHBOARD_URL . '/productCategory/'; ?>"><?php echo Language::$phrases['page']['category']['labels']; ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if ($current_user['capability']['sliders']['view'] == 1) : ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?php echo Language::$phrases['page']['slider']['labels']; ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php if ($current_user['capability']['sliders']['view'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/slider/'; ?>"><?php echo Language::$phrases['context']['all']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($current_user['capability']['sliders']['create'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/slider/addnew'; ?>"><?php echo Language::$phrases['action']['addnew']; ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if ($current_user['capability']['orders']['view'] == 1) : ?>
                            <li><a href="<?php echo DASHBOARD_URL . '/order/?status=0'; ?>"><?php echo Language::$phrases['page']['order']['labels']; ?></a></li>
                        <?php endif;*/ ?>
                        <?php if ($current_user['capability']['users']['view'] == 1) : ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?php echo Language::$phrases['page']['user']['labels']; ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo DASHBOARD_URL . '/user/'; ?>"><?php echo Language::$phrases['context']['all']; ?></a></li>
                                    <?php if ($current_user['capability']['users']['create'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/user/addnew'; ?>"><?php echo Language::$phrases['action']['addnew']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($current_user['capability']['userGroups']['view'] == 1) : ?>
                                        <li class="divider"></li>
                                        <li><a href="<?php echo DASHBOARD_URL . '/userGroup/'; ?>"><?php echo Language::$phrases['page']['usergroup']['labels']; ?></a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if ($current_user['capability']['files']['view'] == 1) : ?>
                            <li><a href="<?php echo DASHBOARD_URL . '/file/'; ?>"><?php echo Language::$phrases['context']['media']; ?></a></li>
                        <?php endif; ?>
                        <?php if ($current_user['capability']['report']['view'] == 1) : ?>
                            <li><a href="<?php echo DASHBOARD_URL . '/report/'; ?>"><?php echo Language::$phrases['page']['report']['labels']; ?></a></li>
                        <?php endif; ?>
                        <?php if ($current_user['capability']['settings']['allow'] == 1) : ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?php echo Language::$phrases['context']['settings']; ?> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php if ($current_user['capability']['options']['view'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/option/'; ?>"><?php echo Language::$phrases['context']['general']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($current_user['capability']['menu']['manage'] == 1) : ?>
                                        <li><a href="<?php echo DASHBOARD_URL . '/menu/'; ?>"><?php echo Language::$phrases['page']['menu']['label']; ?></a></li>
                                    <?php endif; ?>
                                    <?php if ($current_user['capability']['languages']['view'] == 1) : ?>
                                        <!--<li><a href="<?php echo DASHBOARD_URL . '/language/'; ?>"><?php echo Language::$phrases['page']['language']['title']; ?></a></li>-->
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <?php if ($current_user['capability']['options']['view'] == 1) : ?>
                                <li><a href="<?php echo DASHBOARD_URL . '/option/'; ?>"><?php echo Language::$phrases['context']['general']; ?></a></li>
                            <?php endif; ?>
                            <?php if ($current_user['capability']['menu']['manage'] == 1) : ?>
                                <li><a href="<?php echo DASHBOARD_URL . '/menu/'; ?>"><?php echo Language::$phrases['page']['menu']['label']; ?></a></li>
                            <?php endif; ?>
                            <?php if ($current_user['capability']['languages']['view'] == 1) : ?>
                                <!--<li><a href="<?php echo DASHBOARD_URL . '/language/'; ?>"><?php echo Language::$phrases['page']['language']['title']; ?></a></li>-->
                            <?php endif; ?>
                        <?php endif; ?>
                        <li><a href="<?php echo DASHBOARD_URL . '/user/profile'; ?>"><?php echo Language::$phrases['context']['profile']; ?></a></li>
                        <li><a href="<?php echo DASHBOARD_URL . '/user/logout'; ?>" onclick="return confirm('<?php echo Language::$phrases['context']['logout.confirm']; ?>');"><?php echo Language::$phrases['context']['logout']; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--END NAVIGATION-->

        <!--BEGIN ALERT MESSAGE-->
        <?php if (isset($_SESSION['flash_message']) && count($_SESSION['flash_message']) > 0) : ?>
            <div class="panel-body">
                <?php if ($this->getSession()->hasFlash('success')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->getSession()->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->getSession()->hasFlash('info')): ?>
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->getSession()->getFlash('info'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->getSession()->hasFlash('warning')): ?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->getSession()->getFlash('warning'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->getSession()->hasFlash('danger')): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->getSession()->getFlash('danger'); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <!--END: BEGIN ALERT MESSAGE-->