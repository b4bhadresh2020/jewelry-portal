<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    {{-- load links file --}}
    @include('customer.layouts.links')

    {{-- load custom page level style --}}
    @yield('page-style')
</head>
<body>
    <div class="body-inner">
        @include('customer.layouts.header')

        {{-- load content --}}
        @yield('content')

        {{-- load footer file --}}
        @include('customer.layouts.footer')

        {{-- load scripts file --}}
        @include('customer.layouts.scripts')
    </div>

    {{-- load custom page level script --}}
    @yield('page-script')
</body>
</html>
