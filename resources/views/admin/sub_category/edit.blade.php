{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Sub Category')
{{-- page content --}}

@section('content')
    <div class="section">
        <div id="Form-advance" class="card card card-default scrollspy">
            <div class="card-content">
                <div class="row">
                    <div class="col s6">
                        <h4 class="card-title">Edit SubCategory</h4>
                    </div>
                    <div class="col s6 right-align">
                        @permission('view-sub-category')
                            <a href="{{ url('admin/sub-category') }}" class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow">
                                <i class="material-icons left">menu</i> View SubCategory
                            </a>
                        @endpermission
                    </div>
                </div>
                <form method="POST" action="{{ url('admin/sub-category') }}/{{ $subCategory->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="input-field col m6 s12">
                            <select class="form-select" name="category_id">
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}" {{(($item->id == $subCategory->category_id)?'selected':'')}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                            <small class="errorTxt2">
                                @error('category_id')
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>

                        <div class="col m6 s12 file-field input-field">
                            <div class="btn float-right">
                                <span>File</span>
                                <input type="file" name="image">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                            <small class="errorTxt2">
                                @error('image')
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                    </div>

                    @foreach ($findActiveLanguage as $item)
                        @if($loop->iteration % 2 == 0)
                            <div class="row">
                        @endif
                            <div class="input-field col m6 s12">
                                <input id="name{{@$item->id}}" type="text" value="{{@$subCategory->translate(@$item->code)->name}}" name="name:{{@$item->code}}">
                                <label for="name{{@$item->id}}">Sub Category Name ({{@$item->name}})</label>
                                <small class="errorTxt2">
                                    @error('name:'.@$item->code)
                                        <div class="error">{{$message}}</div>
                                    @enderror
                                </small>
                            </div>
                        @if($loop->iteration % 2 == 0)
                            </div>
                        @endif
                    @endforeach




                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light left ml-1" type="submit">Save
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
