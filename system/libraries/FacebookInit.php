<?php

class FacebookInit {

    function __construct() {
        require SYS_PATH . 'libraries' . DS . 'sdk' . DS . 'facebook.php';
    }

    function facebook() {
        return new Facebook(array(
            'appId' => Registry::$settings['config']['fb']['appId'],
            'secret' => Registry::$settings['config']['fb']['secret'],
            'cookie' => Registry::$settings['config']['fb']['cookie'],
            //'allowSignedRequest' => false,
        ));
    }

}
