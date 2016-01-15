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



class Request {

    private $post=array();
    private $get=array();
    private $put=array();
    private $delete=array();

    /**
     * @return array
     */
    public function getPost($name=null)
    {
        if (isset($name)) {
            return $this->post[$name];
        }
        return $this->post;
    }

    /**
     * @param array $post
     */
    public function setPost($name,$value)
    {
        $this->post[$name] = $value;
    }

    /**
     * @return array
     */
    public function getGet($name=null)
    {
        if (isset($name)) {
            return $this->get[$name];
        }
        return $this->get;
    }

    /**
     * @param array $get
     */
    public function setGet($name,$value)
    {
        $this->get[$name] = $value;
    }
    
    public function _setGet($params) 
    {
        foreach ($params as $key => $value) {
            $this->get[$key] = $value;
        }
    }
    
     public function setPut($params)
      {
        foreach ($params as $key => $value) {
            $this->put[$key] = $value;
        }
    }
    
    public function getPut($name=null)
     {
        if (isset($name)) {
            return $this->put[$name];
        }
        return $this->put;
    }
    
    public function setDelete($params) 
    {
        foreach ($params as $key => $value) {
            $this->delete[$key] = $value;
        }
    }
    
    public function getDelete($name=null) 
    {
        if (isset($name)) {
            return $this->delete[$name];
        }
        return $this->delete;
    }















}