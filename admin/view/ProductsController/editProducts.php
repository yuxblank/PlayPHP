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

 <form method="POST" action="<?php echo router("ProductsController", "saveProduct")?>">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" placeholder="Title..." name="title" value='<?php echo $product->title ?>' required>
    <label for="desc">Title</label>
    <textarea class="form-control" id="desc" name="desc" placeholder="Description..."  name="description" required><?php echo $product->description ?></textarea>
    <label for="image">Image</label>
    <input type="file" class="form-control" id="image"  name="image" value='<?php echo $product->image ?>' >
  </div>
      <div class="col-xs-offset-9">
        <button type="button" class="btn btn-warning" onclick='parent.history.back();'>back</button>
        <button type="submit" class="btn btn-success">Save changes</button>
        </div>
</form>  