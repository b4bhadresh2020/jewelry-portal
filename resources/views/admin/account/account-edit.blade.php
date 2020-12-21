{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Account Settings')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-account-settings.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <section class="tabs-vertical mt-1 section">
        <div class="row">
            <div class="col l4 s12">
                <!-- tabs  -->
                <div class="card-panel">
                    <ul class="tabs">
                        <li class="tab">
                            <a href="#general">
                            <i class="material-icons">account_circle</i>
                            <span>Profile</span>
                            </a>
                        </li>
                        <li class="tab">
                            <a href="#change-password">
                            <i class="material-icons">lock_open</i>
                            <span>Change Password</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col l8 s12">
                <!-- tabs content -->
                <div id="general">
                    <div class="card-panel">
                        <center>
                            <label for="pro_img" class="hand">
                                <img style="width: 70px;height: 70px;" src="{{ userProfile(auth()->user()) }}" class="img-responsive imagePreviewPath img-circle">
                            </label>
                            <div class="display-image-name"> User Profile</div>
                            <div class="text-warning"> [Only allow .jpeg, .jpg, .png, .svg file]</div>
                            @error('profile')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </center>
                        <div class="divider mb-1 mt-1"></div>
                        <form class="formValidate" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="profile" onchange="img_pathUrl(this,'.imagePreviewPath');" class="imageUploadPath1" id="pro_img" style="display: none;">
                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field">
                                        <label for="FirstName">First Name</label>
                                        <input type="text" id="FirstName" name="first_name" value="@if($errors->any()) {{ old('first_name')}} @else {{ auth()->user()->first_name}} @endif" data-error=".errorTxt1">
                                        <small class="errorTxt1"></small>
                                        @error('first_name')
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <label for="last_name">Last Name</label>
                                        <input id="last_name" name="last_name" type="text" value="@if($errors->any()) {{ old('last_name')}} @else {{ auth()->user()->last_name}} @endif" data-error=".errorTxt2">
                                        <small class="errorTxt2"></small>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <label for="email">E-mail</label>
                                        <input id="email" type="email" name="email" value="@if($errors->any()) {{ old('email')}} @else {{ auth()->user()->email}} @endif" data-error=".errorTxt3">
                                        <small class="errorTxt3"></small>
                                    </div>
                                </div>

                                <div class="col s12 ">
                                    <button type="submit" class="btn darked waves-effect waves-light mr-2">
                                        Save changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="change-password">
                    <div class="card-panel">
                        <form class="paaswordvalidate">
                            @csrf
                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="cp-current-password" name="oldpassword" type="password" placeholder="* * * * * * * *"  data-error=".errorTxt4">
                                        <label for="cp-current-password">Old Password</label>
                                        <small class="errorTxt4"></small>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="cp-new-password" name="password" type="password" placeholder="* * * * * * * *"  data-error=".errorTxt5">
                                        <label for="cp-new-password">New Password</label>
                                        <small class="errorTxt5"></small>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="cp-retype-password" type="password" name="password_confirmation" placeholder="* * * * * * * *" data-error=".errorTxt6">
                                        <label for="cp-retype-password">Confirm Password</label>
                                        <small class="errorTxt6"></small>
                                    </div>
                                </div>
                                <div class="col s12 ">
                                    <button type="button" class="btn btn-change-password darked waves-effect waves-light mr-1">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- page scripts --}}
@section('vendor-script')
    <script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/page-account-settings.js')}}"></script>
    <script>
        $(".btn-change-password").click(function(event) {
            var formData = $(this).parents('form').serializeArray();
            var txtCurrentPassword = $("#cp-current-password").val();
            var txtNewPassword = $("#cp-new-password").val();
            var txtRetypetPassword = $("#cp-retype-password").val();

            if (txtCurrentPassword!="" && txtNewPassword!="" && txtRetypetPassword!="") {
                if(txtNewPassword == txtRetypetPassword){
                    $.post("{{ url('admin/change-password') }}", formData, function(res) {
                        if(res.status)
                            toastr.success(res.msg);
                        else
                            toastr.warning(res.msg);
                    });
                }else{
                    toastr.warning("Confirm Password Not Match With New Password");
                }
            }else{
                toastr.warning("All Field Is Require.");
            }
        });
    </script>
@endsection
