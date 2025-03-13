<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Dashboards</h6>
                    <ul>
                        <!-- Dashboard -->
                        <li class="submenu {{ request()->is('admin-dashboard') || request()->is('account-dashboard') ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="subdrop">
                                <i data-feather="grid"></i><span>Dashboard</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ url('admin-dashboard') }}" class="{{ request()->is('admin-dashboard') ? 'active' : '' }}">Admin Dashboard</a></li>
                                <li><a href="{{ url('account-dashboard') }}" class="{{ request()->is('account-dashboard') ? 'active' : '' }}">Account Dashboard</a></li>
                            </ul>
                        </li>

                        <!-- User Management -->
                        <li class="submenu {{ request()->routeIs('users*') || request()->routeIs('roles*') ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="subdrop">
                                <i data-feather="users"></i><span>User Management</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}">All Users</a></li>
                                <li><a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.index') ? 'active' : '' }}">All Roles</a></li>
                            </ul>
                        </li>

                        <!-- Production -->
                        <li class="submenu {{ request()->is('production*') ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="subdrop">
                                <i data-feather="layers"></i><span>Production</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="javascript:void(0);" class="subdrop {{ request()->is('production/boms*') ? 'active' : '' }}">
                                        <i data-feather="file-text"></i><span>Bill Of Materials</span><span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li><a href="#" class="">BOM's Product</a></li>
                                        <li><a href="#" class="">Cost Estimation</a></li>
                                        <li><a href="#" class="">Production Planning</a></li>
                                        <li><a href="{{ route('production_plan_status.index') }}" class="{{ request()->routeIs('production_plan_status.index') ? 'active' : '' }}">Production Planning Status</a></li>
                                        <li><a href="#" class="">Production Planning Section</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- Orders & Customers -->
                        <li class="submenu {{ request()->is('orders*') || request()->is('customers*') ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="subdrop">
                                <i data-feather="shopping-cart"></i><span>Orders & Customers</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ url('/buyers') }}" class="{{ request()->is('buyers') ? 'active' : '' }}">Buyers</a></li>
                                <li><a href="{{ url('/customers/groups') }}" class="{{ request()->is('customers/groups') ? 'active' : '' }}">Customer Groups</a></li>
                                <li><a href="{{ url('/orders') }}" class="{{ request()->is('orders') ? 'active' : '' }}">Orders</a></li>
                                <li><a href="{{ url('/orders/create') }}" class="{{ request()->is('orders/create') ? 'active' : '' }}">Create Orders</a></li>
                                <li><a href="{{ url('/orders/pending') }}" class="{{ request()->is('orders/pending') ? 'active' : '' }}">Pending Orders</a></li>
                                <li><a href="{{ url('/orders/completed') }}" class="{{ request()->is('orders/completed') ? 'active' : '' }}">Completed Orders</a></li>
                            </ul>
                        </li>

                        <!-- Inventory & Warehouse -->
                        <li class="submenu {{ request()->is('inventory*') || request()->is('warehouses*') ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="subdrop">
                                <i data-feather="box"></i><span>Inventory & Warehouse</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ url('/category') }}" class="{{ request()->is('category') ? 'active' : '' }}">Categories</a></li>
                                <li><a href="{{ url('/products') }}" class="{{ request()->is('products') ? 'active' : '' }}">Product Catalogue</a></li>
                                <li><a href="{{ url('/warehouses') }}" class="{{ request()->is('warehouses') ? 'active' : '' }}">Warehouses</a></li>
                                <li><a href="{{ url('/stock-movements') }}" class="{{ request()->is('stock-movements') ? 'active' : '' }}">Stock Movements</a></li>
                            </ul>
                        </li>

                        <!-- Purchases & Suppliers -->
                        <li class="submenu {{ request()->is('suppliers*') || request()->is('purchases*') ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="subdrop">
                                <i data-feather="truck"></i><span>Purchases & Suppliers</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ url('/suppliers') }}" class="{{ request()->is('suppliers') ? 'active' : '' }}">Suppliers</a></li>
                                <li><a href="{{ url('/purchases') }}" class="{{ request()->is('purchases') ? 'active' : '' }}">Purchase Orders</a></li>
                                <li><a href="{{ url('/payments/suppliers') }}" class="{{ request()->is('payments/suppliers') ? 'active' : '' }}">Payments</a></li>
                                <li><a href="{{ url('/reports/purchases') }}" class="{{ request()->is('reports/purchases') ? 'active' : '' }}">Purchase Reports</a></li>
                            </ul>
                        </li>

                        <!--END 🔸 Suppliers & Purchase -->

                        {{-- Start HR & Workforce Management --}}

                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="file-minus"></i><span>HR &
                                    Workforce</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Department<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Department</a></li>
                                        <li><a href="javascript:void(0);">Sub Department</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Employee<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Position</a></li>
                                        <li><a href="javascript:void(0);">Employee</a></li>
                                        <li><a href="javascript:void(0);">Employee Performance</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Attendance<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Attendance Form</a></li>
                                        <li><a href="javascript:void(0);">Attendance List</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Leave<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li class="submenu submenu-two submenu-three">
                                            <a href="javascript:void(0);">Leave<span
                                                    class="menu-arrow inside-submenu inside-submenu-two"></span></a>
                                            <ul>
                                                <li><a href="javascript:void(0);">Leave Type</a></li>
                                                <li><a href="javascript:void(0);">Leave Approval</a></li>
                                                <li><a href="javascript:void(0);">Leave Application</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="javascript:void(0);">Holiday</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Payroll<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Salary Advance</a></li>
                                        <li><a href="javascript:void(0);">Set Salary</a></li>
                                        <li><a href="javascript:void(0);">Payslip</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Notice Board<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Notice</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Recruitment<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Candidate List</a></li>
                                        <li><a href="javascript:void(0);">Interview</a></li>
                                        <li><a href="javascript:void(0);">Candidate Selection</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Procurement<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Request</a></li>
                                        <li><a href="javascript:void(0);">Quotation</a></li>
                                        <li><a href="javascript:void(0);">Bid analysis</a></li>
                                        <li><a href="javascript:void(0);">Purchase Order</a></li>
                                        <li><a href="javascript:void(0);">Goods Received</a></li>
                                        <li><a href="javascript:void(0);">Vendors</a></li>
                                        <li><a href="javascript:void(0);">Commitees</a></li>
                                        <li><a href="javascript:void(0);">Units</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Award<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Award List</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Reports<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Attendance Report</a></li>
                                        <li><a href="javascript:void(0);">Leave Report</a></li>
                                        <li><a href="javascript:void(0);">Employee Report</a></li>
                                        <li><a href="javascript:void(0);">Payroll</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        {{-- End HR & Workforce Management --}}


                        {{-- FINANCE & ACCOUNTS MODULE MENU START --}}
                        <li class="submenu"><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="20" height="20" fill="currentColor" class="bi bi-cash-coin"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                                    <path
                                        d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                                    <path
                                        d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                                </svg><span>Finance &
                                    Accounts</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li class="submenu submenu-two"><a href="">General Ledger<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Chart of Accounts</a></li>
                                        <li><a href="">Journal Entries</a>
                                        </li>
                                        <li><a href="">Trial Balance</a></li>
                                        <li><a href="">Account Reconciliation</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Accounts Payable<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Suppliers</a></li>
                                        <li><a href="">Invoices</a></li>
                                        <li><a href="">Payments</a></li>
                                        <li><a href="">Aging Reports</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Accounts Receivable<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Customers</a></li>
                                        <li><a href="">Invoices</a></li>
                                        <li><a href="">Receipts</a></li>
                                        <li><a href="">Customer Statement</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Cash & Bank Management<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Bank Accounts</a></li>
                                        <li><a href="">Bank Reconciliation</a></li>
                                        <li><a href="">Cash Flow</a></li>
                                        <li><a href="">Petty Cash Management</a></li>
                                        <li><a href="">Bank Transfers</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Inventory Valuation and Costing<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Inventory Overview</a></li>
                                        <li><a href="">Costing Methods</a></li>
                                        <li><a href="">Cost of Goods Manufactured</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Payroll & Employee Costing<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Employee Records</a></li>
                                        <li><a href="">Payroll</a></li>
                                        <li><a href="">Deductions</a></li>
                                        <li><a href="">Overtime & Bonuses</a></li>
                                        <li><a href="">Employee Benefits Management</a></li>
                                        <li><a href="">Payslips & Reporting</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Budgeting & Forecasting<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Budget Creation</a></li>
                                        <li><a href="">Forecasting</a></li>
                                        <li><a href="">Variance Analysis</a></li>
                                        <li><a href="">Cash Flow Projections</a></li>
                                    </ul>
                                </li>

                                <li class="submenu submenu-two"><a href="javascript:void(0);">Financial Reporting<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Balance Sheet</a></li>
                                        <li><a href="">Profit & Loss Statement</a></li>
                                        <li><a href="">Cash Flow Statement</a></li>
                                        <li><a href="">Tax Reports</a></li>
                                        <li><a href="">Custom Report</a></li>
                                        <li><a href="">Consolidated Financial Reports</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Fixed Asset Maangement<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Asset Register</a></li>
                                        <li><a href="">Depreciation</a></li>
                                        <li><a href="">Asset Disposal</a></li>
                                        <li><a href="">Asset Reports</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Taxation Management<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Tax Setup</a></li>
                                        <li><a href="">Tax Calculations</a></li>
                                        <li><a href="">Tax Filing Reports</a></li>
                                        <li><a href="">Tax Deduction at Source</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        {{-- FINANCE & ACCOUNTS MODULE MENU END --}}


                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>




