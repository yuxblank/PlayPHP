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
<form>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="username" class="form-control" id="username" placeholder="Username..." name="username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password..." name="password">
  </div>

  <button type="button" id='loginsubmit' class="btn btn-default">Submit</button>
</form>

<script>
 $('#loginsubmit').on('click', function(){
    
var request = $.ajax({
  url: "<?php echo Router::go('Frontend@authenticateAjax') ?>",
  type: "POST",
  data: $('form').serialize()
 // dataType: "html"
});

request.done(function(msg) {
  if (msg==='OK') {
      window.location.replace('blog');
  } else {
      $('.yx-notify-ajax').show().text('invalid login')
      $('input').val('');
      $('.yx-notify-ajax').delay(2000).fadeOut(500);
 }  
});

request.fail(function(jqXHR, textStatus) {
  alert( "Request failed: " + textStatus );
});
    
});
</script>