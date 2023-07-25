@extends('layouts/contentLayoutMaster')

@section('title', 'User List')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  {{-- <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}"> --}}
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">


  <style>
    div.table-responsive>div.dataTables_wrapper>div.row {
    margin: 15px;
}
  </style>
@endsection

@section('content')
<!-- users list start -->
<section class="app-user-list">

  <!-- list and filter start -->
  <div class="card">
    <div class="card-datatable table-responsive pt-0">
      <div class="pt-2 ms-2">
      <button type="button" class="btn btn-primary" onclick="userModal()">Create</button>
    </div>
      {{ $dataTable->table() }}
    </div>
    
  </div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->

@include('app.user.modal')
@endsection

@section('vendor-script')
{{-- Vendor js files --}}
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  {{-- <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script> --}}
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  
  @endsection
  
  @section('page-script')
  {{ $dataTable->scripts() }};
  {{-- Page js files --}}
  {{-- <script src="{{ asset(mix('js/scripts/pages/app-user-list.js')) }}"></script> --}}
  <script>
    function userModal(){
      $('#userId').val(0);
      $('#name').val('');
      $('#email').val('');
      $('#phone').val('');
      $("#editUser").modal('show');
    }

    $("#editUserForm").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id =$("#userId").val();
            var url = "{{ route('users.store') }}";
            var type = "POST";

            let formData = new FormData(this);
            $.ajax({
                url: url,
                type: type,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                            $('#user-table')
                            .DataTable()
                            .ajax.reload();
                        $("#editUser").modal('hide');

                        
                    } else {
                        toastr[response.status](
                            response.message, '!Oops', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                    }


                },
                error: function(response) {
                    alert("Failed")
                }
            });
        });

  function editUser(id){
    var user = id;
       var url = '{{ route("users.edit", ":id") }}';
        url = url.replace(':id', id);

  
            $.ajax({
                url:url,
                type: "GET",
                contentType: false,
                processData: false,
                success: function(response) {

                  $('#userId').val(response.id);
                  $('#name').val(response.name);
                  $('#email').val(response.email);
                  $('#phone').val(response.phone_number);
                  $("#editUser").modal('show');

                },
                error: function(response) {
                    alert("Failed")
                }
            });
  }

  function userDelete(id){
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    var user = id;
       var url = '{{ route("users.destroy", ":id") }}';
        url = url.replace(':id', id);

  
            $.ajax({
                url:url,
                type: "DELETE",
                contentType: false,
                processData: false,
                success: function(response) {

                  var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                            $('#user-table')
                            .DataTable()
                            .ajax.reload();

                        
                    } else {
                        toastr[response.status](
                            response.message, '!Oops', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                    }



                },
                error: function(response) {
                    alert("Failed")
                }
            });

  }

  let status = "{{ session('success') ? 'success' : (session('error') ? 'error' : '') }}"
let message = "{{ session('success') ? session('success') : (session('error') ? session('error') : '') }}"
if (status) {
  var isRtl = $('html').attr('data-textdirection') === 'rtl';
  if(status){
    toastr[status](
    message, status,{
        closeButton: true,
        tapToDismiss: false,
        progressBar: true,
        rtl: isRtl
    });
}
      
}
  </script>
@endsection
