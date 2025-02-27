<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Dashboards</h6>
                    <ul>
                        <li>
                            <a href="{{ url('/dashboard') }}"><i data-feather="grid"></i><span>Dashboard</span></a>

                        </li>
                    </ul>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="subdrop"><i
                                        data-feather="users"></i><span>User</span><span class="menu-arrow"></span></a>
                                <ul>
                                    <li>
                                        <x-link id="user-link" href="{{ route('users.index') }}">User Lists</x-link>
                                    </li>
                                    <li><a href=""class="">Account Dashboard</a></li>
                                </ul>
                            </li>
                        </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

