{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Manage Group & Permission')

{{-- vendor styles --}}
@section('vendor-style')
@endsection

{{-- page style --}}
@section('page-style')
@endsection

{{-- page content --}}
@section('content')
    <div class="section">

        {{-- Create New Permission --}}
        @permission('add-group')
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s6">
                            <h4 class="card-title">Add New Group</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 common-data-table" id="account">
                            <!-- users edit account form start -->
                            @if(count($crudPermission) > 0 || count($otherPermission) > 0)
                                <form id="accountForm" method="POST" action="{{ url('admin/permission') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col s12">

                                            <div class="row">
                                                <div class="col s12 input-field">
                                                    <input id="name" name="name" type="text" class="validate"
                                                        data-error=".errorTxt1" required>
                                                    <label for="name">Name of Group...</label>
                                                    <small class="errorTxt1"></small>
                                                </div>
                                            </div>
                                            <h6 class="mb-1 pl-1">Select Access</h6>

                                            @if (count($crudPermission) > 0)
                                                <table class="table responsive-table highlight">
                                                    <thead>
                                                        <th>
                                                            <input class="checkable allTableCheckbox dt-checkboxes label" type="checkbox" />
                                                            <label class="dt-checkboxes-label">
                                                                Crud Modules
                                                            </label>
                                                        </th>
                                                        @foreach ($actions as $action)
                                                            <th>{{ $action }}</th>
                                                        @endforeach
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($crudPermission as $moduleName => $actionsWithPermission)
                                                            <tr>
                                                                <th>
                                                                    <input id="permission{{$moduleName}}" class="checkable moduleCheckbox dt-checkboxes label"  type="checkbox"  />
                                                                    <label for="permission{{$moduleName}}" class="dt-checkboxes-label">
                                                                        {{ $moduleName }}
                                                                    </label>
                                                                </th>
                                                                @foreach ($actions as $action)
                                                                    <td>
                                                                        @if (isset($actionsWithPermission[$action]))
                                                                            <input id="NewPermission{{$actionsWithPermission[$action]->id}}" class="checkable actionCheckbox dt-checkboxes label" name="permission[]" type="checkbox"  value="{{$actionsWithPermission[$action]->id}}"/>
                                                                            {{-- <label for="NewPermission{{$actionsWithPermission[$action]->id}}" class="dt-checkboxes-label">
                                                                                {{$actionsWithPermission[$action]->name}}
                                                                            </label> --}}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endif

                                            @if (count($otherPermission) > 0)
                                                <br>
                                                <table class="table responsive-table highlight">
                                                    <thead>
                                                        <th>
                                                            <input class="checkable allTableCheckbox dt-checkboxes label" type="checkbox" />
                                                            <label class="dt-checkboxes-label">
                                                                Modules
                                                            </label>
                                                        </th>
                                                        <td>Actions</td>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($otherPermission as $moduleName => $mPermissions)
                                                            <tr>
                                                                <th>
                                                                    <input for="permission{{$moduleName}}" class="checkable moduleCheckbox dt-checkboxes label"  type="checkbox"  />
                                                                    <label for="permission{{$moduleName}}" class="dt-checkboxes-label">
                                                                        {{ $moduleName }}
                                                                    </label>
                                                                </th>
                                                                <td>
                                                                    <div class="row">
                                                                        @foreach ($mPermissions as $permission)
                                                                            <div class="col s3">
                                                                                <input id="NewPermission{{$permission->name}}" class="checkable actionCheckbox dt-checkboxes label" name="permission[]" type="checkbox"  value="{{$permission->id}}"/>
                                                                                <label for="NewPermission{{$permission->name}}" class="dt-checkboxes-label">
                                                                                    {{$permission->name}}
                                                                                </label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endif

                                            <div class="col s12 display-flex justify-content-end mt-3">
                                                <button type="submit" class="btn cyan waves-effect waves-light delete icon-padding-set"><i class="material-icons left">add</i> Add New Group</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="dnf-ui-card">
                                    <div class="center-align">
                                        <img width="40%" src="{{ url('assets/img/dnf-ui.jpg') }}">
                                        <h4 class="dnf-ui-title">Sorry, Permission List Not Found..</h4>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endpermission

        {{-- Handle Permission Of Old Group --}}
        @permission('view-group')
            @foreach ($groups as $item)
                @php
                    $group_permissions = $item->permissions()->pluck('id')->toarray();
                    // dd(implode(",",$group_permissions));
                @endphp
                <ul class="collapsible collapsible-accordion">
                    <li class="">
                        <div class="collapsible-header" tabindex="0">
                            <b> {{ $item->name }} </b>
                            <div class="float-right">
                                <i class="material-icons">arrow_drop_down</i>
                            </div>
                        </div>
                        <div class="collapsible-body" style="">
                            <!-- users edit account form start -->
                            <form method="POST" action="{{ url('admin/permission'."/".$item->id) }}">
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="" name="name" type="text" class="validate" value="{{ $item->name }}" required>
                                        <label for="">Group Name</label>
                                        <small class="errorTxt1"></small>
                                    </div>
                                </div>
                                <h6 class="mb-1 pl-1">Select Access</h6>

                                @if (count($crudPermission) > 0)
                                    <table class="table responsive-table highlight">
                                        <thead>
                                            <th>
                                                <input class="checkable allTableCheckbox dt-checkboxes label" type="checkbox" />
                                                <label class="dt-checkboxes-label">
                                                    Crud Modules
                                                </label>
                                            </th>
                                            @foreach ($actions as $action)
                                                <th>{{ $action }}</th>
                                            @endforeach
                                        </thead>
                                        <tbody>
                                            @foreach ($crudPermission as $moduleName => $actionsWithPermission)
                                                <tr>
                                                    <th>
                                                        <input for="permission{{$moduleName}}" class="checkable moduleCheckbox dt-checkboxes label"  type="checkbox"  />
                                                        <label for="permission{{$moduleName}}" class="dt-checkboxes-label">
                                                            {{ $moduleName }}
                                                        </label>
                                                    </th>
                                                    @foreach ($actions as $action)
                                                        <td>
                                                            @if (isset($actionsWithPermission[$action]))
                                                                <input
                                                                    id="NewPermission{{$actionsWithPermission[$action]->id}}"
                                                                    class="checkable actionCheckbox dt-checkboxes label"
                                                                    name="permission[]"
                                                                    type="checkbox"
                                                                    value="{{$actionsWithPermission[$action]->id}}"
                                                                    @if(in_array($actionsWithPermission[$action]->id, $group_permissions)) {{ 'checked' }} @endif
                                                                />
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                @if (count($otherPermission) > 0)
                                    <br>
                                    <table class="table responsive-table highlight">
                                        <thead>
                                            <th>
                                                <input class="checkable allTableCheckbox dt-checkboxes label" type="checkbox" />
                                                <label class="dt-checkboxes-label">
                                                    Modules
                                                </label>
                                            </th>
                                            <td>Actions</td>
                                        </thead>
                                        <tbody>
                                            @foreach ($otherPermission as $moduleName => $mPermissions)
                                                <tr>
                                                    <th>
                                                        <input for="permission{{$moduleName}}" class="checkable moduleCheckbox dt-checkboxes label"  type="checkbox"  />
                                                        <label for="permission{{$moduleName}}" class="dt-checkboxes-label">
                                                            {{ $moduleName }}
                                                        </label>
                                                    </th>
                                                    <td>
                                                        <div class="row">
                                                            @foreach ($mPermissions as $permission)
                                                                <div class="col s3">
                                                                    <input
                                                                        id="NewPermission{{$permission->name}}"
                                                                        class="checkable actionCheckbox dt-checkboxes label"
                                                                        name="permission[]"
                                                                        type="checkbox"
                                                                        value="{{$permission->id}}"
                                                                        @if(in_array($permission->id, $group_permissions)) {{ 'checked' }} @endif/>
                                                                    <label for="NewPermission{{$permission->name}}" class="dt-checkboxes-label">
                                                                        {{$permission->name}}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif

                                <div class="row">
                                    <div class="col s12 display-flex justify-content-end mt-3">
                                        @permission('delete-group')
                                            <a  class="common-remove-popup btn red waves-effect waves-light delete icon-padding-set"
                                                data-url="{{ url('admin/permission/'.$item->id) }}"
                                                data-title="Delete Confirmation!"
                                                data-content="Are you sure you want to delete this group?"
                                                data-csrf="{{ csrf_token() }}"><i class="material-icons left">delete</i> Delete Group</a>
                                        @endpermission
                                        @permission('edit-group')
                                            <button type="submit" class="btn cyan waves-effect waves-light ml-1 delete icon-padding-set"><i class="material-icons left">save</i> Save Group</button>
                                        @endpermission
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                </ul>
            @endforeach
        @endpermission
    </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
@endsection

{{-- page script --}}
@section('page-script')
    <script>
        $(".moduleCheckbox").change(function(){
            if($(this).prop('checked')){
                $(this).parents('tr').find('.actionCheckbox').prop('checked', true);
            }else{
                $(this).parents('tr').find('.actionCheckbox').prop('checked', false);
            }
        });

        $(".allTableCheckbox").change(function(){
            if($(this).prop('checked')){
                $(this).parents('table').find('.actionCheckbox').prop('checked', true);
                $(this).parents('table').find('.moduleCheckbox').prop('checked', true);
            }else{
                $(this).parents('table').find('.actionCheckbox').prop('checked', false);
                $(this).parents('table').find('.moduleCheckbox').prop('checked', false);
            }
        });
    </script>
@endsection