<!-- </li>
            </ul>
            </li>
        </div>
    </div>
</div> -->

<script>
    $(document).ready(function() {
        var currentUrl = window.location.href;

        $(".sidebar-menu ul li a").each(function() {
            if (this.href === currentUrl) {
                $(this).addClass("active");

                $(this).closest("li.submenu").addClass("active");
                $(this).closest("ul").slideDown();

                $(this).parents("li.submenu").each(function() {
                    $(this).addClass("active");
                    $(this).children("a").addClass("active");
                    $(this).children("ul").slideDown();
                });
            }
        });

        $(".submenu > a").click(function() {
            var $submenu = $(this).next("ul");

            if ($submenu.is(":visible")) {
                $submenu.slideUp();
                $(this).removeClass("active");
                $(this).parent().removeClass("active");
            } else {
                $(this).parent().siblings(".submenu").children("ul").slideUp();
                $(this).parent().siblings(".submenu").removeClass("active").children("a").removeClass("active");

                $submenu.slideDown();
                $(this).addClass("active");
                $(this).parent().addClass("active");
            }
        });
    });
</script>

{{-- old sidebar --}}
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Dashboards</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="subdrop"><i
                                    data-feather="grid"></i><span>Dashboard</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="https://dreamspos.dreamstechnologies.com/html/template/index.html"
                                        class="active">Admin Dashboard</a></li>
                                <li><a href="https://dreamspos.dreamstechnologies.com/html/template/index.html"
                                        class="">Account Dashboard</a></li>
                            </ul>
                        </li>
                        {{-- USER MODULE MENU START --}}
                        <!-- <li class="submenu">
                            <a href="javascript:void(0);">
                                <i data-feather="users"></i>
                                <span>Users</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ route('users.index') }}" class="{{ request()->is('users') ? 'active' : '' }}">All Users</a></li>
                                <li><a href="{{ route('roles.index') }}" class="{{ request()->is('roles') ? 'active' : '' }}">All Roles</a></li>
                            </ul>
                </li> -->

                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="subdrop {{ request()->routeIs('users') || request()->routeIs('roles') ? 'active' : '' }}"><i
                                    data-feather="users"></i><span>User Management</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li>
                                    <a href="{{ route('users.index') }}"
                                        class="{{ request()->routeIs('users') ? 'active' : '' }}">All Users</a>
                                </li>
                                <li>
                                    <a href="{{ route('roles.index') }}"
                                        class="{{ request()->routeIs('roles') ? 'active' : '' }}">All Roles</a>
                                </li>
                            </ul>
                        </li>

                        {{-- USER MODULE MENU END --}}
                        {{-- PRODUCTION MODULE MENU START --}}
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="subdrop {{ request()->routeIs('production') ? 'active' : '' }}"><i
                                    data-feather="users"></i><span>Production Management</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="subdrop {{ request()->routeIs('production') ? 'active' : '' }}"><i
                                            data-feather="users"></i><span>Bill Of Materials</span><span
                                            class="menu-arrow"></span></a>
                                    <ul>
                                        <li>
                                            <a href="" class="">BOM's Product</a>
                                        </li>
                                        <li>
                                            <a href="" class="">Cost Estimation</a>
                                        </li>
                                        <li>
                                            <a href="" class="">Production Planning</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('production_plan_status.index') }}"
                                                class="{{ request()->is('production_plan_status.index') ? 'active' : '' }}">Production
                                                Planning Status</a>
                                        </li>
                                        <li>
                                            <a href="" class="">Production Planning Section</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('roles.index') }}"
                                        class="{{ request()->routeIs('roles') ? 'active' : '' }}">All Roles</a>
                                </li>
                            </ul>
                        </li>
                        {{-- PRODUCTION MODULE MENU END --}}
                        <!-- 🔸 Order & Customers -->
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i data-feather="shopping-cart"></i>
                                <span>Orders & Customers</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <!-- 🔹 Orders -->
                                <li><a href="{{ url('/buyers') }}">Buyers</a></li>
                                <li>
                                    <a href="{{ url('/customers/groups') }}">Customer Groups</a>
                                </li>
                                <li><a href="{{ url('/orders') }}">Orders</a></li>
                                <li><a href="{{ url('/orders/pending') }}">Pending Orders</a></li>
                                <li><a href="{{ url('/orders/pending') }}">Running Orders</a></li>
                                <li><a href="{{ url('/orders/completed') }}">Completed Orders</a></li>
                                <li><a href="{{ route('order_status.index') }}">Order Status</a></li>
                                <li><a href="{{ route('colors.index') }}">Color Lists</a></li>
                                <li><a href="{{ route('sizes.index') }}">Size Lists</a></li>
                                <li><a href="{{ route('fabric_types.index') }}">Fabrics Types</a></li>

                                <!-- 🔹 Customers -->


                                <!-- 🔹 Invoices & Payments -->
                                <li><a href="{{ url('/invoices') }}">Invoices</a></li>
                                <li><a href="{{ url('/payments') }}">Payments</a></li>
                                <li><a href="{{ url('/refunds') }}">Refunds</a></li>

                                <!-- 🔹 Sales Reports -->
                                <li><a href="{{ url('/reports/sales') }}">Sales Reports</a></li>
                                <li><a href="{{ url('/reports/revenue') }}">Revenue Report</a></li>
                            </ul>
                        </li>
                        {{-- End Sales Module --}}

                        {{-- Start Inventory Module --}}
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i data-feather="shopping-bag"></i>
                                <span>Inventory & Warehouse</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <!-- 🔹 Categories -->
                                <li><a href="{{ url('/category') }}">Categories</a></li>
                                <li><a href="{{ url('/product_lots') }}">Products Lot</a></li>
                                <li>
                                    <a href="{{ url('/raw_materials') }}">Raw Materials</a>
                                </li>
                                <li>
                                    <a href="{{ url('/products') }}">Product Catelogue</a>
                                </li>
                                <!-- 🔹 Warehouse & Stock -->
                                <li><a href="{{ url('/warehouses') }}">Warehouses</a></li>
                                <li><a href="{{ url('/storage-locations') }}">Storage Locations</a></li>
                                <li><a href="{{ url('/stock-movements') }}">Stock Movements</a></li>


                                <!-- 🔹 Stock Management -->
                                <li>
                                    <a href="{{ url('/products') }}">Stock Overview</a>
                                </li>


                                <li><a href="{{ url('/products/variants') }}">Finished Goods</a></li>
                                <li><a href="{{ url('/products/barcode') }}">Print Barcode & QR</a></li>

                                <!-- 🔹 Inventory Valuation -->
                                <li class="submenu">
                                    <a href="javascript:void(0);">Inventory Valuation <span
                                            class="menu-arrow"></span></a>
                                    <ul>
                                        <li><a href="{{ url('/inventory/valuation/fifo') }}">FIFO</a></li>
                                        <li><a href="{{ url('/inventory/valuation/lifo') }}">LIFO</a></li>
                                        <li><a href="{{ url('/inventory/valuation/weighted') }}">Weighted Avg</a></li>
                                    </ul>
                                </li>

                                <!-- 🔹 Reports -->
                                <li><a href="{{ url('/inventory/reports') }}">Inventory Reports</a></li>
                            </ul>
                        </li>

                        <!-- 🔸 Suppliers & Purchase -->
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i data-feather="truck"></i>
                                <span>Suppliers & Purchases</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="{{ url('/suppliers') }}">Suppliers</a></li>
                                <li><a href="{{ url('/purchases') }}">Purchase Orders</a></li>
                                <li><a href="{{ url('/payments/suppliers') }}">Payments</a></li>
                                <li><a href="{{ url('/reports/purchases') }}">Purchase Reports</a></li>
                            </ul>
                        </li>

                        <!--END 🔸 Suppliers & Purchase -->

                        {{-- Start HR & Workforce Management --}}

                        <li class="submenu">
                            <a href="javascript:void(0);"><i data-feather="file-minus"></i><span>HR &
                                    Workforce</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Department<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Department</a></li>
                                        <li><a href="javascript:void(0);">Sub Department</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Employee<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Position</a></li>
                                        <li><a href="javascript:void(0);">Employee</a></li>
                                        <li><a href="javascript:void(0);">Employee Performance</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Attendance<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Attendance Form</a></li>
                                        <li><a href="javascript:void(0);">Attendance List</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Leave<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li class="submenu submenu-two submenu-three">
                                            <a href="javascript:void(0);">Leave<span
                                                    class="menu-arrow inside-submenu inside-submenu-two"></span></a>
                                            <ul>
                                                <li><a href="javascript:void(0);">Leave Type</a></li>
                                                <li><a href="javascript:void(0);">Leave Approval</a></li>
                                                <li><a href="javascript:void(0);">Leave Application</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="javascript:void(0);">Holiday</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Payroll<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Salary Advance</a></li>
                                        <li><a href="javascript:void(0);">Set Salary</a></li>
                                        <li><a href="javascript:void(0);">Payslip</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Notice Board<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Notice</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Recruitment<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Candidate List</a></li>
                                        <li><a href="javascript:void(0);">Interview</a></li>
                                        <li><a href="javascript:void(0);">Candidate Selection</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Procurement<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Request</a></li>
                                        <li><a href="javascript:void(0);">Quotation</a></li>
                                        <li><a href="javascript:void(0);">Bid analysis</a></li>
                                        <li><a href="javascript:void(0);">Purchase Order</a></li>
                                        <li><a href="javascript:void(0);">Goods Received</a></li>
                                        <li><a href="javascript:void(0);">Vendors</a></li>
                                        <li><a href="javascript:void(0);">Commitees</a></li>
                                        <li><a href="javascript:void(0);">Units</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Award<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Award List</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Reports<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Attendance Report</a></li>
                                        <li><a href="javascript:void(0);">Leave Report</a></li>
                                        <li><a href="javascript:void(0);">Employee Report</a></li>
                                        <li><a href="javascript:void(0);">Payroll</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        {{-- End HR & Workforce Management --}}


                        {{-- FINANCE & ACCOUNTS MODULE MENU START --}}
                        <li class="submenu"><a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="20" height="20" fill="currentColor" class="bi bi-cash-coin"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                                    <path
                                        d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                                    <path
                                        d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                                </svg><span>Finance &
                                    Accounts</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li class="submenu submenu-two"><a href="">General Ledger<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Chart of Accounts</a></li>
                                        <li><a href="">Journal Entries</a>
                                        </li>
                                        <li><a href="">Trial Balance</a></li>
                                        <li><a href="">Account Reconciliation</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Accounts Payable<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Suppliers</a></li>
                                        <li><a href="">Invoices</a></li>
                                        <li><a href="">Payments</a></li>
                                        <li><a href="">Aging Reports</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Accounts Receivable<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Customers</a></li>
                                        <li><a href="">Invoices</a></li>
                                        <li><a href="">Receipts</a></li>
                                        <li><a href="">Customer Statement</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Cash & Bank Management<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Bank Accounts</a></li>
                                        <li><a href="">Bank Reconciliation</a></li>
                                        <li><a href="">Cash Flow</a></li>
                                        <li><a href="">Petty Cash Management</a></li>
                                        <li><a href="">Bank Transfers</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Inventory Valuation and Costing<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Inventory Overview</a></li>
                                        <li><a href="">Costing Methods</a></li>
                                        <li><a href="">Cost of Goods Manufactured</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Payroll & Employee Costing<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Employee Records</a></li>
                                        <li><a href="">Payroll</a></li>
                                        <li><a href="">Deductions</a></li>
                                        <li><a href="">Overtime & Bonuses</a></li>
                                        <li><a href="">Employee Benefits Management</a></li>
                                        <li><a href="">Payslips & Reporting</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Budgeting & Forecasting<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Budget Creation</a></li>
                                        <li><a href="">Forecasting</a></li>
                                        <li><a href="">Variance Analysis</a></li>
                                        <li><a href="">Cash Flow Projections</a></li>
                                    </ul>
                                </li>

                                <li class="submenu submenu-two"><a href="javascript:void(0);">Financial Reporting<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Balance Sheet</a></li>
                                        <li><a href="">Profit & Loss Statement</a></li>
                                        <li><a href="">Cash Flow Statement</a></li>
                                        <li><a href="">Tax Reports</a></li>
                                        <li><a href="">Custom Report</a></li>
                                        <li><a href="">Consolidated Financial Reports</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Fixed Asset Maangement<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Asset Register</a></li>
                                        <li><a href="">Depreciation</a></li>
                                        <li><a href="">Asset Disposal</a></li>
                                        <li><a href="">Asset Reports</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two"><a href="">Taxation Management<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="">Tax Setup</a></li>
                                        <li><a href="">Tax Calculations</a></li>
                                        <li><a href="">Tax Filing Reports</a></li>
                                        <li><a href="">Tax Deduction at Source</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        {{-- FINANCE & ACCOUNTS MODULE MENU END --}}


                </li>
            </ul>
            </li>
        </div>
    </div>
