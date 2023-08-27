<div class="-intro-x dropdown d-none d-lg-inline-block me-2">
    @if(App::isLocale('en'))
        <button type="button" class="btn header-item noti-icon waves-effect" title="Cambiar a Español">
            <a href="{{route('changelanguage','es')}}" class="dropdown-item notify-item">
                <img src="{{asset('img/banderaspain.png')}}" alt="spanish" height="25" width="25">
            </a>
        </button>
    @else
        <button type="button" class="btn header-item noti-icon waves-effect" title="Change to English">
            <a href="{{route('changelanguage','en')}}" class="dropdown-item notify-item">
                <img src="{{asset('img/usa.svg')}}" alt="english" width="25" height="25">
            </a>
        </button>
    @endif
</div>