<?php
//require './class/Template.php';
require_once './model/BlogPost.php';
/*require './PlayPHP/class/Controller.php';*/
require_once './model/Comments.php';
require_once './model/Tags.php';
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
        // create blogpost object
        $post = new BlogPost();
        // create view
        $this->template = new \PlayPhp\Classes\View();
        //find post
        $post = $post->findById($params->getGet()['id']);
        $this->template->renderArgs("post", $post);
        $this->template->renderArgs("page_title", "Blog post: $post->title");
        // get post tags using oneToMany
       
        $tags = $post->tags();
        
        $this->template->renderArgs("tags", $tags);
        // get post comments
        $comment = new Comments ();
        $comments = $comment->findAll("WHERE blogpost_id=?", array($post->id));
        $this->template->renderArgs("comments", $comments);
        // render view
        $this->template->render("Frontend/post");
    }
    
    public function filterTag($params) {
        $tags = new Tags();
        $tag =  urldecode($params->getGet()['tag']);
        $tags = $tags->find("WHERE tag LIKE ? ",array($tag));
     
      
//      
//        $tags->posts();
        if ($tags) {
        $posts = $tags->posts();  
        } 
        
        $view = new \PlayPhp\Classes\View();
        $view->renderArgs("posts", $posts);
        $view->render("Frontend/filterTag");
        
    }
    
    
    
}
