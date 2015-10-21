<?php
include './config/database.php';

//use Exception;

//use PDO;
//require "../database.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author yuri.blanc
 */
class Database {
//    protected static $_instance = NULL;
    private $pdo;
    private $stm;
    private $dbDriver = DB_DRIVER;
    private $dbHost = DB_HOST;
    private $dbName = DB_NAME;
    private $dbUser = DB_USER;
    private $dbPwd = DB_PSW;
    private $options = DB_OPTIONS;
    private $ex;

    public function __construct() {
        $dsn = $this->dbDriver.':host=' .$this->dbHost . ";dbname=".$this->dbName;
        try {
        $this->pdo = new PDO($dsn, $this->dbUser, $this->dbPwd);
        } catch (PDOException $ex) {
            $this->ex = $ex->getMessage();
            if(APP_DEBUG) {
                d($ex->getTrace());
            }
        }
    }
    /**
     * @param SQL_QUERY $statament SQL query with : placeholders
     * @param Array $params names of placeholders
     * @param Array $params placeholders values
     */
    private function query($statement) {
       $stm = $this->pdo->prepare($statement);
       $this->stm = $stm;
    }
    /**
     *
     * @param mixed $param
     * @param mixed $value
     */
    private function bindValue ($param, $value) {
        $this->stm->bindParam($param,$value);
    }
    
    public function nativeQuery($query,$params) {
       $this->query($query);
       $this->paramsBinder($params);
       $this->execute();
       return $this->stm->fetch(PDO::FETCH_ASSOC);
    }
    
