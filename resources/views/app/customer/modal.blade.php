<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
      <div class="modal-content">
        <div class="modal-header bg-transparent">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pb-5 px-sm-5 pt-50">
          <div class="text-center mb-2">
            <h1 class="mb-1"></h1>
            {{-- <p>Updating user details will receive a privacy audit.</p> --}}
          </div>
          <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false">
            <input type="hidden" id="userId" value="0" name='id'>
            <div class="col-12 col-md-6">
              <label class="form-label" for="">Name</label>
              <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                placeholder="John"
                value=""
                data-msg="Please enter your  name"
              />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserLastName">Email</label>
              <input
                type="text"
                id="email"
                name="email"
                class="form-control"
                placeholder="email@example.com"
                value=""
                data-msg="Please enter your email"
              />
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserLastName">Phone Number</label>
                <input
                  type="tel"
                  id="phone"
                  name="phone_number"
                  class="form-control"
                  placeholder="+39200000"
                  value=""
                  data-msg="Please enter your phone number"
                />
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="normalMultiSelect">Select Users</label>
                <select class="select2InModal form-select" id="select2Demo" name="users[]" multiple="multiple">
                  @foreach ($users as $user)
                  <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
                  
                </select>
              </div>
              
           
            <div class="col-12 text-center mt-2 pt-50">
              <button type="submit" class="btn btn-primary me-1">Submit</button>
              <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                Discard
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/ Edit User Modal -->
  

