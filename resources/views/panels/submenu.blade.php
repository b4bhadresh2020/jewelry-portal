<div class="collapsible-body">
  <ul class="collapsible collapsible-sub" data-collapsible="accordion">
    @foreach ($menu as $submenu)
        @if(isset($submenu->permissions) && auth()->user()->hasAnyHavePermission(@$submenu->permissions) || isDeveloper()) {{-- check Permission --}}
            @php
                $custom_classes="";
                if(isset($submenu->class))
                {
                    $custom_classes = $submenu->class;
                }
            @endphp
            <li class="{{(request()->is($submenu->url)) ? 'active' : '' }}">
                <a href="@if(($submenu->url) === 'javascript:void(0)'){{$submenu->url}} @else{{url($submenu->url)}} @endif"
                    class="{{$custom_classes}} {{(request()->is($submenu->url)) ? 'active '.$configData['activeMenuColor'] : '' }}"
                    @if(!empty($configData['activeMenuColor'])) {{'style=background:none;box-shadow:none;'}} @endif>
                        <i class="material-icons">@if($peta) - @else radio_button_unchecked @endif</i>
                    <span>{{ __('locale.'.$submenu->name)}}</span>
                </a>
                @if (isset($submenu->submenu))
                    @include('panels.submenu', ['menu' => $submenu->submenu, 'peta'=>true])
                @endif
            </li>
        @endif
    @endforeach
  </ul>
</div>
