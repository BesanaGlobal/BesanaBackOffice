@extends('../layout/main')

@section('head')
    @yield('subhead')
@endsection

@section('content')
    @include('../layout/components/mobile-menu')

    <div class="flex mt-[4.7rem] md:mt-0 overflow-hidden">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="" class="intro-x flex flex-col items-center ">
                <img alt="Besanaglobal.com" class=" w-16 md:w-auto" src="{{ asset('img/besana.png') }}">
                @if (Auth::user())
                        @if (Auth::user()->active==1)
                        <span class=" text-bold text-lime-400 font-black uppercase text-xl ">{{__('Active')}}</span>
                        @else
                        <span class=" text-bold text-red-700 font-black uppercase text-xl ">{{__('Inactive')}}</span>

                        @endif
                @endif
                
            </a>
            <div class="side-nav__devider my-6">
               
            </div>
            <ul>
                @if (Auth::user())
                @if (Auth::user()->active!=0)
                @foreach ($side_menu as $menuKey => $menu)
                @if ($menu == 'devider')
                    <li class="side-nav__devider my-6"></li>
                @else
                    <li>
                        <a href="{{ isset($menu['route_name']) ? route($menu['route_name'], $menu['params']) : 'javascript:;' }}" class="{{ $first_level_active_index == $menuKey ? 'side-menu side-menu--active' : 'side-menu' }}">
                            <div class="side-menu__icon">
                                <i data-lucide="{{ $menu['icon'] }}"></i>
                            
                            </div>
                            <div class="side-menu__title">
                                {{ __($menu['title']) }}
                                @if (isset($menu['sub_menu']))
                                    <div class="side-menu__sub-icon {{ $first_level_active_index == $menuKey ? 'transform rotate-180' : '' }}">
                                        <i data-lucide="chevron-down"></i>
                                    </div>
                                @endif
                            </div>
                        </a>
                        @if (isset($menu['sub_menu']))
                            <ul class="{{ $first_level_active_index == $menuKey ? 'side-menu__sub-open' : '' }}">
                                @foreach ($menu['sub_menu'] as $subMenuKey => $subMenu)
                                    <li>
                                        <a href="{{ isset($subMenu['route_name']) ? route($subMenu['route_name'], $subMenu['params']) : 'javascript:;' }}" class="{{ $second_level_active_index == $subMenuKey ? 'side-menu side-menu--active' : 'side-menu' }}">
                                            <div class="side-menu__icon">
                                                <i data-lucide="activity"></i>
                                            </div>
                                            <div class="side-menu__title">
                                                {{ $subMenu['title'] }}
                                                @if (isset($subMenu['sub_menu']))
                                                    <div class="side-menu__sub-icon {{ $second_level_active_index == $subMenuKey ? 'transform rotate-180' : '' }}">
                                                        <i data-lucide="chevron-down"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </a>
                                        @if (isset($subMenu['sub_menu']))
                                            <ul class="{{ $second_level_active_index == $subMenuKey ? 'side-menu__sub-open' : '' }}">
                                                @foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu)
                                                    <li>
                                                        <a href="{{ isset($lastSubMenu['route_name']) ? route($lastSubMenu['route_name'], $lastSubMenu['params']) : 'javascript:;' }}" class="{{ $third_level_active_index == $lastSubMenuKey ? 'side-menu side-menu--active' : 'side-menu' }}">
                                                            <div class="side-menu__icon">
                                                                <i data-lucide="zap"></i>
                                                            </div>
                                                            <div class="side-menu__title">{{ $lastSubMenu['title'] }}</div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif
            @endforeach
        @endif
                @endif
                
               
            </ul>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            @auth
                @include('../layout/components/top-bar')
            @endauth
            @yield('subcontent')
        </div>
        <!-- END: Content -->
    </div>
@endsection

