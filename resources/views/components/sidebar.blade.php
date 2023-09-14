<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        @php
            $generalsetting = \App\Models\GeneralSetting::first();
        @endphp
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ $generalsetting->site_name ?? env('APP_NAME') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">{{ $generalsetting->site_name[0] ?? env('APP_NAME')[0]}}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ areActiveRoutes(['admin.dashboard'])}}">
                <a class="nav-link"
                    href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i> <span>{{ __('Dashboard') }}</span></a>
            </li>
            <li class="nav-item dropdown {{ areActiveRoutes(['categories.index','categories.create','categories.edit','expenses.index','expenses.create','expenses.edit'])}}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="fas fa-money-bill"></i><span>{{ __('Expenses Manager') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ areActiveRoutes(['categories.index','categories.create','categories.edit'])}}">
                        <a class="nav-link"
                            href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
                    </li>
                    <li class="{{ areActiveRoutes(['expenses.index','expenses.create','expenses.edit'])}}">
                        <a class="nav-link"
                            href="{{ route('expenses.index') }}">{{ __('Expenses') }}</a>
                    </li>
                </ul>
            </li>
            @if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))

                <li class="nav-item dropdown {{ areActiveRoutes(['users.index'])}}">
                    <a href="#"
                        class="nav-link has-dropdown"
                        data-toggle="dropdown">
                        <i class="fas fa-users"></i><span>{{ __('Users') }}</span></a>
                    <ul class="dropdown-menu">

                        <li class="{{ areActiveRoutes(['users.index'])}}">
                            <a class="nav-link"
                                href="{{route('users.index')}}">{{ __('Users list') }}</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->user_type == 'admin' || in_array('2', json_decode(Auth::user()->staff->role->permissions)))
            <li class="nav-item dropdown {{ areActiveRoutes(['activation.index','activation.index','smtp_settings.index','languages.index', 'languages.create', 'languages.store', 'languages.show', 'languages.edit','generalsettings.index','generalsettings.logo'])}}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-cog"></i>
                    <span>{{__('Settings')}}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ areActiveRoutes(['activation.index'])}}">
                        <a class="nav-link"
                            href="{{route('activation.index')}}">{{ __('Activation') }}</a>
                    </li>
                                <li class="{{ areActiveRoutes(['smtp_settings.index'])}}">
                                    <a class="nav-link" href="{{ route('smtp_settings.index') }}">{{__('SMTP Settings')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['languages.index', 'languages.create', 'languages.store', 'languages.show', 'languages.edit'])}}">
                                    <a class="nav-link" href="{{route('languages.index')}}">{{__('Languages')}}</a></li>
                                    <li class="{{ areActiveRoutes(['generalsettings.index'])}}">
                                        <a class="nav-link" href="{{route('generalsettings.index')}}">{{__('General Settings')}}</a>
                                    </li>
                </ul>
            </li>
            @endif
            @if(Auth::user()->user_type == 'admin' || in_array('3', json_decode(Auth::user()->staff->role->permissions)))
            <li class="nav-item dropdown {{ areActiveRoutes(['staffs.index', 'staffs.create', 'staffs.edit','roles.index', 'roles.create', 'roles.edit'])}}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-user"></i>
                    <span>{{ __('Staffs') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ areActiveRoutes(['staffs.index', 'staffs.create', 'staffs.edit'])}}">
                        <a href="{{ route('staffs.index') }}">{{ __('All Staff') }}</a>
                    </li>
                    <li class="{{ areActiveRoutes(['roles.index', 'roles.create', 'roles.edit'])}}">
                        <a class="nav-link" href="{{route('roles.index')}}">{{__('Staff permissions')}}</a>
                    </li>
                </ul>
            </li>
            @endif
            <li class="{{ areActiveRoutes(['profile.index'])}}">
                <a class="nav-link"
                    href="{{ route('profile.index') }}"><i class="far fa-user"></i> <span>{{ __('My Account') }}</span></a>
            </li>
        </ul>
    </aside>
</div>
