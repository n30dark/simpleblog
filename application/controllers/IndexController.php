<?php
/**
 * Micro MVC
 *
 * Index Controller
 *
 * This is the controller for the Index
 *
 * @author    Sergio Paulino <me@sergiopaulino.net>
 * @link      http://www.sergiopaulino.net
 * @copyright Copyright (c) Sérgio Paulino
 * @license   All rights reserved
 */

class IndexController extends Controller{

    public function index() {

        try{
            $this->_setModel("index");
            $this->_setView("index");
            $this->_view->set("posts", BlogPost::getAll());
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error: " . $e->getMessage();
        }

    }

    public function single() {

        try{
            $this->_setModel("index");
            $this->_setView("single");
            $post = BlogPost::getPost($_GET['id']);
            $this->_view->set("post", $post);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error: " . $e->getMessage();
        }
    }

    public function listPosts() {

        try{
            $this->_setModel("admin");
            $this->_setView("list_posts");
            $this->_view->set("posts", BlogPost::getAll());
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error: " . $e->getMessage();
        }

    }

    public function login() {

        try{
            $this->_setModel("admin");
            $this->_setView("login");

            if(User::login($_POST["user"], $_POST["password"])) {
                $this->listPosts();
            } else {
                return $this->_view->output();
            }

        } catch (Exception $e) {
            echo "Application error: " . $e->getMessage();
        }

    }

    public function editPost() {

        try{
            $this->_setModel("admin");
            $this->_setView("edit_post");

            if(isset($_POST["title"])) {
                BlogPost::editPost($_GET["id"], (Object)$_POST);
                $this->listPosts();
            }

            $post = BlogPost::getPost($_GET['id']);
            $this->_view->set("post", $post);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error: " . $e->getMessage();
        }

    }

    public function addPost() {

        try{
            $this->_setModel("admin");
            $this->_setView("edit_post");

            if(isset($_POST["title"])) {
                BlogPost::addPost((Object)$_POST);
                $this->listPosts();
            }

            $post = new BlogPost(null);
            $this->_view->set("post", $post);
            return $this->_view->output();

        } catch (Exception $e) {
            echo "Application error: " . $e->getMessage();
        }

    }

    public function deletePost() {

        try{
            BlogPost::delPost($_GET['id']);
            $this->listPosts();

        } catch (Exception $e) {
            echo "Application error: " . $e->getMessage();
        }

    }

    public function logout() {

        try{
            $this->index();
        } catch (Exception $e) {
            echo "Application error: " . $e->getMessage();
        }

    }

}
