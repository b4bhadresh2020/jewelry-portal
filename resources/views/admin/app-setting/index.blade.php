@php
    use App\AppSetting;
@endphp
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
                        @permission('general-setting')
                            <li class="tab">
                                <a href="#general"
                                class="@if(request('open')=="general") {{ 'active' }} @endif"
                                    onclick="__qs_change('open','general')">
                                    <i class="material-icons">brightness_low</i>
                                    <span>General</span>
                                </a>
                            </li>
                        @endpermission
                        @permission('social-link-setting')
                            <li class="tab">
                                <a href="#social-link"
                                    class="@if(request('open')=="social-link") {{ 'active' }} @endif"
                                    onclick="__qs_change('open','social-link')">
                                    <i class="material-icons">chat_bubble_outline</i>
                                    <span>Social Links</span>
                                </a>
                            </li>
                        @endpermission
                        @permission('homepage-setting')
                            <li class="tab">
                                <a href="#home-page"
                                    class="@if(request('open')=="home-page") {{ 'active' }} @endif"
                                    onclick="__qs_change('open','home-page')">
                                    <i class="material-icons">home</i>
                                    <span> Home Page</span>
                                </a>
                            </li>
                        @endpermission
                    </ul>
                </div>
            </div>
            <div class="col l8 s12">
                <!-- tabs content -->
                @permission('general-setting')
                    <div id="general">
                        <div class="card-panel">
                            <form class="formValidate" method="post" action="{{ url('admin/setting/general') }}">
                                @csrf
                                <div class="row">
                                    <div class="col s12">
                                        <div class="input-field">
                                            <label for="email">E-mail</label>
                                            <input id="email" type="email" name="email" value="" data-error=".errorTxt3">
                                            <small class="errorTxt3"></small>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <div class="input-field">
                                            <label for="name">Contact No</label>
                                            <input id="name" name="name" type="text" value="" data-error=".errorTxt2">
                                            <small class="errorTxt2"></small>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <div class="input-field">
                                            <input id="company" type="text">
                                            <label for="company">Location Link</label>
                                        </div>
                                    </div>
                                    <h6 class="col s12">Footer</h6>
                                    <div class="col s12">
                                        <div class="input-field">
                                            <label for="uname">Slogan</label>
                                            <input type="text" id="uname" name="uname" value="" data-error=".errorTxt1">
                                            <small class="errorTxt1"></small>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <div class="input-field">
                                            <input id="company" type="text">
                                            <label for="company">Address</label>
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <button type="submit" class="btn darked waves-light waves-effect mr-sm-1 mr-2">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endpermission
                @permission('social-link-setting')
                    <div id="social-link">
                        <div class="card-panel">
                            <form method="post" action="{{ url('admin/setting/social-link') }}">
                                @csrf
                                <div class="row">
                                    @foreach (AppSetting::SOCIAL_LINK_MAPPING as $linkkey => $linkTitle)
                                        <div class="col s12">
                                            <div class="input-field">
                                                <input name="links[{{ $linkkey }}]" id="SL-{{ $linkTitle }}" type="text" class="validate" placeholder="Add link"
                                                    value="@if(isset($oldLinksBatchList[$linkkey])) {{  $oldLinksBatchList[$linkkey] }}  @endif">
                                                <label for="SL-{{ $linkTitle }}">{{ $linkTitle }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col s12">
                                        <button type="submit" class="btn darked waves-light waves-effect mr-sm-1 mr-2">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endpermission
                @permission('homepage-setting')
                    <div id="home-page">
                        <div class="card-panel">
                            <form method="post" action="{{ url('admin/setting/home-page') }}">
                                @csrf
                                <div class="row">
                                    <h6 class="col s12 mb-2">Home Block Visibility</h6>
                                    @foreach (AppSetting::HOME_PAGE_MAPPING as $homekey => $homeTitle)
                                        <div class="col s12 mb-1">
                                            <div class="switch">
                                                <label for="{{ $homekey }}">
                                                    <input
                                                        type="checkbox"
                                                        id="{{ $homekey }}"
                                                        name="homepage[{{ $homekey }}]"
                                                        value="{{ $homekey }}"
                                                        @if(in_array($homekey, $oldHomaPageBatchList)) {{ 'checked' }} @endif>
                                                    <span class="lever"></span>
                                                </label>
                                                <span class="switch-label w-100">{{ $homeTitle }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col s12 mt-2">
                                        <button type="submit" class="btn darked waves-light waves-effect mr-sm-1 mr-2">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endpermission
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
@endsection
