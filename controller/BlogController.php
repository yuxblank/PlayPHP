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
        $blogPost = new BlogPost(null,$params['title'], $params['text']);
        $db = new Database();
        $db->save($blogPost);
        switchAction("Frontend", "blog");
    }
}
