<?php
require './PlayPhp/class/Model.php';
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
    public $post_id;
    public $title;
    public $text;
    public $vote;
    
    
    public function getComment($id) {
       return $this->find(new Comments(), "WHERE post_id=?", array($id));
    }
}

