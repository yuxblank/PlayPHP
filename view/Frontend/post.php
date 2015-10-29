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
    <div class="comment-block panel panel-heading">
          <h3 class='text-primary'>Comments</h3>
        <?php    foreach ($comments as $comment) { ?>   
        <div class="comment well well-sm">
            <h4><?php echo $comment->title ?></h4>
            <blockquote><p><i><?php echo $comment->text ?></i></p></blockquote>
            <p>rating: <?php echo $comment->vote ?>/5   </p>
        </div>
        <?php } ?>
          <?php $attr = Controller::getSession("user") ? "" : "disabled";
          ?>
          <form>
              <div class="form-group">
                  <label for="user">User:</label>
                  <input type="text" class="form-control" id="user" value="<?php echo Controller::getSession("user"); ?>" disabled>
                  <label for="title">Title:</label>
                  <input type="text" class="form-control" id="title" name='title'  <?php echo $attr?>>
                  <label for="vote">Vote:</label>
                  <select id='vote' name='vote'  <?php echo $attr?>>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                  </select>
                  <input type='hidden' name='blogpost_id' value="<?php echo $post->id ?>">
                  <textarea class="form-control" id='text' name='text'  <?php echo $attr?>></textarea>
              </div>
              <button type="button" id="commentsend" class="btn btn-default"  <?php echo $attr?>>Submit</button>
          </form>
    </div>

<script>
 $('#commentsend').on('click', function(){
    
var request = $.ajax({
  url: "<?php echo Router::go("Frontend@addComment") ?>",
  type: "POST",
  data: $('form').serialize()
 // dataType: "html"
});

request.done(function(msg) {
  if (msg==='OK') {
      window.location.reload();

  } else {
      $('.yx-notify-ajax').show().text('invalid submission')
      $('input').val('');
      $('.yx-notify-ajax').delay(2000).fadeOut(500);
 }  
});

request.fail(function(jqXHR, textStatus) {
  alert( "Request failed: " + textStatus );
});
    
});
    
    
</script>

    
    
    