    public function findMagic($query, $params) {
        $this->query($query);
        $this->paramsBinder($params);
        $this->execute();
        return $this->stm->fetch(PDO::FETCH_OBJ);
    }
    public function findMagicSet($query, $params) {
        $this->query($query);
        $this->paramsBinder($params);
        $this->execute();
        return $this->stm->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     *
     * @param object $object
     * @param string $query
     * @param array $params array with all params data non assoc.
     * @return object of objects
     */
    public function find($object,$query,$params) {
        try {
        $table = $this->objectInjector($object);
        } catch (Exception $e) {
            if (APP_DEBUG) {
                print_r($e->getTrace());
            }
            return;
        }
        $statement = "SELECT * FROM $table ".$query;
        $this->stm = $this->pdo->prepare($statement);
        foreach ($params as $key => $value) {
            $key++; // + 1 for bindParams
            $this->bindValue($key, $value);
        }
        return $this->fetchSingleObject($object);
    }
    /**
    *
    * @param object $object
    * @param int    $id
    * find an object by a given id
    **/
     public function findById($object,$id) {
        try {
        $table = $this->objectInjector($object);
        } catch (Exception $e) {
            if (APP_DEBUG) {
                d($e->getTrace());
            }
            return;
        }
        $statement = "SELECT * FROM $table WHERE id=:id";
        $this->stm = $this->pdo->prepare($statement);
        $this->bindValue(":id",$id);
        return $this->fetchSingleObject($object);
    }
    /**
     *
     * @param object $object
     * @param string $query
     * @param array $values
     * @param int $current
     * @param int $min
     * @param int $max
     * @return list 
     */
    public function findAll($object,$query=null,$values=null,$current=null,$max=null,$order=null) {
        try {
        $table = $this->objectInjector($object);
        } catch (Exception $e) {
            if (APP_DEBUG) {
                d($e->getTrace());
            }
            return;
        }
        $statement = "SELECT * FROM $table ".$query;
        if (isset($current) && isset($max)) {
            if(isset($order)) {
                $statement.=" ".$order;
            }
            $statement.= " LIMIT ?, ? ";
        }
        $this->stm = $this->pdo->prepare($statement);
        $lastValue = 0;
        if (isset($query) && isset($values)){
            foreach ($values as $key => $value) {
                $key++; // + 1 for bindParams
                $this->bindValue($key, $value);
                $lastValue++;
            }
        }
        if (isset($current) && isset($max)) {
            $this->stm->bindParam(++$lastValue, $current, PDO::PARAM_INT);
            $this->stm->bindParam(++$lastValue, $max, PDO::PARAM_INT);

        }
        return $this->fetchObjectSet($object);
    }
    
    public function countObjects($object) {
        $table = $this->objectInjector($object);
        $query = "SELECT COUNT(*) FROM $table";
        $this->query($query);
        return $this->rowCount();
    }
    
  
    /**
     *
     * @param object $object
     */
    private function execute($object=null) {
        if(isset($object)){
        $this->stm->execute((array)$object);
        } else {
            $this->stm->execute();
        }

    }
    private function rowCount() {
        $this->execute();
        return $this->stm->fetchColumn();
    }
     private function resultSet() {
        $this->execute();
        return $this->stm->fetchAll(PDO::FETCH_ASSOC);
    }
     private function resultSingle() {
        $this->execute();
        return $this->stm->fetch(PDO::FETCH_ASSOC);
    }
     private function fetchSingleObject($object) {
        $this->stm->setFetchMode(PDO::FETCH_INTO, new $object());
        $this->execute();
        return $this->stm->fetch();
    }
    private function fetchObjectSet($object) {
        $this->execute();
        return $this->stm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_class($object));
    }
    /**
     *
     * @param object $object
     */
    public function save($object) {
        $table = $this->objectInjector($object);
        $statement = "INSERT INTO $table VALUES (";
        $values="";
        foreach ($object as $key => $value) {
            $values.= ":".$key.",";
        }
        $values = substr($values, 0, -1);
        $values.=")";
        $statement.=$values;
        echo ($statement);   // debug
        $this->stm = $this->pdo->prepare($statement);
        $this->execute($object);
    }
    /**
     *
     * @param object $object
     * @param int $id
     */
    public function update($object,$id) {
        $table = $this->objectInjector($object);
        $statement = "UPDATE $table SET (";
        $values="";
        foreach ($object as $key => $value) {
            $values.= $key."=:".$key.",";
        }
        $values = substr($values, 0, -1);
        $values.=") WHERE id=:id";
        $statement.=$values;
        echo ($statement);   // debug
        $this->stm = $this->pdo->prepare($statement);
        $this->bindValue($id, $values);
        $this->execute($object);
    }
    /**
     *
     * @param object $object
     * @param int $id
     */
    public function delete($object,$id) {
        $table = $this->objectInjector($object);
        $statement = "DELETE FROM $table WHERE id=:id";
        $this->stm = $this->pdo->prepare($statement);
        $this->bindValue(":id",$id);
        $this->stm->execute();
    }
    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }
    /**
     * @final
     * Override DB config for current object state
     * @param type $dbDriver
     * @param type $dbHost
     * @param type $dbName
     * @param type $dbUser
     * @param type $dbPassword
     * @param type $options
     */
    final public function changeDb($dbDriver, $dbHost, $dbName, $dbUser, $dbPassword, $options=null ) {
        $this->pdo = null;
        $this->dbDriver = $dbDriver;
        $this->dbHost = $dbHost;
        $this->dbName = $dbName;
        $this->dbPwd = $dbPassword;
        $this->dbUser = $dbUser;
        $this->options = $options;
        // make a new conn
        $dsn = $this->dbDriver.':host=' .$this->dbHost . ";dbname=".$this->dbName;
        try {
        $this->pdo = new PDO($dsn, $this->dbUser, $this->dbPwd, $this->options);
        } catch (PDOException $ex) {
            $this->ex = $ex->getMessage();
        }

    }

    final public function revertDb() {
        $this->pdo = null;
        $this->dbDriver = DB_DRIVER;
        $this->dbHost = DB_HOST;
        $this->dbName = DB_NAME;
        $this->dbUser = DB_USER;
        $this->dbPwd = DB_PSW;
        $this->options = DB_OPTIONS;
        // make a new conn
        $dsn = $this->dbDriver . ':host=' . $this->dbHost . ";dbname=" . $this->dbName;
        try {
            $this->pdo = new PDO($dsn, $this->dbUser, $this->dbPwd, $this->options);
        } catch (PDOException $ex) {
            $this->ex = $ex->getMessage();
        }
    }

    private function objectInjector($object) {
        if (!is_object($object)) {
            throw new Exception ('PlayPHP exception: the argument passed is not an object');
        } else {
            return strtolower(get_class($object));
        }
    }
    
    private function paramsBinder($params) {
        foreach ($params as $key => $value) {
            $key++; // + 1 for bindParams
            $this->bindValue($key, $value);
        }
    }

}


