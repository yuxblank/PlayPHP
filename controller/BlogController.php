<?php
//require './class/Template.php';
//require './model/BlogPost.php';
//require './class/PlayController.php';
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
class BlogController extends PlayController {
    private $template;
    
    public function saveBlogPost($params) {
        $blogPost = new BlogPost(null,$params->getPost()['title'], $params->getPost()['text']);
        $db = new Database();
        $db->save($blogPost);
        Router::switchAction("Frontend@blog");
        
    }
    
    public function showPost($params) {
        $blogPost = new BlogPost ();
        $db = new Database();
        $this->template = new Template();
        $post = $db->findById($blogPost,$params->getGet()['id']);
        $this->template->renderArgs("post", $post );
        $this->template->renderArgs("page_title", "Blog post: $post->title");
        $this->template->render("Frontend", "post");
        
        
    }
    
    
    
}
