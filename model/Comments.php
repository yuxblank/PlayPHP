<?php
require_once './PlayPhp/classes/Model.php';
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
 * Description of Comments
 *
 * @author yuri.blanc
 */


class Comments extends Model {
    //put your code here
    public $id;
    public $blogpost_id;
    public $title;
    public $text;
    public $vote;
    
    function __construct($id=null, $blogpost_id=null, $title=null, $text=null, $vote=null) {
        parent::__construct(); // !!! make sure to call Model parent construct!!! 
        $this->id = $id;
        $this->blogpost_id = $blogpost_id;
        $this->title = $title;
        $this->text = $text;
        $this->vote = $vote;
    }

    
    public function post() {
        return $this->oneToOne($this,'BlogPost');
    }
    

    
}

