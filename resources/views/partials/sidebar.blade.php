<div id="sidebar">
    <div class="logo">
        <a href="/"><img src="{{ asset('img/logo.png') }}" alt=""></a>
    </div>
    <ul class="menu">
        <li class="{{ (request()->is('/')) ? 'mm-active' : '' }}"><a href="{{ route('home') }}" class="has-arrow"><i
                    class="flaticon-381-networking"></i> <span class="navText">Dashboard</span></a></li>
        @can('user-management-side-menu')
            <li class="{{ (request()->is('users/list')) ? 'mm-active' : '' }}">
                <a href="{{ route('users.list') }}" class="has-arrow">
                    <i class="flaticon-381-notepad"></i>
                    <span class="navText">Users</span>
                </a>
{{--                <ul class="subMenu">--}}
{{--                    <li><a href="{{ route('users.list') }}">List</a></li>--}}
{{--                </ul>--}}
            </li>
        @endcan
        @canany(['role-list', 'role-create', 'role-edit', 'role-delete'])
            <li class="{{ (request()->is('roles*')) ? 'mm-active' : '' }}">
                <a href="{{ route('roles.index') }}" class="has-arrow">
                    <i class="flaticon-381-view"></i>
                    <span class="navText">Roles</span>
                </a>
{{--                <ul class="subMenu">--}}
{{--                    <li><a href="{{ route('roles.index') }}">List</a></li>--}}
{{--                </ul>--}}
            </li>
            <li class="{{ (request()->is('permission*')) ? 'mm-active' : '' }}">
                <a href="{{ route('permissions.index') }}" class="has-arrow">
                    <i class="flaticon-381-unlocked-4"></i>
                    <span class="navText">Permissions</span>
                </a>
{{--                <ul class="subMenu">--}}
{{--                    <li><a href="{{ route('permissions.index') }}">List</a></li>--}}
{{--                </ul>--}}
            </li>
        @endcanany
        @can('merchant-management')
            <li class="{{ (request()->is('users/client*')) ? 'mm-active' : '' }}">
                <a href="{{ route('client.list') }}" class="has-arrow">
                    <i class="flaticon-381-view"></i>
                    <span class="navText">Merchants</span>
                </a>
{{--                <ul class="subMenu">--}}
{{--                    <li><a href="{{ route('client.list') }}">List</a></li>--}}
{{--                </ul>--}}
            </li>
        @endcan

        <li><a href="#"><i class="flaticon-381-settings-2"></i> <span class="navText">Activity</span></a></li>
    </ul>
    <div class="footerNav">
        <p><b>CryptoMatix</b><br>© 2021 All Rights Reserved</p>
    </div>
</div>
