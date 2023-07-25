@extends('layouts/contentLayoutMaster')

@section('title', 'Disease')

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
      <button type="button" class="btn btn-primary" onclick="userModal()">Add</button>
    </div>
      {{ $dataTable->table() }}
    </div>
    
  </div>
  <!-- list and filter end -->
</section>
<!-- users list ends -->

@include('generalsetting.create-disease')
{{-- @include('app.customer.modal')
@include('app.customer.import-model') --}}
@endsection

@section('vendor-script')
{{-- Vendor js files --}}
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  
  @endsection
  
  @section('page-script')
  {{ $dataTable->scripts() }};
 
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  
  <script>

  function userModal(){

        $("#default").modal('show');

  }


$("#editUserForm").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id =$("#userId").val();
            var url = "{{ route('diseases.store') }}";
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
                            $('#disease-table')
                            .DataTable()
                            .ajax.reload();
                        $("#default").modal('hide');

                        
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
       var url = '{{ route("diseases.edit", ":id") }}';
        url = url.replace(':id', id);

  
            $.ajax({
                url:url,
                type: "GET",
                contentType: false,
                processData: false,
                success: function(response) {

                  $('#d-id').val(response.id);
                  $('#name').val(response.name);
                  $('#status').val(response.status);
                  $("#default").modal('show');

                },
                error: function(response) {
                    alert("Failed")
                }
            });
  }
  </script>

@endsection
