<?php

//use Exception;

//use PDO;
//require "../settings.php";
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
    public function query($statement) {
       $stm = $this->pdo->prepare($statement);
       $this->stm = $stm;
    }
    /**
     *
     * @param mixed $param
     * @param mixed $value
     */
    public function bindValue ($param, $value) {
        $this->stm->bindValue($param,$value);
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
                d($e->getTrace());
            }
            return;
        }
        $statement = "SELECT * FROM $table ".$query;
        $this->stm = $this->pdo->prepare($statement);
        foreach ($params as $key => $value) {
            $key++; // + 1 for bindParams
            $this->bindValue($key, $value);
            echo "$key and $value";
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
    public function findAll($object,$query=null,$values=null,$current=null,$min=null,$max=null) {
        try {
        $table = $this->objectInjector($object);
        } catch (Exception $e) {
            if (APP_DEBUG) {
                d($e->getTrace());
            }
            return;
        }
        $statement = "SELECT * FROM $table ".$query;
        $this->stm = $this->pdo->prepare($statement);
        if ($query && $values){
            foreach ($query as $key => $value) {
                $key++; // + 1 for bindParams
                $this->bindValue($key, $value);
            }
        }
        return $this->fetchObjectSet($object);
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
    public function resultSet() {
        $this->execute();
        return $this->stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function resultSingle() {
        $this->execute();
        return $this->stm->fetch(PDO::FETCH_ASSOC);
    }
    public function fetchSingleObject($object) {
        $this->stm->setFetchMode(PDO::FETCH_INTO, new $object());
        $this->execute();
        return $this->stm->fetch();
    }
    public function fetchObjectSet($object) {
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
     * Override DB settings for current object state
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
            throw new Exception ('the argument passed is not an object');
        } else {
            return strtolower(get_class($object));
        }

//        try {
//            is_object($object);
//            return strtolower(get_class($object));
//        } catch (Exception $ex) { // might require a custom exception
//            $this->ex = $ex->getMessage();
//            if (APP_DEBUG) {
//                d($ex->getTrace());
//            }
//        }
//        return;
//
//        if (is_object($object)) {
//            return strtolower(get_class($object));
//        }
//        return null;
    }

}


