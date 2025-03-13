@extends('layout.backend.main');

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Order Details</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    @csrf

                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Product Name</label>
                            <select name="product_id" class="form-select" id="product_dropdown">
                                <option value="">Select Product</option>
                                @forelse ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}
                                    </option>
                                @empty
                                    <option value="">No product Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Order Number</label>
                            <select name="order_id" class="form-select" id="order_dropdown">
                                <option value="">Select Order Number</option>
                                @forelse ($orders as $order)
                                    <option value="{{ $order->id }}">{{ $order->order_number }}</option>
                                @empty
                                    <option value="">No Order Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('order_id')" class="mt-2" />
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Size</label>
                            <select name="size_id" class="form-select" id="size_dropdown">
                                <option value="">Select Size</option>
                                @forelse ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @empty
                                    <option value="">No size Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('size_id')" class="mt-2" />
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Color</label>
                            <select name="color_id" class="form-select" id="color_dropdown">
                                <option value="">Select Color</option>
                                @forelse ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @empty
                                    <option value="">No colors Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('color_id')" class="mt-2" />
                        </div>
                        <div class="col-md-1 mb-3">
                            <label for="qty" class="form-label">Quantity</label>
                            <input class="form-control" type="text" name="qty" id="qty"
                                value="{{ old('qty') }}" placeholder="Qty" />
                            <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">UOM</label>
                            <select name="uom_id" class="form-select" id="uom_dropdown">
                                <option value="">Select UOM</option>
                                @forelse ($uoms as $uom)
                                    <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                                @empty
                                    <option value="">No uom Found!</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('uom_id')" class="mt-2" />
                        </div>
                        <div class="col-md-1 mt-3">
                            <button id="add_btn" type="button" class="form_btn p-4"
                                style="background: purple !important; color:#fff !important;">
                                <i data-feather="plus" class="feather-edit"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered" id="order-items-table">
                    <tbody id="data-append">

                    </tbody>
                </table>
                <div class="d-flex justify-content-end mt-3">
                    <button type="btn" id="create_btn" class="btn btn-primary">Create Order</button>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function getOrderItems() {
                let items = localStorage.getItem('orderItems');
                return items ? JSON.parse(items) : [];
            }

            // Function to save order items to local storage
            function saveOrderItems(items) {
                localStorage.setItem('orderItems', JSON.stringify(items));
            }

            // Function to display order items in the table
            function displayOrderItems() {
                let items = getOrderItems();
                let tableBody = $('#data-append');
                tableBody.empty();

                items.forEach(function(item, index) {
                    let row = `
                        <tr>
                            <td>${item.product_name}</td>
                            <td>${item.order_number}</td>
                            <td>${item.size_name}</td>
                            <td>${item.color_name}</td>
                            <td>${item.qty}</td>
                            <td>${item.uom_name}</td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-item" data-index="${index}">Delete</button>
                            </td>
                        </tr>
                    `;
                    tableBody.append(row);
                });
            }

            // Initial display of order items on page load
            displayOrderItems();

            // Handle Add Btn to add item in the cart
            $('#add_btn').on('click', function(e) {
                e.preventDefault();
                // Get values from dropdowns and input
                const product_id = $("#product_dropdown").val();
                const product_name = $("#product_dropdown option:selected").text();
                const order_id = $("#order_dropdown").val();
                const order_number = $("#order_dropdown option:selected").text();
                const size_id = $("#size_dropdown").val();
                const size_name = $("#size_dropdown option:selected").text();
                const color_id = $("#color_dropdown").val();
                const color_name = $("#color_dropdown option:selected").text();
                const qty = $("#qty").val();
                const uom_id = $("#uom_dropdown").val();
                const uom_name = $("#uom_dropdown option:selected").text();

                // Create item object
                const newItem = {
                    product_id,
                    product_name,
                    order_id,
                    order_number,
                    size_id,
                    size_name,
                    color_id,
                    color_name,
                    qty,
                    uom_id,
                    uom_name
                };

                // Get existing items, add the new item, and save
                let items = getOrderItems();
                items.push(newItem);
                saveOrderItems(items);

                // Update the display
                displayOrderItems();

                // Clear the input fields
                $("#product_dropdown").val('');
                $("#order_dropdown").val('');
                $("#size_dropdown").val('');
                $("#color_dropdown").val('');
                $("#qty").val('');
                $("#uom_dropdown").val('');
            });

            // Delete item button click event (using event delegation)
            $('#order-items-table tbody').on('click', '.delete-item', function() {
                let index = $(this).data('index');
                let items = getOrderItems();

                // Delete the specific index item
                const remaining_items = items.filter((item, i) => i !== index);
                saveOrderItems(remaining_items);
                displayOrderItems();
            });

            // Create Final Order
            $('#create_btn').on('click', function() {
                const items = getOrderItems();
                const newItems = items.map(item => ({
                    product_id: item.product_id,
                    order_id: item.order_id,
                    size_id: item.size_id,
                    color_id: item.color_id,
                    qty: item.qty,
                    uom_id: item.uom_id,
                    subtotal: 0
                }));
                console.log(newItems)

                $.ajax({
<<<<<<< HEAD
                    url: '/api/order_details',
=======
                    url: "/api/order_details",
>>>>>>> 5974f2b7ccea101babc15445f301e85a12c4dcb9
                    type: "POST",
                    data: JSON.stringify({
                        items: newItems
                    }),
                    contentType: "application/json",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        if (response.status === 201) {
                            localStorage.clear();
                            return window.location.assign('/orders');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("Error saving items.");
                    }
                });

            })
        });
    </script>
@endsection
