{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')
{{-- page title --}}
@section('title','Language Setting')

@section('vendor-style')
@endsection

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" href="{{asset('css/custom/language.css')}}">
@endsection

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
            <form action="{{ url('admin/language')}}" method="post">
                @csrf
                @foreach ($languages as $item)
                    <input type="hidden" name="code[{{$item->id}}]" value="{{$item->code}}">
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="name{{$item->id}}" name="name[{{$item->id}}]" type="text" value="{{$item->name}}" class="validate">
                            <label for="name{{$item->id}}">Name ({{ $item->code }})</label>
                        </div>
                        <div class="col s2 checkbox-block">
                            <label for="is_visible{{$item->id}}">
                                <input @if($item->code === "en") disabled @endif id="is_visible{{$item->id}}" type="checkbox" name="is_visible[{{$item->id}}]" {{($item->is_visible)?'checked':''}}>
                                <span>Add in user side</span>
                            </label>
                        </div>
                        <div class="col s2 checkbox-block">
                            <label for="status{{$item->id}}" >
                                <input @if($item->code === "en") disabled @endif id="status{{$item->id}}" type="checkbox" name="status[{{$item->id}}]" value="{{($item->status)?1:0}}" {{($item->status)?'checked':''}}>
                                <span>Information status</span>
                            </label>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn cyan waves-effect waves-light " type="submit">Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


{{-- vendor scripts --}}
@section('vendor-script')
@endsection

{{-- page script --}}
@section('page-script')
@endsection
