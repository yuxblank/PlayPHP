<?php
include_once '/controller/Admin.php';
require '../libraries/Router.php';
$params=array();
    if(isset($_GET['controller'])&&isset($_GET['action'])){
        $c = $_GET['controller'];   
        $a = $_GET['action'];    
        // add all query string additional params to method signature i.e. &id=x&category=y
        $queryParams = array_keys($_GET);
        $queryValues = array_values($_GET);
            for ($i=2;$i<count($queryParams);$i++) {
                $params[$queryParams[$i]] = $queryValues[$i];   
            }
        
    if ($_POST) {
    // add all query string additional params to method signature i.e. &id=x&category=y
    $queryParams = array_keys($_POST);
    $queryValues = array_values($_POST);
            for ($i=0;$i<count($_POST);$i++) {
                $params[$queryParams[$i]] = $queryValues[$i];   
            }
            }
    include_once APP_ROOT."/controller/$c.php";
    $controller = new $c();//CombustibiliController
    $controller->$a($params);//inserimento
    
    }  else {   
    //attiva controller predefinito    
    $controller = new Admin();
    $controller->index();
    }