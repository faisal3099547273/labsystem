<div
class="modal fade text-start"
id="default"
tabindex="-1"
aria-labelledby="myModalLabel1"
aria-hidden="true"
>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel1">Add Disease</h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false">
            <input type="hidden" name="id" id="d-id">
            <div class="row">
        <div class="col-12 mb-1">
            <label for="name">Disease Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
        </div>
        <div class="col-12">
            <label for="name">Select Status
            </label>
            <select name="status" class="form-control" id="status">
                <option value="">Select Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
    </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Create</button>
    </div>
</form>
  </div>
</div>
</div>