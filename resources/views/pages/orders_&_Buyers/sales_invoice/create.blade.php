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
                        <h3 style="color: white">Sales Invoice</h3>
                    </div>
                    <div class="card-body">
                        <!-- Buyer & Invoice Details -->
                        <div class="row">
                            <!-- Buyer Details -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Buyer Details:</strong></label>
                                <div class="input-group">
                                    <select name="buyer_id" class="form-select" required id="buyer_id">
                                        <option value="">Select Buyer</option>
                                        @foreach ($buyers as $buyer)
                                            <option value="{{ $buyer->id }}">
                                                {{ $buyer->first_name . ' ' . $buyer->last_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <a href="{{ route('buyers.create') }}" class="btn btn-primary">+</a>
                                </div>

                                <p class="mt-2"><strong>Buyer ID:</strong> #BUY-<span class="buyer_id"></span></p>
                                <p><strong>Address: </strong><span class="address"></span></p>
                                <p><strong>Email: </strong><span class="email"></span></p>
                            </div>

                            <!-- Invoice Details -->
                            <!-- Invoice Details -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Invoice Details</strong></label>
                                <div class="border p-3 bg-light">
                                    <p class="mb-1"><strong>Invoice ID: </strong>#<span class="invoice_id">
                                        </span>
                                    </p>
                                    <p class="mb-1"><strong>Sale Date:</strong><span class="sale_date">
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <td>
                        <div class="row mx-2">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Order Select:</strong></label>
                                <div class="input-group">
                                    <select class="form-control" id="order_id" name="order_id">
                                        <option value="">Select Order</option>
                                        @foreach ($orders as $order)
                                            <option value="{{ $order->id }}">
                                                {{ $order->order_number }} - {{ $order->buyer->first_name }}
                                                {{ $order->buyer->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                </div>
            </div>

            <!-- Sales Details Table -->
            <div class="container mt-5">
                <div class="row">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-primary">
                            <tr>
                                <th>Product</th>
                                <th>Unit Price</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Discount (%)</th>
                                <th>VAT (%)</th>
                                <th>Subtotal</th>
                                <th><button class="btn btn-danger clearAll">Clear All</button></th>
                            </tr>

                        </thead>
                        {{-- <tbody class="sales-details data-append">
                            
                        </tbody> --}}
                        <tbody class="sales-details">

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Invoice Summary -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <p><strong>Notes:</strong> <span>Urgent delivery required.</span></p>
                </div>
                <div class="col-md-6 text-end">
                    <h5>Invoice Summary:</h5>
                    <p><strong>Total Amount:</strong> <span class="total_amount">0.00</span></p>
                    <p><strong>Discount:</strong> <span class="total_discount">0.00</span></p>
                    <p><strong>VAT:</strong> <span class="total_vat">0.00</span></p>
                    <hr>
                    <h4><strong>Grand Total: <span class="grand_total">0.00</span></strong></h4>
                </div>
            </div>
        </div>

        <!-- Footer with Action Buttons -->
        <div class="card-footer text-center">
            <button class="btn btn-primary btn_process">Process Invoice</button>
            <button class="btn btn-success" onclick="window.print();">Print Invoice</button>
            <button class="btn btn-danger">Cancel</button>
        </div>
    </div>
    </div>
@endsection
@section('script')

<script>
    $(document).ready(function() {
        loadSalesDetailsFromLocalStorage();

        // Fetch invoice ID and sale date
        $.ajax({
            url: "{{ url('getInvoiceId') }}",
            type: 'GET',
            success: function(response) {
                $(".invoice_id").text(response.invoice_id);
                $(".sale_date").text(response.sale_date);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching invoice ID: ", error);
            }
        });

       
        $('#buyer_id').on('change', function() {
            let buyer_id = $(this).val();
            $.ajax({
                url: "{{ url('find_buyer') }}",
                type: 'POST',
                data: { id: buyer_id, 
                    _token: "{{ csrf_token() }}" 
                },
                success: function(res) {
                    $(".buyer_id").text(res.buyer?.id);
                    $(".email").text(res.buyer?.email);
                    $(".address").text(res.buyer?.shipping_address);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", error);
                }
            });
        });

        
        $('#order_id').on('change', function() {
            let order_id = $(this).val();
            if (!order_id) {
                console.error("Order ID is not selected.");
                return;
            }
            $.ajax({
                url: "{{ url('find_order') }}",
                type: 'POST',
                data: { order_id: order_id, _token: "{{ csrf_token() }}" },
                success: function(res) {
                    if (res.error) {
                        alert(res.error);
                        return;
                    }

                    $(".sales-details").empty();
                    res.order_details.forEach(detail => {
                        let newRow = `
                            <tr>
                                <td>${detail.product_name}</td>
                              
                                <td><input type="number" class="form-control unit_price" value="${detail.unit_price}" readonly></td>
                                <td>${detail.size}</td>
                                <td>${detail.qty}</td>
                                <td><input type="number" class="form-control discount" placeholder="0"></td>
                                <td><input type="number" class="form-control vat" placeholder="0"></td>
                                <td><input type="text" class="form-control subtotal" disabled></td>
                                <td><button class="btn btn-danger remove-item-btn">Remove</button></td>
                            </tr>`;
                        $(".sales-details").append(newRow);
                    });
                    calculateTotals();
                    saveSalesDetailsToLocalStorage();
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", error);
                }
            });
        });

        //  saving sales details to localStorage
        $(document).on('input', '.discount, .vat', function() {
            let row = $(this).closest('tr');
            let unitPrice = parseFloat(row.find('.unit_price').val());
            let qty = parseInt(row.find('td:eq(3)').text());
            let discount = parseFloat(row.find('.discount').val()) || 0;
            let vat = parseFloat(row.find('.vat').val()) || 0;

            let totalAmount = unitPrice * qty;
            let discountAmount = (totalAmount * discount) / 100;
            let vatAmount = (totalAmount * vat) / 100;
            let subtotal = totalAmount - discountAmount + vatAmount;

            row.find('.subtotal').val(subtotal.toFixed(2));
            calculateTotals();
            saveSalesDetailsToLocalStorage();
        });

        $(document).on('click', '.remove-item-btn', function() {
            $(this).closest('tr').remove();
            calculateTotals();
            saveSalesDetailsToLocalStorage();
        });

        // Clear all items from the table
        $('.clearAll').on('click', function() {
            $(".sales-details").empty();
            calculateTotals();
            localStorage.removeItem('sales_details');
        });

        // Calculate totals (amount, discount, vat)
        function calculateTotals() {
            let totalAmount = 0;
            let totalDiscount = 0;
            let totalVat = 0;

            $(".sales-details tr").each(function() {
                let unitPrice = parseFloat($(this).find('.unit_price').val());
                let qty = parseInt($(this).find('td:eq(3)').text());
                let discount = parseFloat($(this).find('.discount').val()) || 0;
                let vat = parseFloat($(this).find('.vat').val()) || 0;

                let rowTotalAmount = unitPrice * qty;
                totalAmount += rowTotalAmount;

                let discountAmount = (rowTotalAmount * discount) / 100;
                let vatAmount = (rowTotalAmount * vat) / 100;

                totalDiscount += discountAmount;
                totalVat += vatAmount;
            });

            $(".total_amount").text(totalAmount.toFixed(2));
            $(".total_discount").text(totalDiscount.toFixed(2));
            $(".total_vat").text(totalVat.toFixed(2));

            let grandTotal = totalAmount - totalDiscount + totalVat;
            $(".grand_total").text(grandTotal.toFixed(2));
        }

        // Save sales details to localStorage
        function saveSalesDetailsToLocalStorage() {
            let salesDetails = [];
            $(".sales-details tr").each(function() {
                let row = $(this);
                let item = {
                    product_name: row.find('td:eq(0)').text(),
                    unit_price: row.find('.unit_price').val(),
                    size: row.find('td:eq(2)').text(),
                    qty: row.find('td:eq(3)').text(),
                    discount: row.find('.discount').val(),
                    vat: row.find('.vat').val(),
                    subtotal: row.find('.subtotal').val()
                };
                salesDetails.push(item);
            });
            localStorage.setItem('sales_details', JSON.stringify(salesDetails));
        }

        // Load sales details from localStorage
        function loadSalesDetailsFromLocalStorage() {
            let salesDetails = JSON.parse(localStorage.getItem('sales_details'));
            if (salesDetails) {
                salesDetails.forEach(detail => {
                    let newRow = `
                        <tr>
                            <td>${detail.product_name}</td>
                            <td><input type="number" class="form-control unit_price" value="${detail.unit_price}" readonly></td>
                            <td>${detail.size}</td>
                            <td>${detail.qty}</td>
                            <td><input type="number" class="form-control discount" value="${detail.discount}" placeholder="0"></td>
                            <td><input type="number" class="form-control vat" value="${detail.vat}" placeholder="0"></td>
                            <td><input type="text" class="form-control subtotal" value="${detail.subtotal}" disabled></td>
                            <td><button class="btn btn-danger remove-item-btn">Remove</button></td>
                        </tr>`;
                    $(".sales-details").append(newRow);
                });
                calculateTotals();
            }
        }

        // Submit invoice data to the backend
        $('.btn_process').on('click', function() {
            let buyer_id = $('#buyer_id').val(); // Buyer ID instead of customer_id
            let invoice_total = $('.grand_total').text();
            let paid_amount = $('.paid_amount').text();
            let discount = $('.total_discount').text();
            let vat = $('.total_vat').text();
            let order_id = $('#order_id').val();

            let products = [];
            $(".sales-details tr").each(function() {
                let row = $(this);
                products.push({
                    product_name: row.find('td:eq(0)').text(),
                    product_id: row.find('td:eq(0)').text(),
                    unit_price: row.find('.unit_price').val(),
                    size: row.find('td:eq(2)').text(),
                    qty: row.find('td:eq(3)').text(),
                    discount: row.find('.discount').val(),
                    vat: row.find('.vat').val(),
                    subtotal: row.find('.subtotal').val()
                });
            });

            // Prepare data to send to the API
            let invoiceData = {
                buyer_id: buyer_id, 
                invoice_total: invoice_total,
                paid_amount: paid_amount,
                discount: discount,
                vat: vat,
                products: products,
                order_id:order_id
            };
            // console.log(invoiceData);
            $.ajax({
                url: "{{ url('api/salesinvoice') }}",
                type: 'POST',
                data: {
                    invoiceData,
                    _token: "{{ csrf_token() }}"
                },

                success: function(res) {
                    
                    console.log(res)
                    
                    // if (res.success) {
                    //     console.log('Invoice processed successfully:', res);
                    // } else {
                    //     console.error('Error processing invoice:', res.message);
                    // }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', error);
                }
            });
        });
    });
</script>


@endsection
