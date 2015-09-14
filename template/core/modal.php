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
?>
<!-- Modal -->

<div class="<?php echo $class?>" id="<?php echo $id?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $title?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
         <?php include $modal_content?>
      <div class="modal-footer">
          <?php 
          $html ="";
          foreach ($buttons as $button) {
              $html.= "<button type='".$button->type."' class='".$button->class."' data-dismiss='modal'>".$button->label."</button>";
          }
          echo $html;
          ?>
      </div>
    </div>
  </div>