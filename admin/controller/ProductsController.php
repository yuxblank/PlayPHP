<?php
//require '../libraries/Ajax.php';
require_once'../class/PlayController.php';
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
 * Description of Products
 *
 * @author yuri.blanc
 */
class ProductsController extends PlayController {
    private $template;
    
    public function saveProduct($params) {
         $product = new Products(null,$params['title'],$params['desc'],null);;
         $db = new Database ();
         $db->save($product) ;
         $this->keep("error", "ciao");
         switchAction("Admin", "products");

    }
    
    public function deleteProducts($params) {
        $products = new Products ();
        $db = new Database ();
        $ids = array_values($params['ids']);
        for ($i=0; $i<count($ids);$i++) {
            $db->delete($products, $ids[$i]);
        }
        switchAction("Admin", "products");
    }
    public function editProducts($params) {
        $products = new Products();
        $db = new Database ();
        $id = $params['id'];
        $products = $db->findById($products, $id); // auto Bind object fetched=no and POST params?
        $this->template = new View();
        $this->template->renderArgs("product", $products);
        $this->template->renderArgs("page_title", "Edit product " . $products->title);
        $this->template->render(get_class($this), "editProducts");
        
    }

}
