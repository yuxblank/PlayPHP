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
<div class="container col-xs-offset-10">
</div>


            <?php foreach ($posts as $post) { ?>
            <div class='panel panel-default' style='padding:15px;'>
                <h1><?php echo $post->title ?></h1>
                <p><?php echo $post->text ?> </p>
                <p><a href='<?php echo Router::go("BlogController@showPost",array($post->id)) ?>'>Read more...</a></p>
                    <?php foreach ($post->tags() as $tag) { ?>
                <?php 
                 /*
                  * example of onetomany in template
                  */
                ?>
                <a href=' <?php echo APP_URL ?>filterTag/tag/<?php echo $tag->tag ?>' class='btn btn-sm btn-info' ><?php echo $tag->tag ?></a>
                    <?php } ?>
            </div>  
    <?php } ?>

    <nav>

  <ul class="pagination">
      
      <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a></li>
      
      <?php
      $html ="";
                  for ($i=1;$i<=$pages;$i++) {
                      $get = Router::go("Frontend@blog", ["page" => $i]);
                      $html.= "<li><a href='$get'>".$i."</a></li>";
                  }
                  echo $html;
      ?>
          <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>



