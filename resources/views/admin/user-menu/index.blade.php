{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','User Manus')
{{-- vendor styles --}}
@section('vendor-style')
<link rel="stylesheet" type="text/css" href="{{asset('js/jquery.nestable/nestable.css')}}">
@endsection
{{-- page style --}}
@section('page-style')
<style>
    .menu-action{
        position: absolute;
        top: 3px;
        right: 3%;
        cursor: pointer;
    }
</style>
@livewireStyles
@endsection
{{-- page content --}}
@section('content')
<div class="section">
<div class="row">
    <div class="col s12 m12 l12">
        <div id="basic-Netables" class="card card card-default scrollspy">
            <div class="table-tabs-pills">
                <ul class="nav nav-pills">
                    <h4 class="card-title">Manage User menu</h4>
                </ul>
                @permission('add-user-menu')
                    <a href="{{ url('admin/user-menu/create') }}" class="btn waves-effect icon-padding-set waves-light gradient-45deg-light-blue-cyan purple gradient-shadow mr-2">
                        <i class="material-icons left">add</i> Add New
                    </a>
                @endpermission
            </div>

            @if(count($userMenu) != 0)
                <div class="card-content">
                    <menu id="nestable-menu">
                        <button class="btn waves-effect icon-padding-set" type="button" data-action="expand-all">Expand All</button>
                        <button class="btn waves-effect icon-padding-set" type="button" data-action="collapse-all">Collapse All</button>
                    </menu>
                    <form method="POST" action="{{ url('admin/user-menu/update-menu-order') }}">
                        @csrf
                        <div class="dd" id="nestable">
                            <ol class="dd-list">
                                @foreach ($userMenu as $menu)
                                    @if ($menu->parent == 0)
                                        <li class="dd-item dd3-item" data-id="{{ $menu->id }}">
                                            <div class="dd-handle dd3-handle"></div>
                                            <div class="dd3-content">{{ $menu->title }}</div>
                                            <div class="menu-action">
                                                <a href="{{ url('admin/user-menu/'.$menu->id.'/edit') }}"> <i class="material-icons">edit</i> </a>
                                                <a data-csrf="{{ csrf_token() }}" data-url="{{ url('admin/user-menu/'.$menu->id) }}" data-title="Delete User Menu Confirmation!" data-content="Are you sure you want to delete this Menu?" class="common-remove-popup"> <i class="material-icons">delete</i> </a>
                                            </div>
                                            @if ($menu->submenu)
                                                <ol class="dd-list">
                                                    @foreach ($menu->submenu as $submenu)
                                                        <li class="dd-item dd3-item" data-id="{{ $submenu->id }}">
                                                            <div class="dd-handle dd3-handle"></div>
                                                            <div class="dd3-content">{{ $submenu->title }}</div>
                                                            <div class="menu-action">
                                                                @permission('edit-user-menu')
                                                                    <a href="{{ url('admin/user-menu/'.$submenu->id.'/edit') }}"> <i class="material-icons">edit</i> </a>
                                                                @endpermission
                                                                {{-- <a data-csrf="{{ csrf_token() }}" data-url="{{ url('admin/user-menu/'.$submenu->id) }}" data-title="Delete User Menu Confirmation!" data-content="Are you sure you want to delete this Menu?" class="common-remove-popup"> <i class="material-icons">delete</i> </a> --}}
                                                            </div>
                                                            @if ($submenu->submenu)
                                                                <ol class="dd-list">
                                                                    @foreach ($submenu->submenu as $subChildMenu)
                                                                        <li class="dd-item dd3-item" data-id="{{ $subChildMenu->id }}">
                                                                            <div class="dd-handle dd3-handle"></div>
                                                                            <div class="dd3-content">{{ $subChildMenu->title }}</div>
                                                                            <div class="menu-action">
                                                                                @permission('edit-user-menu')
                                                                                    <a href="{{ url('admin/user-menu/'.$subChildMenu->id.'/edit') }}"> <i class="material-icons">edit</i> </a>
                                                                                @endpermission
                                                                                {{-- <a data-csrf="{{ csrf_token() }}" data-url="{{ url('admin/user-menu/'.$subChildMenu->id) }}" data-title="Delete User Menu Confirmation!" data-content="Are you sure you want to delete this Menu?" class="common-remove-popup"> <i class="material-icons">delete</i> </a> --}}
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
                                                                </ol>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                        </div>
                        <textarea id="nestable-output" name="menu" style="display: none"></textarea>
                        <div class="row">
                            <div class="input-field col mt-1 s6">
                                <button class="btn cyan waves-effect waves-light" type="submit">Submit <i class="material-icons right">send</i> </button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <div class="dnf-ui-card">
                    <div class="center-align">
                        <img width="40%" src="{{ url('assets/img/dnf-ui.jpg') }}">
                        <h4 class="dnf-ui-title">Sorry, Menus Not Found..</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
{{-- page script --}}
@section('vendor-script')
<script src="{{asset('js/jquery.nestable/jquery.nestable.js')}}"></script>
@endsection
{{-- page scripts --}}
@section('page-script')
<script src="{{asset('js/menu-nestable.js')}}"></script>
@endsection
