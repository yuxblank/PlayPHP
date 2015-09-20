<!-- Button trigger modal -->
<div class="pull-left">
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newItem">New
</button>
<button type="sumibt" class="play-crud-delete btn btn-danger">Delete</button>
</div>
<table class="table table-hover">
    <tr> 
        <th>#</th>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
    </tr>
    <?php
    if (isset($products)) {
    $action = relativeRouter("ProductsController", "deleteProducts");
    $edit = relativeRouter("ProductsController", "editProduct");
    $html="<form id='multiselect' action='$action' method='POST'>\n";
    foreach ($products as $product) {
        $html.= "<tr>\n"
                ."<td><input type='checkbox' name='ids[]' value='".$product->id."'></td>\n"
                ."<td>".$product->id."</td>\n"
                ."<td><a href='".  relativeRouter("ProductsController", "editProducts", array("id" =>$product->id))."'>".$product->title."</td>\n"
                ."<td>".$product->description."</td>\n"
                ."<td>".$product->image."</td>\n"
                ."</tr>\n";
    }
    $html.="</form>\n";
    echo $html;
    } 
    ?>
</table>
 




<!-- Modal -->

</div><div class="modal fade" id="newItem" tabindex="-1" role="dialog" aria-labelledby="New Product">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New product</h4>
      </div>
      <div class="modal-body">
          <form method="POST" action="<?php echo router("ProductsController", "saveProduct")?>">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" placeholder="Title..." name="title" required>
    <label for="desc">Title</label>
    <textarea class="form-control" id="desc" name="desc" placeholder="Description..." name="description" required></textarea>
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
    
    <script>
           function send() {
               $('#multiselect').submit();
               $('.play-confirm-modal').modal('hide');
           }
           
    $('.play-crud-delete').on('click',function(){
        
        var checked = $( "input:checkbox:checked" ).length;
        if(checked>0) {
           $('.play-confirm-modal').modal('show');
           console.log(checked);
        } else {
            alert("No selected checkboxes");
        }
    });
    
    
    
    
    </script>
    
<div class="confirm-modal modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

    </div>
  </div>
</div>
  

<div class="play-confirm-modal modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
            <p>Confirm deletion?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="send();">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  
