<?php
//require 'Database.php';
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
class Model extends Database {
    
    public function __construct() {
        parent::__construct();
    }

        public final function countObjects($object) {
        return parent::countObjects($object);
    }

    public final  function delete($object, $id) {
       parent::delete($object, $id);
    }

    public final function fetchObjectSet($object) {
        return parent::fetchObjectSet($object);
    }

    public final function fetchSingleObject($object) {
        return parent::fetchSingleObject($object);
    }

    public final function find($object, $query, $params) {
        return self::find($object, $query, $params);
    }

    public final function findAll($object, $query = null, $values = null, $current = null, $max = null, $order = null) {
        return parent::findAll($object, $query, $values, $current, $max, $order);
    }

    public final function findById($object, $id) {
        return parent::findById($object, $id);
    }

    public final function findMagic($query, $params) {
        return parent::findMagic($query, $params);
    }

    public final function findMagicSet($query, $params) {
        return parent::findMagicSet($query, $params);
    }

    public final function lastInsertId() {
        return parent::lastInsertId();
    }

    public final function nativeQuery($query, $params) {
        return sparent::nativeQuery($query, $params);
    }

    public final  function resultSet() {
        return parent::resultSet();
    }

    public function resultSingle() {
        return parent::resultSingle();
    }

    public function rowCount() {
        return parent::rowCount();
    }

    public function save($object) {
       parent::save($object);
    }

    public function update($object, $id) {
        parent::update($object, $id);
    }

    
}
