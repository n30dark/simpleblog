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
    public $title;
    public $slug;
    public $text;
    public $date;

    public function __construct($data) {

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

    public function addPost() {

        try {
            $sql = <<<SQL
INSERT INTO `post`(`title`, `slug`, `text`)
VALUES (:title,:slug,:text)
SQL;

            $st = self::$db->prepare($sql);
            $st->execute(array(
                ':title' => $this->title,
                ':slug' => $this->slug,
                ':text' => $this->text
            ));
        } catch(Exception $e) {
            echo "Application error: " . $e->getMessage();
        }


    }

    public function delPost($id) {

        try{
            $sql = <<<SQL
DELETE FROM `post` WHERE `id` = $id
SQL;
            $st = self::$db->prepare($sql);
            $st->execute(array(":id" => $id));

        } catch(Exception $e) {
            echo "Application error: " . $e->getMessage();
        }

    }

    public function getPost($id) {
        try {
            $sql = <<<SQL
SELECT * FROM `post` WHERE `id` = :id
SQL;

            $st = self::$db->prepare($sql);
            $st->execute(array(
                ':id' => $id
            ));
            while($row = $st->fetch()) {
                return $this->__construct((Object)$row);
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
