<?php
/**
 *
 * SimpleBlog
 *
 * Blog Post Object
 *
 * This is the class for a post
 *
 * @author    Sergio Paulino <me@sergiopaulino.net>
 * @link      http://www.sergiopaulino.net
 * @copyright Copyright (c) Sérgio Paulino
 * @license   All rights reserved
 */

class BlogPost extends DataMapper{

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
            $sql = <<<SQL
SELECT count(`id`) FROM `user`
WHERE `user` = :user AND `password` = :password
SQL;

            $st = self::$db->prepare($sql);
            $st->execute(array(
                ':user' => $user,
                ':password'=> password_hash($password, PASSWORD_BCRYPT)
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

    public function editPost($id, $data) {

        try {
            $sql = <<<SQL
UPDATE `post` SET `title` = :title, `slug` = :slug, `text` = :text
WHERE `id` = :id
SQL;

            $st = self::$db->prepare($sql);
            $st->execute(array(
                ':title' => $data->title,
                ':slug' => $data->slug,
                ':text' => $data->text,
                ':id' => $id
            ));
        } catch(Exception $e) {
            echo "Application error: " . $e->getMessage();
        }

    }

}
