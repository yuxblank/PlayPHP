<div class="container col-xs-offset-10">
<div class="pull-left">
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newItem">New blog post
</button>
</div>
</div>

            <?php
            $html="";
            foreach ($posts as $post) {
                $html.= "<div class='panel panel-default' style='padding:15px;'>"
                        . "<h1>$post->title</h1>"
                        . "<p>$post->text</p>"
                        . "</div>";
                
            }
            echo $html;
            ?>

    <nav>

  <ul class="pagination">
      
      <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a></li>
      
      <?php
      $html ="";
                  for ($i=1;$i<=$pages;$i++) {
                      $get = router("Frontend", "blog", ["page" => $i]);
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


<!-- Modal -->

</div><div class="modal fade" id="newItem" tabindex="-1" role="dialog" aria-labelledby="New Product">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Blog post</h4>
      </div>
      <div class="modal-body">
          <form method="POST" action="<?php echo router("BlogController", "saveBlogPost")?>">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" placeholder="Title..." name="title" required>
    <label for="desc">Title</label>
    <textarea class="form-control" id="text" name="text" placeholder="your_text"  required></textarea>
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
</form>  
    </div>
  </div>
</div>