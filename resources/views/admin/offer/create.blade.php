@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Offer Add')
{{-- page content --}}
@section('content')
<div class="section">
    <div id="Form-advance" class="card card card-default scrollspy">
        <div class="card-content">
            <div class="row">
                <div class="col s6">
                    <h4 class="card-title">Offer</h4>
                </div>
                <div class="col s6 right-align">
                    @permission('view-offer')
                        <a href="{{ url('admin/offer') }}" class="btn waves-effect waves-light icon-padding-set gradient-45deg-light-blue-cyan purple gradient-shadow">
                            <i class="material-icons left">menu</i> View  Offer
                        </a>
                    @endpermission
                </div>
            </div>
            <form method="POST" action="{{url('admin/offer')}}"enctype="multipart/form-data">
                @csrf
                <div class="row mt-4">
                    <div class="col s12">
                        <ul class="tabs">
                            @foreach ($findActiveLanguage as $item)
                            <li class="tab col m2"><a href="#{{$item->name}}">{{$item->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @foreach ($findActiveLanguage as $item)
                    <div id="{{$item->name}}" class="col s12">
                        <div class="input-field col m6 s12">
                            <input id="name{{$item->id}}" type="text" value="{{ old('header:'.$item->code) }}" name="header:{{$item->code}}">
                            <label for="name{{$item->id}}">Header ({{$item->name}})</label>
                            <small class="errorTxt2">
                                @error('header:'.$item->code)
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                        <div class="input-field col m6 s12">
                            <input id="name{{$item->id}}" type="text" value="{{ old('title:'.$item->code) }}" name="title:{{$item->code}}">
                            <label for="name{{$item->id}}">Title ({{$item->name}})</label>
                            <small class="errorTxt2">
                                @error('title:'.$item->code)
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                        <div class="input-field col m6 s12">
                            {{-- <input id="name{{$item->id}}" type="text" value="{{ old('description:'.$item->code) }}" name="description:{{$item->code}}"> --}}
                            <textarea id="reply"  name="description:{{$item->code}}" class="materialize-textarea" >{{ old('description:'.$item->code) }}</textarea>
                            <label for="name{{$item->id}}">Description ({{$item->name}})</label>
                            <small class="errorTxt2">
                                @error('description:'.$item->code)
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>

                        <div class="input-field col m6 s12">
                            <input id="name{{$item->id}}" type="text" value="{{ old('link_text:'.$item->code) }}" name="link_text:{{$item->code}}">
                            <label for="name{{$item->id}}">Link Text ({{$item->name}})</label>
                            <small class="errorTxt2">
                                @error('link_text:'.$item->code)
                                    <div class="error">{{$message}}</div>
                                @enderror
                            </small>
                        </div>
                    </div>
                    @endforeach

                <div class="row ml-1">

                    <div class="input-field col m6 s12">
                        <input id="name" type="text" name="link_url" value="{{ old('link_url') }}">
                        <label for="name">Link Url</label>
                        <small class="errorTxt2">
                            @error('link_url')
                                <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>

                    <div class="col m6 s12 file-field input-field">
                        <div class="btn float-right">
                            <span>Offer Image </span>
                            <input type="file" name="offer_image">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" placeholder="OfferImage" type="text">
                        </div>
                        <small class="errorTxt2">
                            @error('banner')
                            <div class="error">{{$message}}</div>
                            @enderror
                        </small>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 right-align">
                        <button class="btn cyan waves-effect waves-light ml-1" type="submit">Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection