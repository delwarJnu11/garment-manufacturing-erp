
@extends('layout.backend.main')

@section('page_content')
@if (session('error'))
<div class="alert alert-danger">
    <strong>Error!</strong> {{ session('error') }}
</div>
@endif


    <div class="row"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">



                <!-- Invoice -->
                <div class="invoice-wrap">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="invoice-address">
                                <h6 class="mb-2">Invoice From:</h6>
                                <ul>
                                   
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="invoice-address d-flex justify-content-end">
                                <div>
                                    <h6 class="mb-2">Invoice To:</h6>
                                    <ul>
                                        <li>
                                            <select class="form-control" name="customer_id" id="customer_id">
                                                @forelse ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                @empty
                                                    <option value="">No supplier Found</option>
                                                @endforelse
                                            </select>
                                        </li>
                                        <li>Address: <span class="address">Dhaka</span></li>
                                        <li>Email: <span class="email">sample@gmail.com</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 ">
                                <div class="table-resposnive mt-5">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>

                                                <th colspan="2">Product/Service</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Discount</th>
                                                <th>Subtotal</th>
                                            </tr>
                                            <tr>

                                                <th colspan="2">
                                                    <select class="form-control" name="product_id" id="product_id">
                                                        <option value="">Select Product</option>
                                                        @forelse ($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }}
                                                            </option>
                                                        @empty
                                                            <option value="">No Product Found</option>
                                                        @endforelse
                                                    </select>
                                                </th>
                                                <th><input type="text" disabled class=" form-control p_description"></th>
                                                <th><input type="text" disabled class=" form-control p_price"></th>
                                                <th><input type="number" class=" form-control p_qty"></th>
                                                <th><input type="text" class=" form-control p_discount"></th>
                                                <th> <button class="btn btn-primary add_cart_btn">add</button></th>
                                            </tr>
                                        </thead>
                                        <tbody class="dataAppend">

                                        </tbody>
                                    </table>
                                </div>



                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="invoice-payment">
                                <button class="btn btn-warning clearAll">Clear All</button>
                                <h6 class="mb-4">Payment info:</h6>
                                <ul>
                                    <li>Credit Card - 123***********789</li>
                                    <li class="mb-0"><span>Amount:</span> $252.36</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="d-flex justify-content-end">
                                <div class="invoice-total">
                                    <ul>
                                        <li class="d-flex justify-content-between gap-5">Sub Total <span
                                                class="subtotal">244.00</span></li>
                                        <li class="d-flex justify-content-between gap-5">Tax(5%) <span
                                                class="tax">8.36</span></li>
                                        <li class="d-flex justify-content-between gap-5">Discount<span
                                                class="Discount">8.36</span></li>
                                        <li class="d-flex justify-content-between gap-5 mb-0">Total <span
                                                class="text-dark grandtotal"> 252.36</span></li>
                                    </ul>
                                </div>

                            </div>
                            <button class="btn btn-primary btn_process">Order</button>
                        </div>

                        <div class="invoice-terms rounded">
                            <h6 class="fs-14 mb-3">Terms & Conditions:</h6>
                            <ul>
                                <li>All payments must be made according to the agreed schedule. Late payments may incur
                                    additional fees.</li>
                                <li class="mb-0">Cancellations must be made within 10 days of service. Refunds are subject
                                    to review and may not be granted if the service has been substantially performed.</li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>



@endsection

{{-- @section('script')
    <script>
        $(function() {
            const cart = new Cart('order');
            printCart();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#customer_id').on('change', function() {
                let customer_id = $(this).val();
                $.ajax({
                    url: "{{ url('find_customer') }}",
                    type: 'post',
                    data: {
                        id: customer_id
                    },
                    success: function(res) {
                        //let data=JSON.parse(res);
                        console.log(res.customer);

                        $(".email").text(res.customer?.email);
                        $(".address").text(res.customer?.address);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            $('#product_id').on('change', function() {
                let product_id = $(this).val();
                $.ajax({
                    url: "{{ url('find_product') }}",
                    type: 'post',
                    data: {
                        id: product_id
                    },
                    success: function(res) {
                        console.log(res);

                        $(".p_description").val(res.product?.description);
                        $(".p_price").val(res.product?.offer_price);
                        $(".p_qty").val(1);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });


            $('.add_cart_btn').on('click', function() {

                let item_id = $("#product_id").val();
                let name = $("#product_id option:selected").text();

                let price = $(".p_price").val();
                let qty = $(".p_qty").val();
                let discount = $(".p_discount").val();

                let total_discount = discount * qty;
                let subtotal = price * qty - total_discount;

                let item = {
                    "name": name,
                    "item_id": item_id,
                    "price": price,
                    "qty": parseFloat(qty),
                    "discount": discount,
                    'total_discount': total_discount,
                    "subtotal": subtotal
                };

                cart.save(item);
                printCart();

            });


            function printCart() {
                let cartdata = cart.getCart();
                if (cartdata) {


                    let htmldata = "";
                    let subtotal = 0;
                    let dicount = 0;
                    let grandtotal = 0;

                    cartdata.forEach(element => {
                        subtotal += element.subtotal
                        dicount += element.total_discount

                        htmldata += `
				 <tr>
					<td>
						 <button data="${element.item_id}" class='btn btn-danger remove'>-</button>
					</td>
					<td>
						<p class="fs-14">${element.name}</p>
					</td>
					<td>
						<p class="fs-14 text-gray">${element.name}</p>

					</td>
					<td><span class="fs-14 text-gray">$${element.price} </span></td>
					<td>
						<p class="fs-14 text-gray">${element.qty}</p>
					</td>
					<td><span class="fs-14 text-gray">$${element.total_discount} </span></td>
					<td><span class="fs-14 text-gray">$${element.subtotal} </span></td>
				</tr>
				`;
                    });

                    $('.dataAppend').html(htmldata);


                    $('.subtotal').html(subtotal);
                    $('.tax').html(subtotal * 5 / 100);
                    $('.Discount').html(dicount);
                    $('.grandtotal').html(subtotal + (subtotal * 5 / 100));
                    cartIconIncrease()
                }

            }


            $(document).on('click', '.remove', function() {
                let id = $(this).attr('data');
                cart.delItem(id);
                printCart();
            })


            $(document).on('click', '.clearAll', function() {
                cart.clearCart();
                printCart();
            });
            cartIconIncrease()

            function cartIconIncrease() {
                let items = cart.getCart().length
                $(".cartIcon").html(items);
            }

            $('.btn_process').on('click', function() {

                let customer_id = $('#customer_id').val();
                let order_total = $('.grandtotal').text();
                let paid_amount = $('.grandtotal').text();
                let discount = $('.Discount').text();
                let vat = $('.tax').text();
                let products = cart.getCart()


                // let dataItem = {
                //     customer_id: customer_id,
                //     order_total: order_total,
                //     paid_amount: paid_amount,
                //     discount: discount,
                //     vat: vat,
                //     product: product,
                // }

                $.ajax({
                    url: "{{ url('api/orders') }}",
                    type: 'Post',
                    data: {
                        customer_id: customer_id,
                        order_total: order_total,
                        paid_amount: paid_amount,
                        discount: discount,
                        vat: vat,
                        products: products,
                    },
                    success: function(res) {
                        console.log(res);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            })


        })
    </script>


    <script src="{{ asset('assets/js/cart_.js') }}"></script>
@endsection --}}