<body
  class="{{$configData['mainLayoutTypeClass']}} @if(!empty($configData['bodyCustomClass']) && isset($configData['bodyCustomClass'])) {{$configData['bodyCustomClass']}} @endif"
  data-open="click" data-menu="horizontal-menu" data-col="2-columns">

  <!-- BEGIN: Header-->
  <header class="page-topbar" id="header">
    @include('panels.horizontalNavbar')
  </header>
  <!-- BEGIN: SideNav-->
  @include('panels.sidebar')
  <!-- END: SideNav-->

  <!-- BEGIN: Page Main-->
  <div id="main">
    <div class="row">
      @if($configData["navbarLarge"] === true && isset($configData["navbarLarge"]))
      {{-- navabar large  --}}
      <div class="content-wrapper-before {{$configData["navbarLargeColor"]}}"></div>
      @endif

      @if ($configData["pageHeader"] === true && isset($breadcrumbs))
      {{-- breadcrumb --}}
      @include('panels.breadcrumb')
      @endif
      <div class="col s12">
        <div class="container">
          {{-- main page content  --}}
          @yield('content')
          {{-- right sidebar  --}}
          @include('pages.sidebar.right-sidebar')
        </div>
        {{-- overlay --}}
        <div class="content-overlay"></div>
      </div>
    </div>
  </div>

  <!-- END: Page Main-->

  {{-- main footer  --}}
  @include('panels.footer')

  {{-- vendors and page scripts file   --}}
  @include('panels.scripts')
  <script>
      $(document).ready(function(){
          @if(session('toast_success'))
          toastr.success("{{session('toast_success')}}");
          @endif
          @if(session('toast_error'))
          toastr.error("{{session('toast_error')}}");
          @endif
          @if(session('warning_error'))
          toastr.warning("{{session('warning_error')}}");
          @endif
      });
  </script>
</body>