</div>







<!-- <div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <ul>
                        @if (Auth::user()->isEmployee())
                            <li>
                                <a href="{{url('home')}}" class="subdrop">
                                    <i data-feather="grid"></i><span>Dashboard</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->isAdmin())
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
                            <!--START 🔸 Order & Customers -->
                            <!-- <li class="submenu">
                                <x-nav-link :active="request()->is('orders*') || request()->is('buyers*')">Orders & Buyers</x-nav-link>
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

                                    <!-- 🔹 Sales Reports -->
                                    <li><x-link href="{{ url('/reports/sales') }}" :active="request()->is('reports/sales')">Sales
                                            Reports</x-link></li>
                                    <li><x-link href="{{ url('/reports/revenue') }}" :active="request()->is('reports/revenue')">Revenue
                                            Report</x-link></li>
                                </ul>
                            </li> -->
                            <!--END 🔸 Order & Customers -->

                            {{-- Start Inventory Module --}}
                            <li class="submenu">
                                <x-nav-link :active="request()->is('inventory*')">Inventory & Warehouse</x-nav-link>
                                <ul>
                                    <!-- 🔹 Categories -->
                                    <li><x-link href="{{ url('/category') }}" :active="request()->is('category')">Categories</x-link>
                                    </li>
                                    <li><x-link href="{{ url('/product_lots') }}" :active="request()->is('product_lots')">Products
                                            Lot</x-link>
                                    </li>
                                    <li><x-link href="{{ url('/raw_materials') }}" :active="request()->is('raw_materials')">Raw
                                            Materials</x-link></li>
                                    <li><x-link href="{{ url('/products') }}" :active="request()->is('products')">Product
                                            Catalogue</x-link>
                                    </li>

                                    <!-- 🔹 Warehouse & Stock -->
                                    <li><x-link href="{{ url('/warehouses') }}" :active="request()->is('warehouses')">Warehouses</x-link>
                                    </li>
                                    <li><x-link href="{{ url('/storage-locations') }}" :active="request()->is('storage-locations')">Storage
                                            Locations</x-link></li>
                                    <li><x-link href="{{ url('/stock-movements') }}" :active="request()->is('stock-movements')">Stock
                                            Movements</x-link></li>

                                    <!-- 🔹 Stock Management -->
                                    <li><x-link href="{{ url('/stocks') }}" :active="request()->is('stocks')">Stock Overview</x-link>
                                    </li>
                                    <li><x-link href="{{ url('/products/variants') }}" :active="request()->is('products/variants')">Finished
                                            Goods</x-link></li>
                                    <li><x-link href="{{ url('/products/barcode') }}" :active="request()->is('products/barcode')">Print Barcode
                                            &
                                            QR</x-link></li>

                                    <!-- 🔹 Inventory Valuation -->
                                    <li class="submenu">
                                        <a href="javascript:void(0);">Inventory Valuation <span
                                                class="menu-arrow"></span></a>
                                        <ul>
                                            <li><x-link href="{{ url('/inventory/valuation/fifo') }}"
                                                    :active="request()->is('inventory/valuation/fifo')">FIFO</x-link></li>
                                            <li><x-link href="{{ url('/inventory/valuation/lifo') }}"
                                                    :active="request()->is('inventory/valuation/lifo')">LIFO</x-link></li>
                                            <li><x-link href="{{ url('/inventory/valuation/weighted') }}"
                                                    :active="request()->is('inventory/valuation/weighted')">Weighted Avg</x-link></li>
                                        </ul>
                                    </li>

                                    <!-- 🔹 Reports -->
                                    <li><x-link href="{{ url('/inventory/reports') }}" :active="request()->is('inventory/reports')">Inventory
                                            Reports</x-link></li>
                                </ul>
                            </li>
                            {{-- End Inventory Module --}}


                            <!-- 🔸 Suppliers & Purchase -->
                            <li class="submenu">
                                <x-nav-link :active="request()->is('suppliers*') ||
                                    request()->is('purchases*') ||
                                    request()->is('payments/suppliers') ||
                                    request()->is('reports/purchases')">Suppliers & Purchases</x-nav-link>
                                <ul>
                                    <li><x-link href="{{ url('/suppliers') }}" :active="request()->is('suppliers')">Suppliers</x-link>
                                    </li>
                                    <li><x-link href="{{ url('/purchases') }}" :active="request()->is('purchases')">Purchase
                                            Orders</x-link>
                                    </li>
                                    <li><x-link href="{{ url('/payments/suppliers') }}"
                                            :active="request()->is('payments/suppliers')">Payments</x-link></li>
                                    <li><x-link href="{{ url('/reports/purchases') }}" :active="request()->is('reports/purchases')">Purchase
                                            Reports</x-link></li>
                                </ul>
                            </li>
                             <!-- END 🔸 Suppliers & Purchase -->

                        {{-- Start Menu HR & Workforce Management --}}
                        <li class="submenu">
                            <x-nav-link :active="request()->is('hrm*')">HR & Workforce</x-nav-link>
                            <ul>
                        @endif

                                @if (Auth::user()->isAdmin())
                                    <li class="submenu">
                                        <a href="javascript:void(0);">Department<span class="menu-arrow"></span></a>
                                        <ul>
                                            <li><x-link href="{{ route('hrm_departments.index') }}"
                                                    :active="request()->is('hrm_departments.index')">Department</x-link></li>
                                            <li><x-link href="{{ route('hrm_sub_departments.index') }}"
                                                    :active="request()->is('hrm_sub_departments.index')">Sub Department</x-link></li>
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
                                                    :active="request()->is('hrm_employees.index')">Employee List</x-link></li>
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
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Salary Advance</x-link></li>
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Set Salary</x-link></li>
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Payslip</x-link></li>
                                        </ul>
                                    </li>

                                    <li class="submenu">
                                        <a href="javascript:void(0);">Award<span class="menu-arrow"></span></a>
                                        <ul>
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Award List</x-link></li>
                                        </ul>
                                    </li>
                                    <li class="submenu">
                                        <a href="javascript:void(0);">Recruitment<span class="menu-arrow"></span></a>
                                        <ul>
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Candidate List</x-link></li>
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Interview</x-link></li>
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Candidate Selection</x-link></li>
                                        </ul>
                                    </li>
                                    <li class="submenu">
                                        <a href="javascript:void(0);">Report<span class="menu-arrow"></span></a>
                                        <ul>
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Attendance Report</x-link></li>
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Leave Report</x-link></li>
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Employee Report</x-link></li>
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Payroll</x-link></li>
                                        </ul>
                                    </li>
                                @endif

                                @if (Auth::user()->isEmployee() || Auth::user()->isAdmin())
                                    <li class="submenu">
                                        <a href="javascript:void(0);">Attendence<span class="menu-arrow"></span></a>
                                        <ul>
                                            <li><x-link href="{{ route('hrm_attendance_list.index') }}"
                                                    :active="request()->is('hrm_attendance_list.index')">Attendence List</x-link></li>
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Attendence Details</x-link></li>
                                        </ul>
                                    </li>

                                    <li class="submenu">
                                        <a href="javascript:void(0);">Leave<span class="menu-arrow"></span></a>
                                        <ul>
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Holiday</x-link></li>
                                            <li><x-link href="{{ route('hrm_leave_types.index') }}"
                                                    :active="request()->is('hrm_leave_types.index')">Leave Type</x-link></li>
                                            <li><x-link href="{{ route('hrm_leave_applications.index') }}"
                                                    :active="request()->is('hrm_leave_applications.index')">Leave Application</x-link></li>
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Leave Details</x-link></li>
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
                                            <li><x-link href="javascript:void(0);"
                                                    :active="request()->is('javascript:void(0);')">Notice</x-link></li>
                                        </ul>
                                    </li>
                                @endif

                            </ul>
                        </li>
                        {{-- End Menu HR & Workforce Management --}}



                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div> -->
<!--
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
@endsection -->
