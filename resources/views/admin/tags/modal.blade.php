  <!--  skill -->
  <div class="modal fade" id="skill{{ $skill->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit  Skill</h4>
        </div>
        <form action="{{ route('tags.update',$skill->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label">Skill Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ $skill->name }}">
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



