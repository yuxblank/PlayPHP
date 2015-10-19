<?php
include './config/app.php';
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
 * Description of router
 *
 * @author yuri.blanc
 */
require 'http/Request.php';

class Router {
    protected static $routes;
    
    private function __construct() {
        Router::$routes = json_decode(file_get_contents(APP_ROOT.'config/routes.json'));
    }

    public static function getInstance(){
        if (Router::$routes==null) {
           new Router();
        }
        return Router::$routes;
    }

    public static function go($action,$params=null) {
//        $actions = explode("@", $action);
//        $c = strtolower($actions[0]);
//        $a     = strtolower($actions[1]);
        
        $route = Router::findUrl($action);
       
        // set query sting to null

        if ($route) {
            if(isset($params)) {
                $queryString = null;
                    foreach ($params as $key => $value) {
                        $queryString = str_replace("?",$value,$route->url);
                    }
                return APP_URL."$queryString";
            } 
            
        return  APP_URL."$route->url";
        } else {
            return  APP_URL."404";
        }
    }
    
    public static function switchAction($action,$params=null) {
        $r = Router::go($action,$params);
        header("location:$r", true, 302);
    }
    
    public static function redirect($url){
        $action = Router::findAction($url);
        self::switchAction($action);
    }
    
    public static function findUrl($action) {
         foreach (Router::getInstance()->routes as $route) {
             if ($route->action == $action) {
                 return $route;
             }
         }
    }
    public static function findAction($query) {
        //d($query);
        $queryArray = explode("/", $query);
        //d($queryArray);
           foreach (Router::getInstance()->routes as $route) {
             if ($route->url == $query) {
                 // replace current routes url with incoming url
                 $route->url = $query;
                 return $route;
             } else {
                 $queryReplace = null;
                 foreach ($queryArray as $key => $value) {
                     if (strpos($route->url,"?")) {
                         $queryReplace = str_replace("?", $value, $route->url);
                         if($queryReplace == $query) {
                             $route->url = $query;
                             return $route;
                         }
                     }
                 }

             }


            /*     $routeUrl = explode("/",$route->url);
                if (array_search ("?",$routeUrl)) {
                    $index[] = array_search ("?",$routeUrl);
                    for ($i=0;$i<count($queryArray);$i++) {
                        $routeUrl[$i] = $queryArray[$i]; // ? --> data
                    }
                     $route->url = implode("/", $routeUrl);
                    return $route;
                }*/



             }


    }

     public static function checkRoutes($action,$method){
         foreach (Router::getInstance()->routes as $valid) {
          /*   echo $valid->action . ' == ' . $action . '|||';
             echo $valid->method . ' == ' . $method . '|||';*/
             if ($valid->method == $method && $valid->action == $action) {
                 return $valid;
             }
         }
     }
     
    public static function inverseRoute($action) {
        return explode("@", $action->action);
    }
    public static function notFound($action,$method) {

        if (APP_DEBUG) {
        die ("Route not found:: $action with method ". $method . "<br>");
//        d(Router::$routes);
        }
        

    }
  
        
        

}
