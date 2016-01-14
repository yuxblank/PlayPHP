<?php
require '../classes/Database.php';
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
 * Description of PlayModel
 *
 * @author yuri.blanc
 */
class PlayModel extends Database {
    private $db;
    
    /**
     * 
     * @param object $object
     * @param array  $conditions
     * @param array  $values
     * @return object 
     */
    public function find($object, $coditions, $values) {
        return $this->find($object, $conditions, $values);
    }
    public function findById($object_id) {
        
    }
    /**
     * 
     * @param object $object
     * @param array  $conditions
     * @param array  $values
     * @return list
     */
    public function findAll ($object,$conditions,$values) {
        return $this->db->find($object, $conditions, $values);
    }
        /**
     * 
     * @param object $object
     * @param array  $conditions
     * @param array  $values
     * @param int    $current
     * @param int    $min
     * @param int    $max
     * @return list 
     */
    public function findPaginated ($object,$conditions,$values,$current,$min,$max) {
        return $this->db->findAll($object, $conditions, $values, $current, $min, $max);
    }
    public function save ($object) {
        $this->db->save($object);
    }
    public function update ($object) {
        $this->db->save($object);
    }
    public function delete ($object) {
        $this->db->delete($object);
    }
    
}
