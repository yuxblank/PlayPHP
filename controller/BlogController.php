<?php
//require './class/Template.php';
//require './model/BlogPost.php';
/*require './PlayPHP/class/Controller.php';*/
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
class BlogController extends Controller {
    private $template;
    
    public function saveBlogPost($params) {
        
        if(Controller::getSession("user") == "admin") {


            $blogPost = new BlogPost(null, $params->getPost()['title'], $params->getPost()['text']);
            $db = new Database();
            $db->save($blogPost);


        } else {
            Controller::keep("error", "NOT LOGGED IN");
        }
        Router::switchAction("Frontend@blog");
        
    }
    
    public function showPost($params) {

        $blogPost = new BlogPost ();
        $db = new Database();
        $this->template = new \PlayPhp\Classes\View();
        $post = $db->findById($blogPost,$params->getGet()['id']);
        $this->template->renderArgs("post", $post );
        $this->template->renderArgs("page_title", "Blog post: $post->title");
        $this->template->render("Frontend/post");
        
        
    }
    
    
    
}
