  <!-- Sub Category -->
  <div class="modal fade" id="subCat{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add a Subcategory</h4>
        </div>
        <form action="{{ route('categories.store.sub',$category->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label">Name:</label>
                    <input type="text" class="form-control" name="name">
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


   <!-- Edit category -->
   <div class="modal fade" id="editCat{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
        </div>
        <form action="{{ route('categories.update',$category->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label">Name:</label>
                    <input type="text" class="form-control" name="edit_cat_name" value="{{ $category->name }}">
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

  <!-- Edit Sub category -->
  <div class="modal fade" id="editSubCat{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Sub Category (By comma)</h4>
        </div>
        <form action="{{ route('categories.sub.update',$category->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label">Name:</label>
                    <input type="text" class="form-control" name="edit_sub_cat_name" value="{{  $category->sub_cats }}">
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

