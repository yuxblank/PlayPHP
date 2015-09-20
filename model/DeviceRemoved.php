<?php
require_once '../class/Database.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DeviceRemoved
 *
 * @author yuri.blanc
 */
class DeviceRemoved {
    private $db;
    private $id;
    private $device_id;
    private $date;
    
    
    function __construct($id, $machineId, $date) {
        $this->db = new Database();
        $this->id = $id;
        $this->machine_id = $machineId;
        $this->date = $date;
    }
    
    public function find($id=null, $machine_id=null) {
        if(isset($id)) {
        $statement = "SELECT * FROM device_removed WHERE id=:id";
        $this->db->query($statement);
        $this->db->bindValue(":id", $id);
        } else if (isset ($machineId)) {
        $statement = "SELECT * FROM device_removed WHERE machine_id=:machine_id"; 
        $this->db->query($statement);
        $this->db->bindValue(":machine_id", $machine_id);
        }
        return $this->db->fetchObject(get_class($this));
    }
    public function findAll($machine_id=null) {
        $statement = "SELECT * FROM device_removed WHERE machine_id=:machine_id"; 
        $this->db->query($statement);
        $this->db->bindValue(":machine_id", $machine_id);
        return $this->db->fetchObjectSet(get_class($this));
    }
    /**
     * 
     * @param DeviceRemoved $object
     */
    public function save ($object) {
        $statement = "INSERT into device_removed VALUES(:machine_id, :date)";
        $this->db->query($statement);
//        $this->db->bindValue("machine_id", $object->machine_id);
//        $this->db->bindValue(":date", new DateTime("now"));
//        $object->date = new DateTime ('now');
        $this->db->save($object);
    }

}
