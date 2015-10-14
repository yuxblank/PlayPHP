<?php
require_once 'class/Sessions.php';
require_once 'class/View.php';
require_once 'class/Database.php';


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
 * Description of PlayController
 *
 * @author yuri.blanc
 */
class PlayController {

    
    public function __construct() {
        
    }
    
    
    public function sessionStart () {
        $session = new Sessions();
        $session->init();
    }

    /**
     * @param string $name
     * @param string $value
     * @param int $expire in seconds
     */
    public static function keep($name,$value,$expire=null) {
        if (!isset($expire)) {
            $expire = time()+1; //default
        } else {
            $expire = time() + $expire;
        }
        setcookie($name, $value, $expire);
    
    }



    
    
}
