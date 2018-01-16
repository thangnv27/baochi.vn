<?php

class User extends Controller {

    private $current_user = null;
    private static $user_login = null;

    function __construct() {
        parent::__construct();
        $this->current_user = self::getUserLoggedIn();
    }

    function myweb() {
        $userLinks = null;
        $wcModel = new WelcomeModel();
        if ($this->current_user) {
            $userLinks = $wcModel->getFavoriteLinks($this->current_user['user_id']);
        }
        
        $this->render('myweb.tpl', array(
            'title' => 'Danh bạ web của tôi',
            'userlink' => $userLinks,
        ));
    }

    function addlink() {
        
        $userLinks = null;
        $wcModel = new WelcomeModel();
        if ($this->current_user) {
            $userLinks = $wcModel->getFavoriteLinks($this->current_user['user_id']);
        }
        
        // Site option
        
        $this->render('addlink.tpl', array(
            'title' => "Thêm link vào danh bạ riêng",
        ));
    }

    function login_facebook() {
        $fbInit = new FacebookInit();
        $facebook = $fbInit->facebook();
        $login_url = $facebook->getLoginUrl(array(
            'scope' => array('email', 'user_location', 'user_birthday', 'publish_stream'),
        ));
        $user = null;

        # let's try getting the user id (getUser()) and user info (api->('/me'))
        try {
            $uid = $facebook->getUser();
            if ($uid) {
                $user = $facebook->api('/me', 'GET', array(
                    'message' => 'I want to display this message on my wall'
                ));
            }
        } catch (Exception $e) {
            Debug::throwException("Login error!", $e);
        }
        if ($user) {
            $username = $user['username'];
            $email = $user['email'];
            $dob = $user['birthday'];
            $address = $user['location']['name'];
            $gender = 0;
            if ($user['gender'] == 'male') {
                $gender = 1;
            }
            if ($this->model->isEmailExists($email)) {
                $userdata = $this->model->getUserLogin(array(
                    'email' => $email,
                    'is_deleted' => 0,
                ));
                $userdata = $userdata[0];
                unset($userdata['password']);
                $capability = $this->model->getCapabilityByRole($userdata['role']);
                $userdata['user_id'] = $userdata['id'];
                $userdata['capability'] = @unserialize($capability);
                $userdata['ip_logged_in'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['user_logged_in'] = $userdata;
                $user_store = serialize($userdata);
                setcookie('user_login', $user_store, time() + 3600 * 24 * 12, '/'); // 1 year
            } elseif ($this->model->isUsernameExists($username)) {
                $userdata = $this->model->getUserLogin(array(
                    'username' => $username,
                    'is_deleted' => 0,
                ));
                $userdata = $userdata[0];
                unset($userdata['password']);
                $capability = $this->model->getCapabilityByRole($userdata['role']);
                $userdata['user_id'] = $userdata['id'];
                $userdata['capability'] = @unserialize($capability);
                $userdata['ip_logged_in'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['user_logged_in'] = $userdata;
                $user_store = serialize($userdata);
                setcookie('user_login', $user_store, time() + 3600 * 24 * 12, '/'); // 1 year
            } else {
                $salt = Utils::fetch_user_salt(30);
                $pwd = Utils::fetch_random_password();
                $password = Utils::hash_password($pwd, $salt);
                $role = 'subscriber';
                $capability = $this->model->getCapabilityByRole($role);
                $userdata = $this->model->checkUser($uid, 'facebook', array(
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'salt' => $salt,
                    'role' => $role,
                    'capability' => $capability,
                    'ip_address' => $_SERVER['REMOTE_ADDR'],
                    'oauth_uid' => $uid,
                    'oauth_provider' => 'facebook',
                        ), array(
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'address' => $address,
                    'gender' => $gender,
                    'dob' => $dob,
                    'website' => $user['link'],
                ));
                if (!empty($userdata)) {
                    unset($userdata['password']);
                    $userdata['user_id'] = $userdata['id'];
                    $userdata['capability'] = @unserialize($capability);
                    $userdata['ip_logged_in'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['user_logged_in'] = $userdata;
                    $user_store = serialize($userdata);
                    setcookie('user_login', $user_store, time() + 3600 * 24 * 12, '/'); // 1 year
                }
            }
            $this->redirect(Registry::$siteurl);
        } else if (!isset($_GET['code'])) {
            $this->redirect($login_url);
        } else {
            Debug::throwException("Login error!", null);
        }
    }

    function logout() {
        unset($_SESSION['user_logged_in']);
        session_destroy();
        setcookie('user_login', null, -1, '/');

        $this->redirect(Registry::$siteurl);
    }

    public static function getUserLoggedIn() {
        if (isset($_SESSION['user_logged_in'])) {
            self::$user_login = $_SESSION['user_logged_in'];
        }
        return self::$user_login;
    }

}
