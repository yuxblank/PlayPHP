<?php
require '../class/Database.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Customer
 *
 * @author yuri.blanc
 */
class Customer {
   private $db;
   private $user_id;
   private $username;
   private $password;
   private $name;
   private $lastname;
   private $email;
   
   function __construct($user_id, $username, $name, $lastname, $email) {
       $this->user_id = $user_id;
       $this->username = $username;
       $this->name = $name;
       $this->lastname = $lastname;
       $this->email = $email;
       $this->db = new Database();
   }
   
   public function getCustomer($email=null) {
       $statement = "SELECT * FROM users WHERE email =:email";
       $this->db->query($statement);
       $this->db->bindValue(":email", $email);
       return $this->db->fetchSingleObject(get_class($this));
   }

}
