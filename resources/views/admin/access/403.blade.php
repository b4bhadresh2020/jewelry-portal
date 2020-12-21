
{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title',$config['title'] ?? "Access Denied!" )

{{-- vendor styles --}}
@section('vendor-style')
@endsection

{{-- page style --}}
@section('page-style')
@endsection


{{-- page content --}}
@section('content')
<div class="section">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="dnf-ui-card" style="height: 75vh;">
                    <div class="center-align">
                        <img src="{{ url('default\permission.gif') }}" alt="">
                        <h4 class="dnf-ui-title">{{ $config['title'] ?? "Access Denied!" }}</h4>
                        <h5>{{ $config['message'] ?? "You Do Not Have The Permission To Access This Page." }} </h5>
                    </div>
                </div>
            </div>
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

