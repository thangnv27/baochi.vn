<?php

class MenuModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function get_second_menu() {
        return $this->DB()->select(TABLE_PREFIX . "menu", "*", array(
                    'name' => 'second_menu',
                        ), 'displayorder');
    }

    public function getNavigation($name) {
        $currentURL = getCurrentRquestUrl();
        $currentURL = parse_url($currentURL);
        $currentURL = trailingslashit($currentURL['host'] . $currentURL['path']);
        $result = '<ul>';
        $menus = $this->DB()->select(TABLE_PREFIX . "menu", "*", array(
            'name' => $name,
            'parent' => 0,
            'lang_code' => Language::$lang_content,
                ), 'displayorder');
        foreach ($menus as $menu) {
            $childs = $this->getNavigationChilds($name, $menu['id']);
            $url = parse_url($menu['url']);
            $url = trailingslashit($url['host'] . $url['path']);
            $class_attr = "";
            if ($url == $currentURL) {
                $class_attr .= " menu-active";
            }
            if (empty($childs)) {
                $result .= '<li class="menu-item menu-item-' . $menu['id'] . $class_attr . '"><a href="' . $menu['url'] . '">' . $menu['description'] . $menu['title'] . '</a></li>';
            } else {
                $result .= '<li class="menu-item menu-item-' . $menu['id'] . $class_attr . ' parent_menu">';
                $result .= '<a href="' . $menu['url'] . '">' . $menu['title'] . ' <b class="caret"></b></a>';
                $result .= $childs;
                $result .= '</li>';
            }
        }
        $result .= '</ul>';
        return $result;
    }

    function getNavigationChilds($name, $parent) {
        $result = "";
        $menus = $this->DB()->select(TABLE_PREFIX . "menu", "*", array(
            'name' => $name,
            'parent' => intval($parent),
            'lang_code' => Language::$lang_content,
                ), 'displayorder');
        if (!empty($menus)) {
            $result .= '<ul class="sub-menu">';
            foreach ($menus as $menu) {
                $childs = $this->getNavigationChilds($name, $menu['id']);
                if (empty($childs)) {
                    $result .= '<li class="menu-item menu-item-' . $menu['id'] . '"><a href="' . $menu['url'] . '">' . $menu['title'] . '</a></li>';
                } else {
                    $result .= '<li class="menu-item menu-item-' . $menu['id'] . '">';
                    $result .= '<a href="' . $menu['url'] . '">' . $menu['title'] . '</a>';
                    $result .= $childs;
                    $result .= '</li>';
                }
            }
            $result .= '</ul>';
        }
        return $result;
    }

    public function getFooterNav() {
        $result = '<ul>';
        $menus = $this->DB()->select(TABLE_PREFIX . "menu", "*", array(
            'name' => 'footer_menu',
            'parent' => 0,
            'lang_code' => Language::$lang_content,
                ), 'displayorder');
        foreach ($menus as $menu) {
            
            $url = parse_url($menu['url']);
            $url = trailingslashit($url['host'] . $url['path']);
            $result .= '<li><a href="' . $menu['url'] . '" title="'. $menu['title'] .'"><img src="' . $menu['image'] . '" /></a></li>';
        }
        $result .= '</ul>';
        return $result;
    }

}
