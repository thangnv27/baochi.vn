<?php

class UserModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function getSalt($username) {
        $user = $this->DB()->select(TABLE_PREFIX . "users", array('salt'), array('username' => $username));
        if (!empty($user)) {
            return $user[0]['salt'];
        } else {
            return "";
        }
    }

    /**
     * 
     * @param string $username
     * @return boolean
     */
    public function isUsernameExists($username) {
        $result = $this->DB()->select(TABLE_PREFIX . "users", 'COUNT(username) AS total', array('username' => $username));
        if ($result[0]['total'] == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 
     * @param string $email
     * @return boolean
     */
    public function isEmailExists($email) {
        $result = $this->DB()->select(TABLE_PREFIX . "users", 'COUNT(email) AS total', array('email' => $email));
        if ($result[0]['total'] == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getCapabilityByRole($role) {
        $group = $this->DB()->select(TABLE_PREFIX . "usergroups", 'capability', array('role' => $role));
        if (count($group) == 0) {
            return "";
        } else {
            return $group[0]['capability'];
        }
    }

    public function getUserLogin($where) {
        try {
            $db = $this->DB();
            $stm = $db->prepare("SELECT * FROM " . TABLE_PREFIX . "users U LEFT JOIN " . TABLE_PREFIX . "usermeta UM 
                ON U.id = UM.user_id WHERE " . $db->where($where) . " LIMIT 1");
            if (is_array($where)) {
                foreach ($where as $key => $value) {
                    $stm->bindValue(":$key", $value);
                }
            }
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            Debug::throwException("Database error!", $exc);
            return FALSE;
        }
    }

    function checkUser($uid, $oauth_provider, $userdata, $usermeta) {
        try {
            $db = $this->DB();
            $where = array(
                'oauth_uid' => $uid,
                'oauth_provider' => $oauth_provider,
            );
            $result = $this->getUserLogin($where);
            if (!empty($result)) {
                return $result[0];
            } else {
                $user_id = $db->insert(TABLE_PREFIX . "users", $userdata);
                if ($user_id) {
                    $usermeta['user_id'] = $user_id;
                    $db->insert(TABLE_PREFIX . "usermeta", $usermeta);
                    $result = $this->getUserLogin($where);
                    return $result[0];
                } else {
                    return FALSE;
                }
            }
        } catch (Exception $exc) {
            Debug::throwException("Database error!", $exc);
            return FALSE;
        }
    }

    /**
     * Create a new User
     * @param array $data 
     * @return int|bool
     */
    public function createUser($data) {
        return $this->DB()->insert(TABLE_PREFIX . "users", $data);
    }

    /**
     * Add meta data for User
     * @param array $meta User meta data
     * @return int|bool
     */
    public function createUserMeta($meta) {
        return $this->DB()->insert(TABLE_PREFIX . "usermeta", $meta);
    }

    /**
     * Get User by field is unique: id, username, email
     * @param int|string $val Value of [id, username, email]
     * @return null
     */
    public function getUserByFieldUnique($val) {
        try {
            $sql = "SELECT * FROM " . TABLE_PREFIX . "users U LEFT JOIN " . TABLE_PREFIX . "usermeta UM 
                    ON U.id = UM.user_id WHERE U.username = '$val' OR U.email = '$val' LIMIT 1";
            if (is_numeric($val)) {
                $sql = "SELECT * FROM " . TABLE_PREFIX . "users U LEFT JOIN " . TABLE_PREFIX . "usermeta UM 
                    ON U.id = UM.user_id WHERE U.id = $val LIMIT 1";
            }
            $db = $this->DB();
            $stm = $db->prepare($sql);
            $stm->execute();
            $user = $stm->fetchAll(PDO::FETCH_ASSOC);
            if (count($user) == 0) {
                return null;
            } else {
                $user[0]['user_id'] = $user[0]['id'];
                $user[0]['capability'] = @unserialize($user[0]['capability']);
                return $user[0];
            }
        } catch (Exception $exc) {
            if (DEBUG == TRUE) {
                Debug::throwException("Database error!", $exc);
            }
            return null;
        }
    }

    /**
     * 
     * @param string $password
     * @param int $user_id
     */
    public function updatePassword($password, $user_id) {
        return $this->DB()->update(TABLE_PREFIX . "users", array('password' => $password), array('id' => $user_id));
    }

}
