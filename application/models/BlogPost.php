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

class BlogPost{

    public $id;
    public $title;
    public $slug;
    public $text;
    public $date;
    private $db;

    public function __construct($data) {

        $this->db = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);

        if(isset($data->id)) {
            $this->id = $data->id;
        } else {
            $this->id = -1;
        }
        if(strlen($data->title)<=50) {
            $this->title = $data->title;
        }
        $this->slug = $data->slug;
        $this->text = $data->text;
        $this->date = $data->date;

    }

    public function addPost($data) {

        try {
            $this->db = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);

            $sql = <<<SQL
INSERT INTO `post`(`title`, `text`)
VALUES (:title,:text)
SQL;

            $st = $this->db->prepare($sql);
            $st->execute(array(
                ':title' => $data->title,
                ':text' => $data->text
            ));
        } catch(Exception $e) {
            echo "Application error: " . $e->getMessage();
        }


    }

    public function delPost($id) {

        try{
            $this->db = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);

            $sql = <<<SQL
DELETE FROM `post` WHERE `id` = $id
SQL;
            $st = $this->db->prepare($sql);
            $st->execute(array(":id" => $id));

        } catch(Exception $e) {
            echo "Application error: " . $e->getMessage();
        }

    }

    public function getPost($id) {
        try {
            $this->db = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);

            $sql = <<<SQL
SELECT * FROM `post` WHERE `id` = :id
SQL;

            $st = $this->db->prepare($sql);
            $st->execute(array(
                ':id' => $id
            ));
            $ret = null;
            while($row = $st->fetch()) {
                $ret = new BlogPost((Object)$row);
            }

            return $ret;

        } catch(Exception $e) {
            echo "Application error: " . $e->getMessage();
        }
    }

    public function editPost($id, $data) {

        try {
            $this->db = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);

            $sql = <<<SQL
UPDATE `post` SET `title` = :title, `text` = :text
WHERE `id` = :id
SQL;

            $st = $this->db->prepare($sql);
            $st->execute(array(
                ':title' => $data->title,
                ':text' => $data->text,
                ':id' => $id
            ));
        } catch(Exception $e) {
            echo "Application error: " . $e->getMessage();
        }

    }

    public function getAll() {

        try {

            $this->db = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);

            $sql = <<<SQL
SELECT * FROM `post`
SQL;

            $st = $this->db->prepare($sql);
            $st->execute();
            $posts = [];
            while($row = $st->fetch()) {
                $posts[] = new BlogPost((Object)$row);
            }

            return $posts;

        } catch(Exception $e) {
            echo "Application error: " . $e->getMessage();
        }

    }

}
