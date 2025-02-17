<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="subdrop active"><i
                                    data-feather="grid"></i><span>Dashboard</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="https://dreamspos.dreamstechnologies.com/html/template/index.html"
                                        class="active">Admin Dashboard</a></li>
                                <li><a href="https://dreamspos.dreamstechnologies.com/html/template/index.html"
                                        class="">Account Dashboard</a></li>
                            </ul>
                        </li>
                        {{-- USER MODULE MENU START --}}
                        <li class="submenu"><a href="javascript:void(0);"><i
                                    data-feather="users"></i><span>Users</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('users.index') }}">All User</a></li>
                                <li><a href="{{ route('roles.index') }}">All Roles</a></li>
                            </ul>
                        </li>
                        {{-- USER MODULE MENU END --}}
                        {{-- PRODUCTION MODULE MENU START --}}
                        <li class="submenu">
                            <a href="javascript:void(0);" class="subdrop"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-file-minus">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="9" y1="15" x2="15" y2="15"></line>
                                </svg><span>Production</span><span class="menu-arrow"></span></a>
                            <ul style="display: block;">
                                {{-- BOM MENU --}}
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);" class="subdrop">Bill Of Materials<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul style="display: block;">
                                        <li><a href="javascript:void(0);">BoM's Product</a></li>
                                        <li><a href="javascript:void(0);">Production Planning</a></li>
                                        <li><a href="javascript:void(0);">Cost Estimation</a></li>
                                    </ul>
                                </li>
                                {{-- Work ORDER PROCESS MENU --}}
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);" class="subdrop">Work Order Process<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul style="display: block;">
                                        <li><a href="javascript:void(0);">Create Work Orders</a></li>
                                        <li><a href="javascript:void(0);">Track Production Progess</a></li>
                                        <li><a href="javascript:void(0);">Track Production Worker</a></li>
                                        <li><a href="javascript:void(0);">Work Order Prioritization</a></li>
                                        <li><a href="javascript:void(0);">Barcode Integration</a></li>
                                        <li><a href="javascript:void(0);">Work Order History</a></li>
                                    </ul>
                                </li>
                                {{-- Work ORDER PROCESS MENU --}}
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);" class="subdrop">Production Scheduling<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul style="display: block;">
                                        <li><a href="javascript:void(0);">Track Invertory Stocks</a></li>
                                        <li><a href="javascript:void(0);">Chart Vissualization</a></li>
                                        <li><a href="javascript:void(0);">Production Priority</a></li>
                                        <li><a href="javascript:void(0);">Manage Production Shift</a></li>
                                    </ul>
                                </li>
                                {{-- MACHINE MONITORING MENU --}}
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);" class="subdrop">Machine Monitoring<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul style="display: block;">
                                        <li><a href="javascript:void(0);">Track Maintenance History</a></li>
                                        <li><a href="javascript:void(0);">Real Time Machine Monitoring</a></li>
                                        <li><a href="javascript:void(0);">Resource Cost Tracking</a></li>
                                        <li><a href="javascript:void(0);">Energy Consumtion Monitoring</a></li>
                                    </ul>
                                </li>
                                {{-- QC MENU --}}
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);" class="subdrop">Quality Control<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul style="display: block;">
                                        <li><a href="javascript:void(0);">Track Maintenance History</a></li>
                                        <li><a href="javascript:void(0);">Real Time Machine Monitoring</a></li>
                                        <li><a href="javascript:void(0);">Resource Cost Tracking</a></li>
                                        <li><a href="javascript:void(0);">Energy Consumtion Monitoring</a></li>
                                    </ul>
                                </li>
                                {{-- Waste Track MENU --}}
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);" class="subdrop">Track Wastage<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul style="display: block;">
                                        <li><a href="javascript:void(0);">Track Maintenance History</a></li>
                                        <li><a href="javascript:void(0);">Real Time Machine Monitoring</a></li>
                                        <li><a href="javascript:void(0);">Resource Cost Tracking</a></li>
                                        <li><a href="javascript:void(0);">Energy Consumtion Monitoring</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </li>
                        {{-- PRODUCTION MODULE MENU END --}}

                        {{-- Start HR & Workforce Management --}}

                <li class="submenu">
                    <a href="javascript:void(0);"><i data-feather="file-minus"></i><span>HR & Workforce Management</span><span class="menu-arroww"></span></a>
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
                        <li class="submenu"><a href="javascript:void(0);"><i data-feather="users"></i><span>Finance &
                                    Accounts</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="">General Ledger</a>
                                    <ul>
                                        <li><a href="">Chart of Accounts</a></li>
                                        <li><a href="">Journal Entries</a>
                                        </li>
                                        <li><a href="">Trial Balance</a></li>
                                        <li><a href="">Account Reconciliation</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Accounts Payable</a>
                                    <ul>
                                        <li><a href="">Suppliers</a></li>
                                        <li><a href="">Invoices</a></li>
                                        <li><a href="">Payments</a></li>
                                        <li><a href="">Aging Reports</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Accounts Receivable</a>
                                    <ul>
                                        <li><a href="">Customers</a></li>
                                        <li><a href="">Invoices</a></li>
                                        <li><a href="">Receipts</a></li>
                                        <li><a href="">Customer Statement</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Cash & Bank Management</a>
                                    <ul>
                                        <li><a href="">Bank Accounts</a></li>
                                        <li><a href="">Bank Reconciliation</a></li>
                                        <li><a href="">Cash Flow</a></li>
                                        <li><a href="">Petty Cash Management</a></li>
                                        <li><a href="">Bank Transfers</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Inventory Valuation and Costing</a>
                                    <ul>
                                        <li><a href="">Inventory Overview</a></li>
                                        <li><a href="">Costing Methods</a></li>
                                        <li><a href="">Cost of Goods Manufactured</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Payroll & Employee Costing</a>
                                    <ul>
                                        <li><a href="">Employee Records</a></li>
                                        <li><a href="">Payroll</a></li>
                                        <li><a href="">Deductions</a></li>
                                        <li><a href="">Overtime & Bonuses</a></li>
                                        <li><a href="">Employee Benefits Management</a></li>
                                        <li><a href="">Payslips & Reporting</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Budgeting & Forecasting</a>
                                    <ul>
                                        <li><a href="">Budget Creation</a></li>
                                        <li><a href="">Forecasting</a></li>
                                        <li><a href="">Variance Analysis</a></li>
                                        <li><a href="">Cash Flow Projections</a></li>
                                    </ul>
                                </li>

                                <li><a href="javascript:void(0);">Financial Reporting</a>
                                    <ul>
                                        <li><a href="">Balance Sheet</a></li>
                                        <li><a href="">Profit & Loss Statement</a></li>
                                        <li><a href="">Cash Flow Statement</a></li>
                                        <li><a href="">Tax Reports</a></li>
                                        <li><a href="">Custom Report</a></li>
                                        <li><a href="">Consolidated Financial Reports</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Fixed Asset Maangement</a>
                                    <ul>
                                        <li><a href="">Asset Register</a></li>
                                        <li><a href="">Depreciation</a></li>
                                        <li><a href="">Asset Disposal</a></li>
                                        <li><a href="">Asset Reports</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Taxation Management</a>
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

                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i data-feather="shopping-bag"></i>
                                <span>Inventory</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li class="submenu">
                                    <a href="javascript:void(0);">
                                        <i data-feather="layers"></i>
                                        <span>Categories</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li><a href="{{ url('/category') }}"> Category List</a></li>
                                        <li><a href="{{ url('/category_type') }}"> Category Types</a></li>
                                        <li><a href="{{ url('/categories/add') }}"> Add Category</a></li>
                                        <li><a href="{{ url('/categories/attributes') }}">Manage Attributes</a></li>
                                    </ul>
                                </li>

                                <li class="submenu">
                                    <a href="javascript:void(0);">
                                        <i data-feather="shopping-bag"></i>
                                        <span>Products</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li><a href="{{ url('/products') }}">Product List</a></li>
                                        <li><a href="{{ url('/products/add') }}"> Add Product</a></li>
                                        <li><a href="{{ url('/products/variants') }}">Product Variants</a></li>
                                        <li><a href="{{ url('/products/pricing') }}"> Pricing & Costing</a></li>
                                        <li><a href="{{ url('/products/stock') }}"> Stock Management</a></li>
                                        <li><a href="{{ url('/products/barcode') }}"> Print Barcode & QR</a></li>
                                        <li><a href="{{ url('/products/bom') }}">Bill of Materials (BOM)</a></li>
                                    </ul>
                                </li>

                                <li class="submenu">
                                    <a href="javascript:void(0);">
                                        <i data-feather="dollar-sign"></i>
                                        <span>Inventory Valuation</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li><a href="{{ url('/inventory/valuation/fifo') }}">FIFO</a></li>
                                        <li><a href="{{ url('/inventory/valuation/lifo') }}">LIFO</a></li>
                                        <li><a href="{{ url('/inventory/valuation/weighted') }}">Weighted Average</a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- 📋 Inventory Reports -->
                                <li class="submenu">
                                    <a href="javascript:void(0);">
                                        <i data-feather="clipboard"></i>
                                        <span>Inventory Reports</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li><a href="{{ url('/inventory/reports/stock-ledger') }}"> Stock Ledger</a>
                                        </li>
                                        <li><a href="{{ url('/inventory/reports/audit') }}">Audit & Cycle
                                                Counting</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                    {{--Suppliers & purchase  --}}
                    <li class="submenu">
                        <a href="javascript:void(0);">
                            <i data-feather="truck"></i>
                            <span>Suppliers & Purchases</span>
                        </a>
                        <ul>
                            <!-- Suppliers -->
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i data-feather="user-check"></i>
                                    <span>Suppliers</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ url('/suppliers') }}">Supplier List</a></li>
                                    <li><a href="{{ url('/suppliers/add') }}">Add Supplier</a></li>
                                    <li><a href="{{ url('/suppliers/contracts') }}">Supplier Contracts</a></li>
                                </ul>
                            </li>

                            <!-- Purchase Orders -->
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i data-feather="file-text"></i>
                                    <span>Purchase Orders</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ url('/purchases') }}">Purchase Order List</a></li>
                                    <li><a href="{{ url('/purchases/create') }}">Create Purchase Order</a></li>
                                    <li><a href="{{ url('/purchases/pending') }}">Pending Purchases</a></li>
                                    <li><a href="{{ url('/purchases/completed') }}">Completed Purchases</a></li>
                                </ul>
                            </li>

                            <!-- Payments -->
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i data-feather="credit-card"></i>
                                    <span>Payments</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ url('/payments/suppliers') }}">Supplier Payments</a></li>
                                    <li><a href="{{ url('/payments/pending') }}">Pending Payments</a></li>
                                    <li><a href="{{ url('/payments/completed') }}">Completed Payments</a></li>
                                </ul>
                            </li>

                            <!-- Purchase Reports -->
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i data-feather="bar-chart-2"></i>
                                    <span>Purchase Reports</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ url('/reports/purchases') }}">Purchase Summary</a></li>
                                    <li><a href="{{ url('/reports/supplier-performance') }}">Supplier Performance</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    {{-- Sale &  & Order Management --}}
                    <li class="submenu">
                        <a href="javascript:void(0);">
                            <i data-feather="shopping-cart"></i>
                            <span>Sales & Order Management</span>
                        </a>
                        <ul>
                            <!-- Orders -->
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i data-feather="file-text"></i>
                                    <span>Orders</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ url('/orders') }}">Order List</a></li>
                                    <li><a href="{{ url('/orders/create') }}">Create Order</a></li>
                                    <li><a href="{{ url('/orders/pending') }}">Pending Orders</a></li>
                                    <li><a href="{{ url('/orders/completed') }}">Completed Orders</a></li>
                                    <li><a href="{{ url('/orders/cancelled') }}">Cancelled Orders</a></li>
                                </ul>
                            </li>

                            <!-- Customers -->
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i data-feather="users"></i>
                                    <span>Customers</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ url('/customers') }}">Customer List</a></li>
                                    <li><a href="{{ url('/customers/add') }}">Add Customer</a></li>
                                    <li><a href="{{ url('/customers/groups') }}">Customer Groups</a></li>
                                </ul>
                            </li>

                            <!-- Invoices & Payments -->
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i data-feather="credit-card"></i>
                                    <span>Invoices & Payments</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ url('/invoices') }}">Invoices</a></li>
                                    <li><a href="{{ url('/payments') }}">Payments</a></li>
                                    <li><a href="{{ url('/refunds') }}">Refunds</a></li>
                                </ul>
                            </li>

                            <!-- Sales Reports -->
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i data-feather="bar-chart-2"></i>
                                    <span>Sales Reports</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ url('/reports/sales') }}">Sales Summary</a></li>
                                    <li><a href="{{ url('/reports/revenue') }}">Revenue Report</a></li>
                                    <li><a href="{{ url('/reports/customers') }}">Customer Sales Report</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>




                    {{-- Warehouse mangement --}}
                    <li class="submenu">
                        <a href="javascript:void(0);">
                            <i data-feather="package"></i>
                            <span>Warehouse Management</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <!-- Warehouses -->
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i data-feather="home"></i>
                                    <span>Warehouses</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ url('/warehouses') }}">Warehouse List</a></li>
                                    <li><a href="{{ url('/warehouses/add') }}">Add Warehouse</a></li>
                                </ul>
                            </li>

                            <!-- Storage Locations -->
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i data-feather="map"></i>
                                    <span>Storage Locations</span>
                                </a>
                                <ul>
                                    <li><a href="{{ url('/storage-locations') }}">Location List</a></li>
                                    <li><a href="{{ url('/storage-locations/add') }}">Add Storage Location</a></li>
                                </ul>
                            </li>

                            <!-- Stock Movements -->
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i data-feather="shuffle"></i>
                                    <span>Stock Movements</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ url('/stock-movements/in') }}">Stock In (Goods Receipt Notes - GRN)</a></li>
                                    <li><a href="{{ url('/stock-movements/out') }}">Stock Out (Shipments)</a></li>
                                    <li><a href="{{ url('/stock-movements/transfers') }}">Stock Transfers</a></li>
                                    <li><a href="{{ url('/stock-movements/adjustments') }}">Stock Adjustments</a></li>
                                    <li><a href="{{ url('/stock-movements/adjust-levels') }}">Adjust Stock Levels</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>



                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
