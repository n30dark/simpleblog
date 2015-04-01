<?php
/**
 *
 * SimpleBlog
 *
 * User Object
 *
 * This is the class for an user
 *
 * @author    Sergio Paulino <me@sergiopaulino.net>
 * @link      http://www.sergiopaulino.net
 * @copyright Copyright (c) Sérgio Paulino
 * @license   All rights reserved
 */

class User extends DataMapper{

    public $id;
    public $user;
    public $password;

    public function __construct($data) {

        if(isset($data->id)) {
            $this->id = $data->id;
        } else {
            $this->id = -1;
        }
        $this->user = $data->user;
        $this->password = $data->password;

    }

    public function login($user, $password) {
        try {

            $this->db = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);
            $sql = <<<SQL
SELECT count(`id`) FROM `user`
WHERE `user` = :user AND `password` = :password
SQL;

            $st = $this->db->prepare($sql);
            $st->execute(array(
                ':user' => $user,
                ':password'=> md5($password)
            ));
            if($st->fetch() > 0) {
                return true;
            }else {
                return false;
            }

        } catch(Exception $e) {
            echo "Application error: " . $e->getMessage();
        }
    }

}
