<?php
require './class/PlayController.php';
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
class Frontend extends PlayController {
    private $template;
    
    public function index() {
        $this->template = new Template();
        $bottom = array(
            'bottom' => array(
                'bottom_title' => 'titolo1',
                'bottom_text' => 'testo1'
        )
        );
        $this->template->renderArgs("bottom", $bottom);
        $this->template->renderArgs("page_title","Welcome");
        $this->template->render(get_class($this), "index", "Welcome");

    }
    public function login() {
        
    }
    public function register() {
        $this->template = new Template();
        $this->template->renderArgs("page_title","Register");
        $this->template->render(get_class($this), "register", "Registra");
    }
    
    public function blog($params) {
        $this->template = new Template();
        $db = new Database();
        $obj = new BlogPost();
        $current = isset($params->getGet()['page']) ? $params->getGet()['page'] : 0;
       
        $items = $db->countObjects($obj);
        $pages = ceil($items/5);
        $blogPosts = $db->findAll($obj);
        $this->template->renderArgs("page_title","Blog");
        $this->template->renderArgs("pages",$pages);
        $this->template->renderArgs("posts", $blogPosts);
        $this->template->render(get_class($this), "blog");
    }
}
