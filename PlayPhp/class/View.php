<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace PlayPhp\Classes;

/**
 * Description of Template
 *
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
     * 
     * @param array $args
     */
    public function renderArgs($name, $value){
        $this->var[$name] = $value;
    }
    
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
     * 
     * @param string $type
     * @param string $text
     */
    public function message($type,$text) {
        $this->message[$type] = $text;
        $this->renderArgs("message", $this->message);
    }

}
