<?php

class TPL {

    public static function getSiteOption() {
        $option = file_get_contents(DB_PATH . 'options.json');
        $option = json_decode($option);
        $option->site_option->footer_info = stripslashes($option->site_option->footer_info);
        return $option->site_option;
    }

    public static function getContactInfo() {
        $option = file_get_contents(DB_PATH . 'options.json');
        $option = json_decode($option);
        return $option->contact_info;
    }

    public static function getADS() {
        $option = file_get_contents(DB_PATH . 'options.json');
        $option = json_decode($option);
        return $option->ads;
    }

    public static function getSocialLink() {
        $option = file_get_contents(DB_PATH . 'options.json');
        $option = json_decode($option);
        return $option->social;
    }

    public function getListCatFooter() {
        //        footer category
        $memcache = new Memcache();
        $memcache->connect(localhost, 11211) or die("Không thể kết nối Memcache!");

        $cats_cached = $memcache->get(CACHE_PREFIX . 'footercat');
        if (!$cats_cached) {
            if (!class_exists('WelcomeModel')) {
                require_once APP_PATH . 'model' . DS . 'WelcomeModel.php';
            }
            $welcomeModel = new WelcomeModel();
            $cats = $welcomeModel->allCategory();
            $memcache->set(CACHE_PREFIX . 'footercat', $cats, FALSE, time() + 60 * 60 * 1); // 1 tieng
            $cats_cached = $memcache->get(CACHE_PREFIX . 'footercat');
        }
        return $cats_cached;
    }

    public static function getMenu() {
        if (!class_exists('MenuModel')) {
            require_once APP_PATH . 'model' . DS . 'MenuModel.php';
        }
        $menu = new MenuModel();
        $primary_menu = $menu->getNavigation('primary_menu');
        $second_menu = $menu->getNavigation('second_menu');
        $footer_menu = $menu->getFooterNav();
        return array(
            'primary_menu' => $primary_menu,
            'second_menu' => $second_menu,
            'footer_menu' => $footer_menu,
        );
    }

    public static function getSources() {
        if (!class_exists('WelcomeModel')) {
            require_once APP_PATH . 'model' . DS . 'WelcomeModel.php';
        }
        $welcomeModel = new WelcomeModel();
        return $welcomeModel->mobileSources();
    }

    public static function getCategories() {
        if (!class_exists('MobileModel')) {
            require_once APP_PATH . 'model' . DS . 'MobileModel.php';
        }
        $mobileModel = new MobileModel();
        return $mobileModel->categoryOptions(false);
    }

}
