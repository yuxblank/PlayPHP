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
 * This class provides routing methods for index.php. Some methods can be used also externally for inverse routing and url
 * retrive echoing the output. 
 * @author yuri.blanc
 * @copyright (c) 2015, Yuri Blanc
 * @since 0.1
 */
require 'http/Request.php';

class Router {
    protected static $routes;
    /**
     * Costructor reads the routes.json file as a stdClass();
     */
    private function __construct() {
        Router::$routes = json_decode(file_get_contents(APP_ROOT.'config/routes.json'));
    }
    /**
     * Return stdClass respresentation of routes.json
     * @return Router
     */
    public static function getInstance(){
        if (Router::$routes==null) {
           new Router();
        }
        return Router::$routes;
    }
    /**
     * The method returns the route URL from a action string params pointing to the controller and action.
     * The $action must be present in routes or it returns 404 (not found).
     * $params if set, must contain an associative array of GET query string. (e.x. ['id' => 'number']). 
     * @static
     * @param string $action
     * @param mixed[] $params
     * @return string
     */
    public static function go($action, $params = null) {
        
        $route = Router::findUrl($action);
        if ($route) {
            // case with N params
            if (isset($params)) {
                $queryString = null;
                // replace each ? with the current params in order
                foreach ($params as $key => $value) {
                    $queryString = str_replace("?", $value, $route->url);
                }
                // return queryString url
                return APP_URL . "$queryString";
            }
            // return url from json
            return APP_URL . "$route->url";
        } else {
            // not found, return /404
            return APP_URL . "404";
        }
    }
    /**
     * Redirect (302) to another action from an action.
     * @static
     * @param string $action
     * @param mixed[] $params
     */
    public static function switchAction($action,$params=null) {
        $r = Router::go($action,$params);
        header("location:$r", true, 302);
    }
    /**
     * Redirect (302) to another action from an url.
     * @static
     * @param string $action
     * @param mixed[] $params
     */
    public static function redirect($url){
        $action = Router::findAction($url);
        self::switchAction($action);
    }
    /**
     * Find the url in routes from an action
     * @static
     * @param string $action
     * @return stdClass
     */
    public static function findUrl($action) {
         foreach (Router::getInstance()->routes as $route) {
             if ($route->action == $action) {
                 return $route;
             }
         }
    }
    /**
     * Read the real URL and check if exist in routes. If the route contains ? wildcards, try to replace them with current values and check for match.
     * if no indentical urls are found, returns 404.
     * @static
     * @param string $query
     * @return stdClass
     */
    public static function findAction($query) {

        $queryArray = explode("/", $query);
     
        foreach (Router::getInstance()->routes as $route) {
            if ($route->url == $query) {
                // replace current routes url with incoming url
                $route->url = $query;
                return $route;
            } else {
                $queryReplace = null;
                foreach ($queryArray as $key => $value) {
                    if (strpos($route->url, "?")) {
                        $queryReplace = str_replace("?", $value, $route->url);
                        if ($queryReplace == $query) {
                            $route->url = $query;
                            return $route;
                        }
                    }
                }
            }
        }
        // never found
//        if (!$queryReplace) {
//            $route->url = "404";
//            return $route;
//        }
        return $route;
    }
    /**
     * Performs a check for a valid action and method in routes. if action and method belongs to a route returns the route.
     * @static
     * @param string $action
     * @param string $method
     * @return stdClass
     */
    public static function checkRoutes($action,$method){
         foreach (Router::getInstance()->routes as $valid) {
          /*   echo $valid->action . ' == ' . $action . '|||';
             echo $valid->method . ' == ' . $method . '|||';*/
             if ($valid->method == $method && $valid->action == $action) {
                 return $valid;
             }
         }
     }
    /**
     * Performs a inverse route returning returning an array with [0 => 'Controller', 1 => 'action']
     * @param string $action
     * @return mixed[]
     */
    public static function inverseRoute($action) {
        return explode("@", $action->action);
    }
    
    /**
     * Performs a 404 not found
     * @static
     * @param string $action
     * @param string $method
     */
    public static function notFound($action, $method) {
        if (APP_DEBUG) {
            die("Route not found:: $action with method " . $method . "<br>");
        }
    }

}
