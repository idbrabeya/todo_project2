
 <div class="modal fade" id="employeemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <form action="" method="post" id="employee">
       @csrf
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="todomodal">Create Employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <input type="hidden" id="idem" name="id">
            <div class="mb-3">
              <label for="" class="form-label">Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control"  name="em_name" id="em_name" value="">
            </div>
            <span class="text-danger" id="vali_name"></span>
          
            <div class="mb-3">
              <label for="" class="form-label">Email <span class="text-danger">*</span></label>
              <input type="email" class="form-control" name="em_email" id="em_email" value="">
              <span class="text-danger" id="vali_email"></span>
            </div>
            
            <div class=" mb-3">
              <label for="password" class="form-label ">{{ __('Password') }} <span class="text-danger">*</span></label>
              <input type="password" class="form-control" name="em_password" id="em_password">
              <span class="text-danger" id="vali_pass"></span>

          </div>

            <div class="mb-3">
                <label for="" class="form-label">Designation</label>
                 <select name="em_designation" id="em_designation" class="form-control form-select" >
                  <option value="">Select Please</option>
                  <option value="Software Engineer">Software Engineer</option>
                  <option value="Sr. Software Engineer">Sr. Software Engineer</option>
                  <option value="Executive Officer">Chief Executive Officer</option>
                  <option value="Technology Officer">Chief Technology Officer</option>
                  <option value="Project Manager">Project Manager</option>
                  <option value="Sr. Backend Developer">Sr. Backend Developer</option>
                  <option value="Backend Developer">Backend Developer</option>
                  <option value="Sr. Frontend Developer">Sr. Frontend Developer</option>
                  <option value="Frontend Developer">Frontend Developer</option>
                  <option value="Intern">Intern</option>
                </select>              
                </div>
              <div class="mb-3">
                <label for="" class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" id="em_phone" value="">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Status</label>
                 <select name="status" id="em_status" class="form-control form-select" >
                  <option value="">Select Please</option>
                  <option value="1">Active</option>
                  <option value="2">Deactive</option>
                </select>              
                </div>
              
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="emSave">Add</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        </div>
      </div>

    </div>
</form>
</div>

