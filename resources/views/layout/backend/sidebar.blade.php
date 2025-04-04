<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <a href="{{ url('dashboard') }}" class="subdrop">
                        <i data-feather="grid"></i><span>Dashboard</span>
                    </a>
                    <ul>

                        <li class="submenu">
                            {{-- <a href="" class="subdrop"> --}}

                            {{-- <li class="submenu">
                            <x-nav-link :active="request()->is('users*')">User Management</x-nav-link>
                            <ul>
                                <li>
                                    <x-link href="{{ route('users.index') }}" :active="request()->is('users')">User Lists</x-link>
                                </li>
                                <li>
                                    <x-link href="{{ route('roles.index') }}" :active="request()->is('roles')">Roles Lists</x-link>
                                </li>
                            </ul>
                        </li> --}}

                            <!-- START Prodcution Module Menu -->
                        <li class="submenu">
                            <x-nav-link icon="settings" :active="request()->is('production*')">Production
                                Management</x-nav-link>
                            <ul>
                                <!-- BOM MENU START -->
                                <li>
                                    <x-nav-link icon="list" :active="request()->is('bom*')">Bill Of
                                        Materials</x-nav-link>
                                    <ul style="margin-left: 20px;">
                                        <li>
                                            <x-link href="{{ route('bom.index') }}">BOM Lists</x-link>
                                        </li>
                                        <li>
                                            <x-link>Cost Estimation</x-link>
                                        </li>
                                    </ul>
                                </li>
                                <!-- BOM MENU END -->
                                <li>
                                    <x-nav-link icon="list" :active="request()->is('plans*')">Production
                                        Plan</x-nav-link>
                                    <ul style="margin-left: 20px;">
                                        <li>
                                            <x-link href="{{ route('production-plans.index') }}"
                                                :active="request()->is('production-plan*')">Production Plans</x-link>
                                        </li>
                                        <li>
                                            <x-link href="{{ route('production_plan_status.index') }}"
                                                :active="request()->is('production_plan_status*')">Plan Status</x-link>
                                        </li>
                                    </ul>
                                </li>
                                {{-- Production Work Order Section  --}}
                                <li>
                                    <x-nav-link icon="list" :active="request()->is('production-work*')">Production Work
                                        Order</x-nav-link>
                                    <ul style="margin-left: 20px;">
                                        <li>
                                            <x-link href="{{ route('production-work-orders.index') }}"
                                                :active="request()->is('production-work-orders*')">Work Order List</x-link>
                                        </li>
                                        <li>
                                            <x-link href="{{ route('production-work-status.index') }}"
                                                :active="request()->is('production-work-status*')">Work Status</x-link>
                                        </li>
                                        <li>
                                            <x-link href="{{ route('production_work_sections.index') }}"
                                                :active="request()->is('production_work_sections*')">Production Sections</x-link>
                                        </li>
                                    </ul>
                                </li>
                                {{-- Production Floor Management Menu --}}
                                <li>
                                    <x-nav-link icon="list" :active="request()->is('production-stages*')">
                                        Production Stages
                                    </x-nav-link>
                                    <ul style="margin-left: 20px;">
                                        <li>
                                            <x-link href="{{ route('cutting.index') }}" :active="request()->is('production-stages/cutting')">
                                                Cutting Lists
                                            </x-link>
                                        </li>
                                        <li>
                                            <x-link href="{{ route('sweing.index') }}" :active="request()->is('production-stages/sweing')">
                                                Sweing Lists
                                            </x-link>
                                        </li>
                                        <li>
                                            <x-link href="{{ route('cutting.completed') }}" :active="request()->is('production-stages/completed')">
                                                Cutting Completed List
                                            </x-link>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </li>
                        <!-- END Prodcution Module Menu -->

                        <!--START 🔸 Order & Customers -->
                        <li class="submenu">

                            <x-nav-link :active="request()->is('orders*') ||
                                request()->is('buyers*') ||
                                request()->is('sales-invoice*') ||
                                request()->is('salesPayments*')|| request()->is('pending') ">Orders & Buyers</x-nav-link>



                            <ul>
                                <!-- 🔹 Orders -->
                                <li><x-link href="{{ url('/buyers') }}" :active="request()->is('buyers')">Buyers</x-link></li>
                                <li><x-link href="{{ url('/customers/groups') }}" :active="request()->is('customers/groups')">Customer
                                        Groups</x-link></li>
                                <li><x-link href="{{ url('/orders') }}" :active="request()->is('orders')">Orders</x-link></li>
                                <li><x-link href="{{ url('/orders/create') }}" :active="request()->is('orders/create')">Create
                                        Orders</x-link>
                                </li>
                                <li><x-link href="{{ url('/orders/pending') }}" :active="request()->is('orders/pending')">Pending
                                        Orders</x-link></li>
                                <li><x-link href="{{ url('/orders/running') }}" :active="request()->is('orders/running')">Running
                                        Orders</x-link></li>
                                <li><x-link href="{{ url('/orders/completed') }}" :active="request()->is('orders/completed')">Completed
                                        Orders</x-link></li>
                                <li><x-link href="{{ route('order_status.index') }}" :active="request()->is('order_status.index')">Order
                                        Status</x-link></li>

                                <li><x-link href="{{ url('/sales-invoice') }}" :active="request()->is('sales-invoice')">Sales
                                        Invoices</x-link></li>
                                <li><x-link href="{{ url('/pending') }}" :active="request()->is('pending')">Pending Invoice</x-link></li>
                                        {{-- <li><x-link href="{{url('/pending')}}" :active="request()->is('pending')"></x-link>Pending Invoice</li> --}}
                                <li><x-link href="{{ url('/salesPayments') }}" :active="request()->is('sales-payments')">Payments</x-link>
                                </li>
                                <li><x-link href="{{ route('colors.index') }}" :active="request()->is('colors')">Color Lists</x-link>

                                <li><x-link href="{{ route('colors.index') }}" :active="request()->is('colors')">Color
                                        Lists</x-link>

                                </li>
                                <li><x-link href="{{ route('sizes.index') }}" :active="request()->is('sizes')">Size
                                        Lists</x-link>
                                </li>
                                <li><x-link href="{{ route('fabric_types.index') }}" :active="request()->is('fabric_types')">Fabrics
                                        Types</x-link></li>

                                <!-- 🔹 Invoices & Payments -->
                                <li><x-link href="{{ url('/invoices') }}" :active="request()->is('invoices')">Invoices</x-link></li>
                                <li><x-link href="{{ url('/payments') }}" :active="request()->is('payments')">Payments</x-link></li>
                                <li><x-link href="{{ url('/refunds') }}" :active="request()->is('refunds')">Refunds</x-link></li>
                                {{-- Start Menu HR & Workforce Management --}}

                                {{-- End Menu HR & Workforce Management --}}
                            </ul>
                        </li>
                        {{-- Start HR & Workforce Management --}}

                        <li class="submenu">
                            <x-nav-link :active="request()->is('hrm*')">HR & Workforce</x-nav-link>
                            <ul>
                                {{-- @endif --}}

                                {{-- @if (Auth::user()->isAdmin()) --}}
                                <li class="submenu">
                                    <a href="javascript:void(0);">Department<span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><x-link href="{{ route('hrm_departments.index') }}"
                                                :active="request()->is('hrm_departments.index')">Department</x-link></li>
                                        <li><x-link href="{{ route('hrm_sub_departments.index') }}"
                                                :active="request()->is('hrm_sub_departments.index')">Sub
                                                Department</x-link></li>
                                    </ul>
                                </li>
                                <li class="submenu">
                                    <a href="javascript:void(0);">Designation<span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><x-link href="{{ route('hrm_designations.index') }}"
                                                :active="request()->is('hrm_designations.index')">Desigination List</x-link></li>
                                    </ul>
                                </li>


                                <li class="submenu">
                                    <a href="javascript:void(0);">Employee<span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><x-link href="{{ route('hrm_employees.index') }}"
                                                :active="request()->is('hrm_employees.index')">Employee
                                                List</x-link></li>
                                        <li><x-link href="{{ route('hrm_employee_bank_accounts.index') }}"
                                                :active="request()->is('hrm_employee_bank_accounts.index')">Employee Banc Account</x-link></li>
                                    </ul>
                                </li>

                                <li class="submenu">
                                    <a href="javascript:void(0);">Employee Performence<span
                                            class="menu-arrow"></span></a>
                                    <ul>
                                        <li><x-link href="{{ route('hrm_employee_performances.index') }}"
                                                :active="request()->is('hrm_employee_performances.index')">Performence List</x-link></li>
                                    </ul>
                                </li>

                                <li class="submenu">
                                    <a href="javascript:void(0);">Payroll<span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><x-link href="javascript:void(0);" :active="request()->is('javascript:void(0);')">Salary
                                                Advance</x-link>
                                        </li>
                                        <li><x-link href="{{ route('hrm_payslips.create') }}" :active="request()->is(route('hrm_payslips.create'))">Set
                                                Salary</x-link></li>
                                        <li><x-link href="{{ route('hrm_payslips.index') }}"
                                                :active="request()->is(route('hrm_payslips.index'))">Payslip</x-link></li>
                                    </ul>
                                </li>

                                <li class="submenu">
                                    <a href="javascript:void(0);">Award<span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><x-link href="javascript:void(0);" :active="request()->is('javascript:void(0);')">Award List</x-link>
                                        </li>
                                    </ul>
                                </li>
                                <li class="submenu">
                                    <a href="javascript:void(0);">Recruitment<span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><x-link href="javascript:void(0);" :active="request()->is('javascript:void(0);')">Candidate
                                                List</x-link>
                                        </li>
                                        <li><x-link href="javascript:void(0);" :active="request()->is('javascript:void(0);')">Interview</x-link>
                                        </li>
                                        <li><x-link href="javascript:void(0);" :active="request()->is('javascript:void(0);')">Candidate
                                                Selection</x-link></li>
                                    </ul>
                                </li>
                                <li class="submenu">
                                    <a href="javascript:void(0);">Report<span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><x-link href="javascript:void(0);" :active="request()->is('javascript:void(0);')">Attendance
                                                Report</x-link></li>
                                        <li><x-link href="javascript:void(0);" :active="request()->is('javascript:void(0);')">Leave Report</x-link>
                                        </li>
                                        <li><x-link href="javascript:void(0);" :active="request()->is('javascript:void(0);')">Employee
                                                Report</x-link>
                                        </li>
                                        <li><x-link href="javascript:void(0);" :active="request()->is('javascript:void(0);')">Payroll</x-link></li>
                                    </ul>
                                </li>
                                {{-- @endif --}}

                                {{-- @if (Auth::user()->isEmployee() || Auth::user()->isAdmin()) --}}
                                <li class="submenu">
                                    <a href="javascript:void(0);">Attendence<span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><x-link href="{{ route('hrm_attendance_list.index') }}"
                                                :active="request()->is('hrm_attendance_list.index')">Attendence List</x-link></li>
                                        <li><x-link href="javascript:void(0);" :active="request()->is('javascript:void(0);')">Attendence
                                                Details</x-link></li>
                                    </ul>
                                </li>

                                <li class="submenu">
                                    <a href="javascript:void(0);">Leave<span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><x-link href="javascript:void(0);" :active="request()->is('javascript:void(0);')">Holiday</x-link></li>
                                        <li><x-link href="{{ route('hrm_leave_types.index') }}"
                                                :active="request()->is('hrm_leave_types.index')">Leave
                                                Type</x-link></li>
                                        <li><x-link href="{{ route('hrm_leave_applications.index') }}"
                                                :active="request()->is('hrm_leave_applications.index')">Leave Application</x-link></li>
                                        <li><x-link href="javascript:void(0);" :active="request()->is('javascript:void(0);')">Leave
                                                Details</x-link>
                                        </li>
                                    </ul>
                                </li>
                                <li class="submenu">
                                    <a href="javascript:void(0);">Timesheet<span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><x-link href="{{ route('hrm_employee_timesheets.index') }}"
                                                :active="request()->is('hrm_employee_timesheets.index')">Timesheet</x-link></li>
                                    </ul>
                                </li>
                                <li class="submenu">
                                    <a href="javascript:void(0);">Notice Board<span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><x-link href="javascript:void(0);" :active="request()->is('javascript:void(0);')">Notice</x-link></li>
                                    </ul>
                                </li>
                                {{-- @endif --}}

                            </ul>
                        </li>

                        {{-- End HR & Workforce Management --}}
                        {{-- Start Inventory Module --}}
                        <li class="submenu">
                            <x-nav-link :active="request()->is('inventory*') ||
                                request()->is('stock/warehouse*') ||
                                request()->is('stock/category') ||
                                request()->is('stock/product_lots') ||
                                request()->is('stock/raw_materials') ||
                                request()->is('stock/productCatelogues') ||
                                request()->is('products') ||
                                request()->is('stock/stocks') ||
                                request()->is('stock/stock_adjustments')">Inventory & Warehouse</x-nav-link>
                            <ul>
                                <!-- 🔹 Categories -->
                                <li>
                                    <x-link href="{{ url('stock/category') }}" :active="request()->is('category')">Categories</x-link>
                                </li>
                                <li><x-link href="{{ url('stock/product_lots') }}" :active="request()->is('stock/product_lots')">Products
                                        Lot</x-link>
                                </li>
                                <li>
                                    <x-link href="{{ url('stock/raw_materials') }}" :active="request()->is('stock/raw_materials')">Raw
                                        Materials
                                    </x-link>
                                </li>
                                <li>
                                    <x-link href="{{ url('stock/productCatelogues') }}" :active="request()->is('stock/productCatelogues')">Product
                                        Catalogue
                                    </x-link>
                                </li>

                                <!-- 🔹 Warehouse & Stock -->
                                <li>
                                    <x-link href="{{ url('stock/products') }}" :active="request()->is('/stock/products')">All
                                        Products
                                    </x-link>
                                </li>
                                <li>
                                    <x-link href="{{ url('/stock/warehouses') }}" :active="request()->is('stock/warehouses')">Warehouses
                                    </x-link>
                                </li>

                                <!-- 🔹 Stock Management -->
                                <li>
                                    <x-link href="{{ url('/stock/stocks') }}" :active="request()->is('stock/stocks')">Stock Overview
                                    </x-link>
                                </li>
                                <li>
                                    <x-link href="{{ url('/stock/stock_adjustments') }}" :active="request()->is('stock/stock_adjustments')">Stock
                                        Adjustment
                                    </x-link>
                                </li>
                                <li>
                                    <x-link href="{{ url('/stock/stock-movements') }}" :active="request()->is('stock/stock-movements')">Stock
                                        movements
                                    </x-link>
                                </li>

                                <!-- 🔹 Inventory Valuation -->
                                <li class="submenu">
                                    <a href="">Inventory Valuation <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li>
                                            <x-link href="{{ url('/inventory/valuation/fifo') }}"
                                                :active="request()->is('inventory/valuation/fifo')">FIFO</x-link>
                                        </li>

                                    </ul>
                                </li>

                                <!-- 🔹 Reports -->
                                <li>
                                    <x-link href="{{ url('/inventory/reports') }}" :active="request()->is('inventory/reports')">Inventory
                                        Reports</x-link>
                                </li>
                            </ul>
                        </li>
                        {{-- End Inventory Module --}}
                        <!-- 🔸 Suppliers & Purchase -->
                        <li class="submenu">
                            <x-nav-link :active="request()->is('suppliers*') ||
                                request()->is('purchase*') ||
                                request()->is('payments/suppliers') ||
                                request()->is('purchase/create') ||
                                request()->is('purchaseState') ||
                                request()->is('purchase-report') ||
                                request()->is('payments')">Suppliers & Purchases</x-nav-link>
                            <ul>
                                <li>
                                    <x-link href="{{ url('/suppliers') }}" :active="request()->is('suppliers')">Suppliers</x-link>
                                </li>
                                <li>
                                    <x-link href="{{ route('purchase.create') }}" :active="request()->is('/purchase/create')">Create Purchase
                                    </x-link>
                                </li>
                                <li><x-link href="{{ url('/purchaseState') }}" :active="request()->is('payments/suppliers')">Pending Purchase
                                    </x-link></li>
                                <li>
                                    <x-link href="{{ url('/purchase') }}" :active="request()->is('purchase')">Confirm Purchase</x-link>
                                </li>
                                {{-- <li><x-link href="{{ url('/payments/suppliers') }}" :active="request()->is('payments/suppliers')">Payments</x-link></li> --}}
                                <li><x-link href="{{ url('purchase-report') }}" :active="request()->is('purchase-report')">Purchase
                                        Reports</x-link></li>
                                <li><x-link href="{{ url('payments') }}" :active="request()->is('payments')">Payments</x-link></li>
                            </ul>
                        </li>
                        <!-- END 🔸 Suppliers & Purchase -->
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

            Toggle submenu on click
            $(".submenu > a").click(function() {
                $(this).toggleClass("active");
                $(this).next("ul").slideToggle();
                $(this).parent().toggleClass("active");
            });
        });
    </script>
@endsection
