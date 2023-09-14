<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        @php
            $generalsetting = \App\Models\GeneralSetting::first();
        @endphp
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">{{ $generalsetting->site_name ?? env('APP_NAME') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">{{ $generalsetting->site_name[0] ?? env('APP_NAME')[0]}}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ areActiveRoutes(['dashboard'])}}">
                <a class="nav-link"
                    href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>{{ __('Dashboard') }}</span></a>
            </li>
            <li class="nav-item dropdown {{ areActiveRoutes(['user.categories','user.category.create','user.category.edit','user.expenses','user.expense.create','user.expense.edit'])}}">
                <a href="#"
                    class="nav-link has-dropdown"
                    data-toggle="dropdown"><i class="fas fa-money-bill"></i><span>{{ __('Expenses Manager') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ areActiveRoutes(['user.categories','user.category.create','user.category.edit'])}}">
                        <a class="nav-link"
                            href="{{ route('user.categories') }}">{{ __('Categories') }}</a>
                    </li>
                    <li class="{{ areActiveRoutes(['user.expenses','user.expense.create','user.expense.edit'])}}">
                        <a class="nav-link"
                            href="{{ route('user.expenses') }}">{{ __('Expenses') }}</a>
                    </li>
                </ul>
            </li>
            <li class="{{ areActiveRoutes(['profile'])}}">
                <a class="nav-link"
                    href="{{ route('profile') }}"><i class="fas fa-user"></i> <span>{{ __('My Account') }}</span></a>
            </li>
        </ul>
    </aside>
</div>
