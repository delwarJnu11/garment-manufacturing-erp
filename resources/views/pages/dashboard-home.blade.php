@extends('layout.backend.main')

@section('page_content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-widget w-100">
                <div class="dash-widgetimg">
                    <span><img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/dash1.svg"
                            alt="img" /></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>
                        $<span class="counters" data-count="307144.00">$307,144.00</span>
                    </h5>
                    <h6>Total Purchase Due</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-widget dash1 w-100">
                <div class="dash-widgetimg">
                    <span><img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/dash2.svg"
                            alt="img" /></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>
                        $<span class="counters" data-count="4385.00">$4,385.00</span>
                    </h5>
                    <h6>Total Sales Due</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-widget dash2 w-100">
                <div class="dash-widgetimg">
                    <span><img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/dash3.svg"
                            alt="img" /></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>
                        $<span class="counters" data-count="385656.50">$385,656.50</span>
                    </h5>
                    <h6>Total Sale Amount</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-widget dash3 w-100">
                <div class="dash-widgetimg">
                    <span><img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/dash4.svg"
                            alt="img" /></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5>
                        $<span class="counters" data-count="40000.00">$400.00</span>
                    </h5>
                    <h6>Total Expense Amount</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-count">
                <div class="dash-counts">
                    <h4 class="text-center">{{ $totalBuyers }}</h4>
                    <h5>Customers</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="user"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das1">
                <div class="dash-counts">
                    <h4 class="text-center">{{ count($suppliers) }}</h4>
                    <h5>Suppliers</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="user-check"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das2">
                <div class="dash-counts">
                    <h4 class="text-center">{{ $totalorders }}</h4>
                    <h5>Orders</h5>
                </div>
                <div class="dash-imgs">
                    <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/file-text-icon-01.svg"
                        class="img-fluid" alt="icon" />
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12 d-flex">
            <div class="dash-count das3">
                <div class="dash-counts">
                    <h4>170</h4>
                    <h5>Sales Invoice</h5>
                </div>
                <div class="dash-imgs">
                    <i data-feather="file"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->

    <div class="row">
        <div class="col-xl-7 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Purchase & Sales</h5>
                    <div class="graph-sets">
                        <ul class="mb-0">
                            <li>
                                <span>Sales</span>
                            </li>
                            <li>
                                <span>Purchase</span>
                            </li>
                        </ul>
                        <div class="dropdown dropdown-wraper">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                2023
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2023</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">2021</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="sales_charts"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-sm-12 col-12 d-flex">
            <div class="card flex-fill default-cover mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Recent Products Catalouge</h4>
                    <div class="view-all-link">
                        <a href="javascript:void(0);" class="view-all d-flex align-items-center">
                            View All<span class="ps-2 d-flex align-items-center"><i data-feather="arrow-right"
                                    class="feather-16"></i></span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive dataview">
                        <table class="table dashboard-recent-products">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Products</th>
                                    <th>SKU</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($productCatalogs as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td class="productimgname">
                                            <a href="" class="product-img">
                                                <img src="{{ asset('uploads') }}/products/{{ $product->photo }}"
                                                    alt="product" />
                                            </a>
                                            <a href="">{{ $product->name }}</a>
                                        </td>
                                        <td>{{ $product->sku }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-danger" colspan="4">1</td>

                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Our Suppliers</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                    <thead>
                        <tr>
                            <th class="no-sort">
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all" />
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" />
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="productimgname">
                                        <a href="javascript:void(0);" class="product-img stock-img">
                                            <img src="{{ asset('uploads') }}/suppliers/{{ $supplier->photo }}"
                                                alt="product" />
                                        </a>
                                        <a href="javascript:void(0);">{{ $supplier->first_name }}
                                            {{ $supplier->last_name }}</a>
                                    </div>
                                </td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2" href="#">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <a class="confirm-text p-2" href="javascript:void(0);">
                                            <i data-feather="trash-2" class="feather-trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse


                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $suppliers->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection
