<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#"
                    data-toggle="sidebar"
                    class="nav-link nav-link-lg"><i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown" id="lang-change">
            @php
                if(Session::has('locale')){
                    $locale = Session::get('locale', Config::get('app.locale'));
                }
                else{
                    $locale = 'en';
                }
            @endphp
            @if(\App\Models\Language::where('code', $locale)->first() != null)
                <a href="" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <img loading="lazy"  src="{{ asset('img/flags/'.$locale.'.png') }}" class="flag" style="margin-right:6px;"><span class="language">{{ \App\Models\Language::where('code', $locale)->first()->name }}</span>
                </a>
            @endif
            <ul class="dropdown-menu">
                @foreach (\App\Models\Language::all() as $key => $language)
                    <li class="dropdown-item @if($locale == $language) active @endif">
                        <a href="#" data-flag="{{ $language->code }}"><img loading="lazy"  src="{{ asset('img/flags/'.$language->code.'.png') }}" class="flag" style="margin-right:6px;"><span class="language">{{ $language->name }}</span></a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="dropdown"><a href="#"
                data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if(!empty(Auth::user()->avatar))
                <img alt="image"
                    src="{{ Auth::user()->avatar->url }}"
                    class="rounded-circle mr-1">
                @else
                <img alt="image"
                    src="{{ asset('img/avatar/avatar-1.png') }}"
                    class="rounded-circle mr-1">
                @endif
                <div class="d-sm-none d-lg-inline-block">{{__('Hi')}}, {{Auth::user()->name}}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('profile.index') }}"
                    class="dropdown-item has-icon">
                    <i class="far fa-user"></i> {{ __('Profile') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}"
                    class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> {{__('Logout')}}
                </a>
            </div>
        </li>
    </ul>
</nav>
