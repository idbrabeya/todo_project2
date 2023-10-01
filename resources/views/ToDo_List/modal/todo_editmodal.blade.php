 {{-- edit modal show --}}
 <div class="modal fade" id="todomodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <form action="{{ route('todo_update') }}" method="post">
       
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="todomodal">Edit Todo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <input type="hidden" id="ids" name="id">
            <div class="mb-3">
              <label for="" class="form-label">Title</label>
              <input type="text" class="form-control"  name="name" id="name" value="">
            </div>
            <span class="text-danger" id="name_error"></span>
          
            <div class="mb-3">
              <label for="" class="form-label">Description</label>
              <input type="text" class="form-control" name="description" id="description" value="">
            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary"  onclick="todo_update()">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        </div>
      </div>

    </div>
</form>
</div>
   {{-- edit modal end --}}
