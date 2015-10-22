 <div class="panel panel-default">
  <div class="panel-heading"><?php echo $post->title ?></div>
  <div class="panel-body">
    <?php echo $post->text ?>
  </div>
  <div class="panel-footer">
      <?php foreach ($tags as $tag) { ?>
      <button class='btn btn-info btn-sm'><?php echo $tag->tag ?></button>
      <?php } ?>
  </div>
</div>
    <div class="comment panel panel-heading">
          <h3 class='text-primary'>Comments</h3>
        <?php    foreach ($comments as $comment) { ?>   
        <div class="well well-sm">
            <h4><?php echo $comment->title ?></h4>
            <blockquote><p><i><?php echo $comment->text ?></i></p></blockquote>
            <p>rating: <?php echo $comment->vote ?>/5   </p>
        </div>
        <?php } ?>
          
          <form>
              <div class="form-group">
                  <label for="user">User:</label>
                  <input type="text" class="form-control" id="user" value="<?php echo $_COOKIE['user']; ?>" disabled="">
                  <textarea class="form-control"></textarea>
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
          </form>
          
          
    </div>

    
    
    




