<?php
require '../classes/Database.php';
require '../classes/Security.php';
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
 * Description of AdminSecure
 *
 * @author yuri.blanc
 */
class AdminSecure {
    //put your code here
    
        public function checkAccess() {
        
    }
    
        public function authenticate($params) {
        if(isset($params['username']) && isset($params['password'])) {
            $username = htmlspecialchars($params['username']);
            $password = htmlspecialchars($params['password']);
            $db = new Database ();
            $user = new User();
            $user = $db->find($user, array("username","password"), array($username,$password));
            if (isset($user)) {
                //TODO session token
                $session = new SessionHandler ();
            }
            
        }
        
    }
    
}
