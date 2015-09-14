<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Template
 *
 * @author yuri.blanc
 */
class Template {
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
    
    public function render($controller, $view) {
        $ctrl = strtolower($controller);
        $this->page_content = $this->view = APP_ROOT."/view/$ctrl/$view.php";
        $this->renderArgs("template", $this->template);
        $this->renderArgs("page_content", $this->page_content);
        if (!empty($_SESSION['flash'])) {
            $this->renderArgs("flash", $_SESSION['flash']);
        }
        extract($this->var);
        include APP_ROOT."template/$this->template/index.php";
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
