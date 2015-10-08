<?php

include 'config/app.php';
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
require 'Class/http/Request.php';
class Router {
    protected static $routes;

    private function __construct() {
        Router::$routes = json_decode(file_get_contents(APP_ROOT.'config/routes.json'));
    }

    public static function getInstance(){
        if (Router::$routes==null) {
           Router::$routes = new Router();
        }
    }

    public static function go($action,$params=null) {
        $actions = explode("@", $action);
        $controller = strtolower($actions[0]);
        $action     = strtolower($actions[1]);
        // set query sting to null
        $queryString = null;
        $get = null;
        if(isset($params)) {
            // deprecated
            //$queryString = is_array($params) ? http_build_query($params) : "$params";

            foreach ($params as $name => $value) {
                $queryString .= '/'.$name.'//'.$value;
            }

            return APP_URL."$controller/$action$queryString";
        } 
        return APP_URL."$controller/$action";
    }
    

        
        
        

}
