<?php
require './PlayPHP/class/Controller.php';
require './model/BlogPost.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Frontend
 *
 * @author yuri.blanc
 */
class Frontend extends Controller {
 
    
    public function index() {
        $view = new \PlayPhp\Classes\View();
        $bottom = array(
            'bottom' => array(
                'bottom_title' => 'titolo1',
                'bottom_text' => 'testo1'
        )
        );
        $view->renderArgs("bottom", $bottom);
        $view->renderArgs("page_title","Welcome");
        $view->render(get_class($this), "index", "Welcome");

    }
    public function login() {
        $view =  new \PlayPhp\Classes\View();
        $view->renderArgs("page_title","Login");
        $view->render(get_class($this), "login");
        
    }
    
    public function authenticate($params) {
       if (isset($params->getPost()['username']) && isset($params->getPost()['password'])) {
           $username = $params->getPost()['username'];
           $password = $params->getPost()['password'];
           
           if ($username == "admin" && $password == "pass") {
                  $this->keep("test", "ciao");
                  Controller::setSession("user", "admin");
//                setcookie("test", "ciao");
                  Router::switchAction("Frontend@blog");
           }
       }
    }
    
    
    public function register() {
        $view =  new \PlayPhp\Classes\View();
        $view->renderArgs("page_title","Register");
        $view->render(get_class($this), "register", "Registra");
        
    }
    
    public function blog($params) {
        echo Controller::getSession("user");
        $view =  new \PlayPhp\Classes\View();
        $db = new Database();
        $obj = new BlogPost();
        $current = isset($params->getGet()['page']) ? $params->getGet()['page'] : 0;
       
        $items = $db->countObjects($obj);
        $pages = ceil($items/5);
        $blogPosts = $db->findAll($obj);
        $view->renderArgs("page_title","Blog");
        $view->renderArgs("pages",$pages);
        $view->renderArgs("posts", $blogPosts);
        $view->render(get_class($this), "blog");
    }
}
