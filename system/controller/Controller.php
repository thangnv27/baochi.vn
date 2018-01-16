<?php

class Controller {

    public $model;
    public $view;

    public function __construct() {
//        $this->verify();
        $currentURL = getCurrentRquestUrl();
        if(strpos(Registry::$siteurl, "www.") === FALSE and strpos($currentURL, "www.") !== FALSE){
            $url = str_replace("www.", "", $currentURL);
            $this->redirect($url);
        }
        $this->view = new View();
    }

    public function loadModel($name) {
        $modelName = ucfirst($name) . 'Model';
        if (class_exists($modelName)) {
            $this->model = new $modelName();
        }
        /*
          $path = APP_PATH . 'model' . DS . ucfirst($name) . '.php';
          if (file_exists($path)) {
          $modelName = ucfirst($name) . 'Model';
          $this->model = new $modelName();
          }
         */
    }

    public function render($name, $parameters = array()) {
        $this->view->render($name, $parameters);
    }

    public function getTemplate() {
        return new Template();
    }

    public function getRequest() {
        return new Request();
    }

    public function response() {
        return new Response();
    }

    public function getSession() {
        return new Session();
    }

    public function redirect($url) {
        header("location: $url");
        exit();
    }

    public function verify() {
        $domain = Registry::$settings['config']['domain'];
        $secret_key = Registry::$settings['system']['secret_key'];
        $access_key = explode("-", strtolower(Registry::$settings['system']['access_key']));
        $access_key = $access_key[1] . $access_key[3] . $access_key[2] . $access_key[0];
        $encrypt = strtolower(Hash::create('SHA1', $domain, $secret_key));
        $url = parse_url(Registry::$siteurl);
        if ($access_key != $encrypt or strpos($url['host'], $domain) === FALSE)
            exit();
    }
    
    public function Memcache($host = 'localhost', $port = 11211) {
        $memcache = new Memcache();
        $memcache->connect($host, $port) or die ("Không thể kết nối Memcache!");
        return $memcache;
    }

}
