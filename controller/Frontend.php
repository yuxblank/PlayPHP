<?php
//require './PlayPHP/class/Controller.php';
require './PlayPHP/class/Secure.php';
require './model/BlogPost.php';
require './model/Users.php';
/*
 * Copyright (C) 2015 yuri.blanc
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
/**
 * Description of Frontend
 *
 * @author yuri.blanc
 */
class Frontend extends Secure {
 
    
    public function index() {
        \PlayPHP\utils\Logger::error("ciao");
        $view = new \PlayPhp\Classes\View();
        $bottom = array(
            'bottom' => array(
                'bottom_title' => 'titolo1',
                'bottom_text' => 'testo1'
        )
        );
        $view->renderArgs("bottom", $bottom);
        $view->renderArgs("page_title","Welcome");
        $view->render("Frontend/index");

    }
    public function login() {
    
        if (Controller::getSession('user')==null) {
            
        $view =  new \PlayPhp\Classes\View();
        $view->renderArgs("page_title","Login");
        $view->render("Frontend/login");
        } else {
            Controller::keep("error", "Already logged in");
            Router::switchAction('Frontend@blog');
        }
    }
    public function logout() {
        Controller::stopSession();
        Router::switchAction("Frontend@login");
        
    }
    
    public function authenticate($params) {
       if ($params->getPost('username') && $params->getPost('password')) {
           $username = $params->getPost('username');
           $password = $params->getPost('password');
           $user = new Users();
           $db = new Database(); 
       
           
           $db->find($user, "WHERE username=? AND pass=?", $params);
           if ($username == "admin" && $password == "pass") {
                  $this->keep("test", "ciao");
                  Controller::setSession("user", "admin");
//                setcookie("test", "ciao");
                  Router::switchAction("Frontend@blog");
           }
       }
    }
    
    public function authenticateAjax($params){

        
        if ($params->getPost('username') && $params->getPost('password')) {
           $username = $params->getPost('username');
           $password = $params->getPost('password');
           
           
           $db = new Database(); 
           $dbUser = $db->find('Users', "WHERE username=? AND password=?", array($username, Secure::encryptPassword($password)));
           if ($dbUser) {
                    Controller::setSession("user", $username);
//                  Controller::renderJSON("OK");
                    echo "OK";
           } else {
               echo "k/o";
           }
       }
    }
    
    
    public function register($params) {
        
        if (Controller::getSession('user')==null && $params->getPost()==null) {
            $view =  new \PlayPhp\Classes\View();
            $view->renderArgs("page_title","Register");
            $view->render("Frontend/register");
    } else if ($params->getPost('username') && $params->getPost('password')) {
            $username = $params->getPost('username');
            $password = sha1($params->getPost('password'));  
            $user = new Users($username, $password);
            $db = new Database();
            $db->save($user);
            Controller::keep("error", "Thank you for registering, now you can login");
            Router::switchAction("Frontend@login");
        } else {
            Controller::keep("error", "You are already logged in");
            Router::switchAction("Frontend@index");
        }
        
    }
    
    
    public function blog($params) {
     
        $view =  new \PlayPhp\Classes\View();
        

        $current = $params->getGet('page') ? $params->getGet('page') : 0;
        $blogPosts = new BlogPost();
//        $items = $db->countObjects('Blogpost');
//        $pages = ceil($items/5);
        $blogPosts = $blogPosts->findAll();
        $view->renderArgs("page_title","Blog");
        //$view->renderArgs("pages",$pages);
        $view->renderArgs("posts", $blogPosts);
        $view->render("Frontend/blog");
    }
    
    
    
    
    public function addComment($params) {
        
        if ($params->getPost()!=null) {
            $comments = new Comments(null, $params->getPost('blogpost_id'),  $params->getPost('title'),
            $params->getPost('text'),  $params->getPost('vote'));
            $view = new \PlayPhp\Classes\View();
            if ($comments->save($comments)) {
                echo "OK";
                exit();
            } else {
                  $view->renderJson(array(0,'unable to save'));
            }
        } 
    }
    
}
