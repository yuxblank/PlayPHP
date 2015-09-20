<?php   
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Products
 *
 * @author yuri.blanc
 */
class Products {
    public $id;
    public $title;
    public $description;
    public $image;

//    function __construct() {
//        parent::getInstance();
//             
//    }

    function __construct($id=null, $title=null, $desc=null,$image=null) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $desc;
        $this->image = $image;
    }
       
    
//    public function getProducts($id=null) {
//        $db = new Database ();
//        if (isset($id)) {
//            $statement = "SELECT * FROM products WHERE id=:id"; 
//            $db->query($statement);
//            $db->bindValue(":id", $id);
//            return $this->db->fetchSingleObject(get_class($this));
//        } else {
//            $statement = "SELECT * FROM products";
//            $db->query($statement);
//            return $db->fetchObjectSet($this);
//        } 
//    }
//    public function save($product) {
//        $db = new Database ();
//        // the product already exists
//        if(isset($product->id)) {
//            $statement = "UPDATE products SET title=:title, description=:description, image=:image WHERE id=:id";
//            $db->query($statement);
//            $db->save($product);
//        } else {
//            $statement = "INSERT INTO products (id,title,description,image) VALUES(:id,:title,:description,:image)";
//            $db->query($statement);
//            $db->save($product);
//        }
//    }
//    
//    public function remove($ids) {
//        
//    }
}
