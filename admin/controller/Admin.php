<?php
//require '../classes/Template.php';
//require '../model/Products.php';
//require '../classes/Database.php';
require_once '../classes/PlayController.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author yuri.blanc
 */
class Admin extends PlayController {
    private $template;
    
    
    
    public function index() {  
        $this->template = new View();
        $this->template->renderArgs("page_title", "Administrator Area");
        $this->template->render(get_class($this), "index", "Admin Control Panel");
        $this->sessionStart();
    }
    public function products() {
        $products = new Products();
        $db = new Database();
        $productsArray = $db->findAll($products);
//        $productsArray = $products->findAll($products);
        $template = new View();
        $template->renderArgs("page_title", "Products Manager");
        $template->renderArgs("products", $productsArray);
        $template->render(get_class($this), "products", "Products manager");   
    }
//        public function products() {
//        $products = new Products();
//        $productsArray = $products->findAll($products);
//        $this->template = new Template();
//        $this->template->renderArgs("page_title", "Products Manager");
//        $this->template->renderArgs("products", $productsArray);
//        $this->template->render(get_class($this), "products", "Products manager");   
//    }
}
