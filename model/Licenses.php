<?php
require_once '../class/Database.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Licenses
 *
 * @author yuri.blanc
 */
class Licenses {
    /**
     *
     * @renewable boolean
     * @renewqty  int
     * @max_per_user int
     * @timelimited boolean
     * @duration_days int 
     */
    private $db;
    private $id;
    private $product_id;
    private $title;
    private $renewable;
    private $renewqty;
    private $max_per_user;
    private $timelimited;
    private $duration_days;
    
    function __construct($id, $product_id, $title, $renewable, $renewqty, $max_per_user, $timelimited, $duration_days) {
        $this->db = new Database ();
        $this->id = $id;
        $this->product_id = $product_id;
        $this->title = $title;
        $this->renewable = $renewable;
        $this->renewqty = $renewqty;
        $this->max_per_user = $max_per_user;
        $this->timelimited = $timelimited;
        $this->duration_days = $duration_days;
    }
        public function find($id=null, $product_id=null) {
        if (isset($id)) {
            $query = "SELECT * FROM licenses WHERE id=:id";
            $this->db->query($query);
            $this->db->bindValue(":id", $id);
            return $this->db->fetchSingleObject(get_class($this));
        } else if (isset ($product_id)) {
            $query = "SELECT * FROM licenses WHERE product_id=:product_id";
            $this->db->query($query);
            $this->db->bindValue(":user_id", $product_id);
            return $this->db->fetchSingleObject(get_class($this));
        }
    }
    /**
     * 
     * @object Licenses $object
     */
    public function save ($object) {
        $this->db->query("INSERT INTO license VALUES (:product_id, :title, :renewable, :renewqty, :max_per_user, :timelimited, :duration_days)");
//        $this->db->bindValue(":user_id", $object->id);
//        $this->db->bindValue(":email", $object->email);
//        $this->db->bindValue(":order_id", $object->order_id);
//        $this->db->bindValue(":transaction_id", $object->transaction_id);
//        $this->db->bindValue(":date", new DateTime());
//        $object->date = new DateTime ('now');
        $this->db->save($object);
    }
    
    

}
