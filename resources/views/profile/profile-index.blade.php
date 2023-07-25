@extends('layouts/contentLayoutMaster')

@section('title', 'Profile')
@section('vendor-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">

@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-profile.css')) }}">

    <script src="{{ asset(mix('js/scripts/components/components-tooltips.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>

    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/modal-add-role.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-access-roles.js')) }}"></script>

@endsection


@section('content')
    <div id="user-profile">
        <!-- profile header -->
        

        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    @if (session('error'))
                        {{ session('error') }}
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                @if (isset($user))
                                    @lang('Update Profile')
                                @else
                                    @lang('Create Profile')
                                @endif
                            </h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical"
                                    action="{{ route('admin.profile.update') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <input type="file" accept="image/*" name="img" id="logo_file"
                            value="{{ @$user->avatar }}" onchange="avatar(event)" style="display:none;">
                        <div class="position-relative">
                            <!-- profile picture -->
                            <div class="profile-img-container d-flex align-items-center">

                                @php
                                $avatar = 'images/avatars/male.png';
                                if(@$user->avatar){
                                    $avatar = 'user-img/'. @$user->avatar;
                                }
                                @endphp
                                <div class="profile-img">
                                    <label for="logo_file" style="cursor: pointer;">
                                        <img for="logo_file" id="log_output"
                                            src="{{asset($avatar)}}"
                                            class="rounded" alt="Card image" height="100"/></label>
                                </div>
                                <script>
                                    var avatar = function(event) {
                                        var image = document.getElementById('log_output');
                                        image.src = URL.createObjectURL(event.target.files[0]);
                                    };
                                </script>
                           
                            </div>
                        </div>


                                    <div class="row">
                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">First Name</label>
                                            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name ?? null) }}" id="first_name" class="form-control"
                                                placeholder="First Name" required />
                                                @error('first_name')
                                                <p><small class="text-danger">{{ $message }}</small></p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="email">Last Name</label>
                                            <input type="text" name="last_name" id="last_name" value="{{ old('name', $user->last_name ?? null) }}" class="form-control"
                                                placeholder="Last Name" aria-label="john.doe" required />
                                        </div>
                                        @error('last_name')
                                        <p><small class="text-danger">{{ $message }}</small></p>
                                    @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" name="username" id="username" value="{{ old('name', $user->username ?? null) }}" class="form-control"
                                                placeholder="johndoe" required/>
                                                @error('username')
                                                <p><small class="text-danger">{{ $message }}</small></p>
                                            @enderror
                                        </div>
                                
                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ old('name', $user->email ?? null) }}"
                                                placeholder="john.doe@email.com" aria-label="john.doe" required/>
                                                @error('email')
                                                <p><small class="text-danger">{{ $message }}</small></p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="mobile-number">Contact Number</label>
                                            <input type="tel" name="phone_number" id="contect" value="{{ old('name', $user->phone_number ?? null) }}"
                                                class="form-control mobile-number-mask" placeholder="(472) 765-3654" required/>
                                                @error('phone_number')
                                                <p><small class="text-danger">{{ $message }}</small></p>
                                            @enderror
                                        </div>
                                
                                    </div>
                         
                                    <div class="row">
                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="input-group input-group-merge form-password-toggle">
                                                <input type="password" name="password" id="password" 
                                                    class="form-control"  {{ @$user->password ?? 'required' }}
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                <span class="input-group-text cursor-pointer"><i
                                                        data-feather="eye"></i></span>
                                            </div>
                                            @error('password')
                                            <p><small class="text-danger">{{ $message }}</small></p>
                                        @enderror
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="confirm-password">Confirm Password</label>
                                            <div class="input-group input-group-merge form-password-toggle">
                                                <input type="password" name="password_confirmation" id="password_confirm"
                                                    class="form-control"  {{ @$user->password ?? 'required' }}
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                <span class="input-group-text cursor-pointer"><i
                                                        data-feather="eye"></i></span>
                                            </div>
                                        </div>
                                    </div>
    
    
                                        <div class="d-flex justify-content-between mt-2">
                                            
                                            <button type="submit" class="btn btn-success btn-next">
                                                <span class="align-middle d-sm-inline-block d-none">Submit</span>
    
                                            </button>
                                        </div>
                                    </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
    </div>

    </section>


@endsection
@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    {{-- data table --}}
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>

@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/page-profile.js')) }}"></script>


    <script src="{{ asset(mix('js/scripts/pages/modal-edit-user.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-user-view-account.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-user-view.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>


    <script>

        let status = "{{ session('success') ? 'success' : (session('error') ? 'error' : '') }}"
        let message = "{{ session('success') ? session('success') : (session('error') ? session('error') : '') }}"
        if (status) {
            var isRtl = $('html').attr('data-textdirection') === 'rtl';
            if (status) {
                toastr[status](
                    message, status, {
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        rtl: isRtl
                    });
            }

        }


    </script>
@endsection
