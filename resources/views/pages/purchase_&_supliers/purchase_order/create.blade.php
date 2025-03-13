@extends('layout.backend.main')

@section('page_content')
    @if (session('error'))
        <div class="alert alert-danger">
            <strong>Error!</strong> {{ session('error') }}
        </div>
    @endif

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 style="color: white">Purchase Invoice - Raw Materials</h3>
                    </div>
                    <div class="card-body">

                        <!-- Supplier & Invoice Details -->

                        <div class="row">
                            <!-- Supplier Details -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label"> <strong>Supplier Details:</strong></label>
                                <div class="input-group">

                                    <select name="supplier_id" class="form-select" required id="supplier_id">
                                        <option value="">Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier['id'] }}">
                                                {{ $supplier['first_name'] . ' ' . $supplier['last_name'] }}</option>
                                        @endforeach
                                    </select>
                                    <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                                        + </a>
                                </div>
                                <p class="mt-2"><strong>Supplier ID:</strong> #SUP- <span class="supp_id"></span></p>
                                <p><strong>Address: </strong> <span class="address"></span></p>
                                <p><strong>Email: </strong> <span class="email"></span> </p>
                            </div>

                            <!-- Invoice Details -->

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Invoice Details</strong> </label>
                                <div class="border p-3 bg-light">
                                    <p class="mb-1"><strong>Invoice ID: </strong> #<span class="invoice_id"></span></p>
                                    <p class="mb-1"><strong>Purchase Date:</strong><span class="purchase_date"></span></p>
                                    <p class="mb-0"><strong>Delivery Date:</strong> <span class="deliver_date"></span></p>
                                </div>
                            </div>

                        </div>
                      
                        <p><strong>Warehouse Name:</strong> <span id="warehouse_name"></span></p>
                        
                        </div>
                    </div>
                    <!-- Raw Material Table -->
                    <div class="container mt-5">
                        <div class="row">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-priamry">
                                    <tr>
                                        <th>Material Name</th>

                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Discount (%)</th>
                                        <th>VAT (%)</th>
                                        <th>Subtotal</th>
                                        <th> <button class="btn btn-danger clearAll clearAll">Clear All</button></th>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <select class="form-control" id="product_id">
                                                    <option value="">Select Raw Materials</option>
                                                    @forelse ($products as $product)
                                                        <option value="{{ $product['id'] }}">
                                                            {{ $product['name'] }}</option>
                                                    @empty
                                                    @endforelse
                                                    {{-- <option>Fabric Cotton</option>
                                            <option>Polyester</option>
                                            <option>Thread - White</option> --}}
                                                </select>
                                                <a href="{{ route('products.create') }}" class="btn btn-primary">
                                                    +
                                                </a>
                                            </div>
                                        </td>
                                        <td><input type="number" class="form-control p_price" placeholder="0.00"></td>
                                        <td><input type="number" class="form-control p_qty" placeholder="0"></td>
                                        <td><input type="number" class="form-control p_discount" placeholder="0"></td>
                                        <td><input type="number" class="form-control p_vat" placeholder="0"></td>
                                        <td><input type="text" class="form-control p_subtotal" disabled></td>
                                        <td><button class="btn btn-primary add-card-btn">Add</button></td>
                                    </tr>
                                </thead>
                                <tbody class="dataAppend">

                                </tbody>

                            </table>

                            <div class="col-md-6">
                                <div class="invoice-payment">

                                    <h6 class="mb-4">Payment info:</h6>
                                    <ul>
                                        <li>Credit Card - 123***********789</li>
                                        <li class="mb-0" name="paid_amount">Paid Amount:<span class="paid_amount"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Summary -->
                            <div class="row mt-4">
                                <div class="col-md-6">

                                    <p><strong>Delivery Address: </strong> <span>123 Factory Road, City Road,
                                            Bangladesh</span></p>
                                    <p><strong>Notes:</strong> Urgent delivery required.</p>
                                </div>
                                <div class="col-md-6 text-end">
                                    <h5>Invoice Summary:</h5>
                                    <p><strong>Total Amount:</strong> <span class="total"> </span></p>
                                    <p><strong>Discount:</strong><span class='discount'>- </span></p>
                                    <p><strong>VAT (%):</strong><span class="vat">+ </span></p>
                                    <hr>
                                    <h4><strong>Grand Total: <span class="grand_total"></span></strong> </h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-primary process_btn">Process Invoice</button>
                            <button class="btn btn-success" onclick="window.print();">Print Invoice</button>
                            <button class="btn btn-primary">Save</button>
                            <button class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(function() {
            const cart = new Cart('purchase');
            printCart();
            // Fetch invoice ID from backend
            $.ajax({
                url: "{{ url('get-invoice-id') }}",
                type: "GET",

                success: function(res) {
                    $(".invoice_id").text(res.invoice_id);

                },
                error: function(xhr) {
                    console.error("Error fetching invoice ID:", xhr.resText);
                }
            });

            // get delivery data 

            let today = new Date();
            let purchaseDate = today.toLocaleDateString('en-US', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });


            // Format delivery date (7 days later)
            let deliveryDate = new Date();
            deliveryDate.setDate(today.getDate() + 7);
            let formattedDeliveryDate = deliveryDate.toLocaleDateString('en-US', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            $(".purchase_date").text(purchaseDate);
            $(".deliver_date").text(formattedDeliveryDate);

            $.ajaxSetup({
                headers: {
                    ' X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })


            $('#supplier_id').on('change', function() {
                let supplier_id = $(this).val();
                // console.log('Selected Supplier ID:', supplier_id);  

                $.ajax({
                    url: "{{ url('find_supplier') }}",
                    type: "POST",
                    data: {
                        id: supplier_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        // console.log(res.supplier);  
                        if (res.supplier) {
                            $(".address").text(res.supplier.address || "N/A");
                            $(".email").text(res.supplier.email || "N/A");
                            $(".supp_id").text(res.supplier.id || "N/A");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });

            })
            
            $("#product_id").on('change', function() {
                let product_id = $(this).val();
                console.log("Selected Product ID: " + product_id);
                $.ajax({
                    url: "{{ url('find_product') }}",
                    type: "POST",
                    data: {
                        id: product_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        console.log(res.product);
                        if (res.product) {
                            $(".p_price").val(res.product.unit_price);
                            $(".p_qty").val(res.product.qty);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            });


            $('.add-card-btn').on('click', function() {
                let item_id = $("#product_id").val();
                let name = $("#product_id option:selected").text();
                let price = parseFloat($(".p_price").val()) || 0;
                let qty = parseFloat($(".p_qty").val()) || 0;
                let discount = parseFloat($(".p_discount").val()) || 0;
                let vat = parseFloat($(".p_vat").val()) || 0;

                let total_amount = price * qty;
                let total_discount = (total_amount * discount) / 100;
                let taxable_amount = total_amount - total_discount;
                let total_vat = (taxable_amount * vat) / 100;
                let subtotal = taxable_amount + total_vat;

                let item = {
                    "name": name,
                    "item_id": item_id,
                    "price": price,
                    "qty": qty,
                    "p_discount": discount,
                    "total_discount": total_discount,
                    "p_vat": vat,
                    "total_vat": total_vat,
                    "p_subtotal": subtotal
                };

                console.log(item);
                cart.save(item);
                printCart();
                parseFloat($(".p_price").val(""));
                parseFloat($(".p_qty").val(""));
                parseFloat($(".p_discount").val(""));
                parseFloat($(".p_vat").val(""));


            });

            function printCart() {
                let cartItems = cart.getCart();
                console.log(cartItems);
                let discount = 0;
                let subtotal = 0;
                let totalVat = 0;
                let grandTotal = 0;
                let htmlData = "";

                if (cartItems) {
                    cartItems.forEach(element => {
                        subtotal += element.p_subtotal;
                        discount += element.total_discount;
                        totalVat += element.total_vat;

                        htmlData += `
                <tr>
                    <td>${element.name}</td>
                    <td>$${element.price.toFixed(2)}</td>
                    <td>${element.qty}</td>
                    <td>${element.p_discount}%</td>
                    <td>${element.p_vat}%</td>
                    <td>$${element.p_subtotal.toFixed(2)}</td>
                    <td>
                        <button data="${element.item_id}" class='btn btn-danger remove'>-</button>
                    </td>
                </tr>
            `;
                    });

                    grandTotal = subtotal;

                    $('.dataAppend').html(htmlData);
                    $('.total').html(`$${subtotal.toFixed(2)}`);
                    $('.discount').html(`-$${discount.toFixed(2)}`);
                    $('.vat').html(`+$${totalVat.toFixed(2)}`);
                    $('.grand_total').html(`$${grandTotal.toFixed(2)}`);
                    $('.paid_amount').html(`$${grandTotal.toFixed(2)}`);

                    // cartIconIncrease();
                }
            }

            $("tbody").on('click', '.remove', function() {
                let id = $(this).attr('data');
                cart.delItem(id);
                printCart();
            })
            $('.clearAll').on('click', function() {
                cart.clearCart();
                printCart()
            })

            function cartIconIncreace() {
                let items = cart.getCart().length
                $(".cartIcon").html(items);
            }


            $('.process_btn').on('click', function() {

                let supplier_id = $("#supplier_id").val();
                let purchase_total = parseFloat($('.grand_total').text().replace('$', ''));
                let paid_amount = parseFloat($('.grand_total').text().replace('$', ''));
                let discount = parseFloat($('.discount').text().replace('-$', ''));
                let vat = parseFloat($('.vat').text().replace('+$', ''));
                let products = cart.getCart();

                // Ensure numbers are properly formatted
                if (isNaN(purchase_total)) purchase_total = 0;
                if (isNaN(paid_amount)) paid_amount = 0;
                if (isNaN(discount)) discount = 0;
                if (isNaN(vat)) vat = 0;

                console.log("Final Data to API:", {
                    supplier_id,
                    purchase_total,
                    paid_amount,
                    discount,
                    vat,
                    products
                });

            //retrive only purchase_order information
                $.ajax({
                    url: "{{ url('api/purchase') }}",
                    type: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({
                        // _token: '{{ csrf_token() }}',
                        supplier_id: supplier_id,
                        total_amount: purchase_total,
                        paid_amount: paid_amount,
                        discount: discount,
                        vat: vat,
                        products: products
                    }),
                    success: function(res) {
                        if (res.success) {
                            console.log("API Response:", res);
                            window.location.href = res.redirect_url
                        } else {
                            alert("Error" + res.message)
                        }

                    },
                    error: function(xhr, status, error) {
                        console.log("API Error:", xhr.responseText);
                    }
                });




            });

        })
    </script>
    <script src="{{ asset('assets/js/cart_.js') }}"></script>
    {{-- <script src="{{asset('assets/js/cart_.js')}}"></script> --}}
@endsection
