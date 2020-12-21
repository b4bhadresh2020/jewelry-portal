<aside class="sidebar col-lg-3">
    <div class="widget widget-dashboard">
        <ul class="list">
            <li class="@if($activeSidebar == "dashboard") active @endif">
                <a href="{{ url('dashboard') }}">Account Dashboard</a>
            </li>
            <li class="@if($activeSidebar == "profile") active @endif">
                <a href="{{ url('dashboard/profile') }}">Profile Information</a>
            </li>
            <li class="@if($activeSidebar == "change-password") active @endif">
                <a href="{{ url('dashboard/change-password') }}">@auth @if (auth()->user()->password) Change @else Set @endif @endauth Password</a>
            </li>
            <li class="@if($activeSidebar == "addresses") active @endif">
                <a href="{{ url('dashboard/address') }}">Address Book</a>
            </li>
            <li class="@if($activeSidebar == "orders") active @endif">
                <a href="{{ url('dashboard/orders') }}">My Orders</a>
            </li>
            {{-- <li><a href="#">Billing Agreements</a></li>
            <li><a href="#">Recurring Profiles</a></li>
            <li><a href="#">My Product Reviews</a></li>
            <li><a href="#">My Tags</a></li> --}}
            <li class="@if($activeSidebar == "wishlist") active @endif">
                <a href="javascript:void(0)">My Wishlist</a>
            </li>
            {{-- <li><a href="#">My Applications</a></li>
            <li><a href="#">Newsletter Subscriptions</a></li>
            <li><a href="#">My Downloadable Products</a></li> --}}
        </ul>
    </div>
</aside>
