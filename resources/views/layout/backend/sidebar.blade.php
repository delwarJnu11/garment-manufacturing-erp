<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <ul>
                        <li class="submenu">
                            <a href="" class="subdrop">
                                <i data-feather="grid"></i><span>Dashboard</span>
                            </a>
                        </li>
                        <!-- START USER Module Menu -->
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
                        <!-- START USER Module Menu -->
                        <!-- START Prodcution Module Menu -->
                        <li class="submenu">
                            <x-nav-link icon="settings" :active="request()->is('production*')">Production Management</x-nav-link>
                            <ul>
                                <!-- BOM MENU START -->
                                <li>
                                    <x-nav-link icon="list" :active="request()->is('bom*')">Bill Of Materials</x-nav-link>
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
                                    <x-nav-link icon="list" :active="request()->is('plans*')">Production Plan</x-nav-link>
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
                                    <x-nav-link icon="list" :active="request()->is('production-work*')">Production Work Order</x-nav-link>
                                    <ul style="margin-left: 20px;">
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

                            </ul>
                        </li>
                        <!-- END Prodcution Module Menu -->
                        <!--START 🔸 Order & Customers -->
                        <li class="submenu">
                            <x-nav-link :active="request()->is('orders*') ||
                                request()->is('buyers*') ||
                                request()->is('sales-invoice*')">Orders & Buyers</x-nav-link>
                            <ul>
                                <!-- 🔹 Orders -->
                                <li><x-link href="{{ url('/buyers') }}" :active="request()->is('buyers')">Buyers</x-link></li>

                                <li><x-link href="{{ url('/orders') }}" :active="request()->is('orders')">Orders</x-link></li>
                                <li><x-link href="{{ url('/orders/create') }}" :active="request()->is('orders/create')">Create
                                        Orders</x-link>
                                </li>
                                {{-- <li><x-link href="{{ url('/orders/pending') }}" :active="request()->is('orders/pending')">Pending
                                        Orders</x-link></li>
                                <li><x-link href="{{ url('/orders/running') }}" :active="request()->is('orders/running')">Running
                                        Orders</x-link></li>
                                <li><x-link href="{{ url('/orders/completed') }}" :active="request()->is('orders/completed')">Completed
                                        Orders</x-link></li> --}}
                                <li><x-link href="{{ route('order_status.index') }}" :active="request()->is('order_status.index')">Order
                                        Status</x-link></li>
                                <li><x-link href="{{ url('/sales-invoice') }}" :active="request()->is('sales-invoice')">Sales
                                        Invoices</x-link></li>
                                <li><x-link href="{{ route('colors.index') }}" :active="request()->is('colors')">Color Lists</x-link>
                                </li>
                                <li><x-link href="{{ route('sizes.index') }}" :active="request()->is('sizes')">Size Lists</x-link>
                                </li>
                                <li><x-link href="{{ route('fabric_types.index') }}" :active="request()->is('fabric_types')">Fabrics
                                        Types</x-link></li>

                                <!-- 🔹 Invoices & Payments -->

                                <li><x-link href="{{ url('/payments') }}" :active="request()->is('payments')">Payments</x-link></li>
                                <li><x-link href="{{ url('/refunds') }}" :active="request()->is('refunds')">Refunds</x-link></li>

                                <!-- 🔹 Sales Reports -->
                                <li><x-link href="{{ url('/reports/sales') }}" :active="request()->is('reports/sales')">Sales
                                        Reports</x-link></li>
                                <li><x-link href="{{ url('/reports/revenue') }}" :active="request()->is('reports/revenue')">Revenue
                                        Report</x-link></li>
                            </ul>
                        </li>
                        <!--END 🔸 Order & Customers -->

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

            // Toggle submenu on click
            $(".submenu > a").click(function() {
                $(this).toggleClass("active");
                $(this).next("ul").slideToggle();
                $(this).parent().toggleClass("active");
            });
        });
    </script>
@endsection
