<?php
require_once '../class/Database.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Devices
 *
 * @author yuri.blanc
 */
class Devices {
    private $db;
    private $id;
    private $costumer_license;
    private $machine_serial;
    private $response_key;
    private $data;
    
    function __construct( $id, $costumer_license, $machine_serial,$response_key, $data) {
        $this->db = new Database ();
        $this->id = $id;
        $this->costumer_license = $costumer_license;
        $this->machine_serial = $machine_serial;
        $this->response_key = $response_key;
        $this->data = $data;
        
    }
    
     public function find($id=null, $machine_serial=null) {
        if(isset($id)) {
        $statement = "SELECT * FROM devices WHERE id=:id";
        $this->db->query($statement);
        $this->db->bindValue(":id", $id);
        } else if (isset ($machineId)) {
        $statement = "SELECT * FROM devices WHERE machine_serial=:machine_serial"; 
        $this->db->query($statement);
        $this->db->bindValue(":machine_serial", $machine_serial);
        }
        return $this->db->fetchObject(get_class($this));
    }
     public function findAll($machine_serial=null) {
        $statement = "SELECT * FROM devices WHERE machine_serial=:machine_serial"; 
        $this->db->query($statement);
        $this->db->bindValue(":machine_serial", $machine_id);
        return $this->db->fetchObjectSet(get_class($this));
    }
    /**
     * 
     * @param Devices $object
     */
    public function save ($object) {
        $statement = "INSERT into devices VALUES(:registration_id, :machine_serial, :response_key, :data)";
        $this->db->query($statement);
//        $this->db->bindValue("machine_id", $object->machine_id);
//        $this->db->bindValue(":date", new DateTime("now"));
//        $object->date = new DateTime ('now');
        $this->db->save($object);
    }


}
