<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace PlayPhp\Classes;

/**
 * The view object has all methods used for creating views and passing data.
 * @version 0.1
 * @author yuri.blanc
 */
class View {
    private $template = TEMPLATE;
    private $message = array();
    /**
     *
     * @var array
     */
    private $var = array();
    private $view;
    
    /**
     * Add data to the View object specifing a name and a value,
     * set variables will be accessible with their $name in the rendered view.
     * @param type $name Description
     */
    public function renderArgs($name, $value){
        $this->var[$name] = $value;
    }
    /**
     * Render the view. Using relative paths you can specify subfolders of view root. (e.g. blog/post = view/blog/post.php)
     * Automatically set .php extension to the view name.
     * @param string $view
     */
    public function render($view) {
        $this->page_content = $this->view = APP_ROOT."/view/$view.php";
        $this->renderArgs("template", $this->template);
        $this->renderArgs("page_content", $this->page_content);
        extract($this->var);
        include APP_ROOT."template/$this->template/index.php";
    }
    
    public function renderJson($data,$options=null) {
         echo json_encode($data,$options);
    }
    /**
     * @deprecated since version 0.1
     * @param string $type
     * @param string $text
     */
    public function message($type,$text) {
        $this->message[$type] = $text;
        $this->renderArgs("message", $this->message);
    }

}
