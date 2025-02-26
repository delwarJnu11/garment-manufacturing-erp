<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="subdrop">
                                <i data-feather="grid"></i><span>Dashboard</span>
                            </a>
                        </li>

                        <li class="submenu">
                            <x-nav-link :active="request()->is('users*')">User Management</x-nav-link>
                            <ul>
                                <li>
                                    <x-link href="{{ route('users.index') }}" :active="request()->is('users')">User Lists</x-link>
                                </li>
                                <li>
                                    <x-link href="{{ route('roles.index') }}" :active="request()->is('roles')">Roles Lists</x-link>
                                </li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <x-nav-link :active="request()->is('orders*') || request()->is('buyers*')">Orders & Buyers</x-nav-link>
                            <ul>
                                <li>
                                    <x-link href="{{ url('/buyers') }}" :active="request()->is('buyers')">Buyers</x-link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

@section('script')
    <script>
        $(document).ready(function() {
            var currentUrl = window.location.href;

            // Add active class to the current menu
            $(".sidebar-menu ul li a").each(function() {
                if (this.href === currentUrl) {
                    $(this).addClass("active");
                    $(this).closest("li.submenu").addClass("active"); // Open parent menu
                    $(this).closest("ul").slideDown();
                }
            });

            // Toggle submenu on click
            $(".submenu > a").click(function() {
                $(this).toggleClass("active");
                $(this).next("ul").slideToggle();
                $(this).parent().toggleClass("active");
            });
        });
    </script>
@endsection
