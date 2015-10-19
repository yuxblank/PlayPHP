<?php
//require './PlayPHP/class/Controller.php';
require './PlayPHP/class/Secure.php';
require './model/BlogPost.php';
require './model/Users.php';
require './PlayPHP/class/security/Crypto.php';

/**
 * Description of Frontend
 *
 * @author yuri.blanc
 */
class Frontend extends Secure {
 
    
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
       if (isset($params->getPost()['username']) && isset($params->getPost()['password'])) {
           $username = $params->getPost()['username'];
           $password = $params->getPost()['password'];
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

        
        if (isset($params->getPost()['username']) && isset($params->getPost()['password'])) {
           $username = $params->getPost()['username'];
           $password = $params->getPost()['password'];
           
           $user = new Users();
           $db = new Database(); 
           $dbUser = $db->find($user, "WHERE username=? AND password=?", array($username, Secure::encryptPassword($password)));
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
    } else if ($params->getPost()['username']!=null && $params->getPost()['password']!=null) {
            $username = $params->getPost()['username'];
            $password = sha1($params->getPost()['password']);  
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
        $db = new Database();
        $obj = new BlogPost();
        $current = isset($params->getGet()['page']) ? $params->getGet()['page'] : 0;
       
        $items = $db->countObjects($obj);
        $pages = ceil($items/5);
        $blogPosts = $db->findAll($obj);
        $view->renderArgs("page_title","Blog");
        $view->renderArgs("pages",$pages);
        $view->renderArgs("posts", $blogPosts);
        $view->render("Frontend/blog");
    }
    
    public function page404() {
        echo "PAGINA 404";
    }
}
