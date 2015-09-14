<?php
require './class/Template.php';
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
class Frontend {
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
	$this->template->renderArgs("page_title", "home");
        $this->template->render(get_class($this), "index", "Welcome");

    }
    public function login() {
        
    }
    public function register() {
        $this->template = new Template();
	$this->template->renderArgs("page_title", "test");
        $this->template->render(get_class($this), "register", "Registra");
    }
}
