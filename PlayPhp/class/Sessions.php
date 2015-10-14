<?php
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
 * Description of Security
 *
 * @author yuri.blanc
 */
class Sessions {
    private $lifetime;// = SESSION_LIFETIME;
    
    public function init() {
        $data = "test";
            if(session_start()) {
             
                $_SESSION['TOKEN'] = $this->createToken($data);
                echo "session id: ".session_id()."</br>";
                echo "session token: ".$_SESSION['TOKEN'];
            } else {
                //error
            }
            return $_SESSION['TOKEN'];
        
    }
    
    public function checkValidity($token) {
        if ($_SESSION['TOKEN']== $token) {
            return true;
        } 
        return false;
    }
    
    public function stop(){
        session_destroy();
    }
    
    
    private function createToken() {
        $size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB);
        $iv = mcrypt_create_iv($size, MCRYPT_DEV_RANDOM);
        return  bin2hex($iv);
    }
    
    

        

   
}
