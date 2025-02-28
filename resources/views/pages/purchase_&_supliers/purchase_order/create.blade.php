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
                                <label class="form-label">Supplier Details:</label>
                              <div class="input-group">
                              
                                <select name="supplier_id" class="form-select" required id="supplier_id">
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier['id'] }}">{{ $supplier['first_name']. ' '.$supplier['last_name'] }}</option> 
                                    @endforeach
                                </select>
                                <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                                    + </a>
                                </div>
                                <p class="mt-2"><strong>Supplier ID:</strong> #SUP- <span class="supp_id"></span></p>
                                <p ><strong >Address: </strong> <span class="address"></span></p>
                                <p ><strong >Email: </strong> <span class="email"></span> </p>
                            </div>
                        
                            <!-- Invoice Details -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Invoice Details</label>
                                <div class="border p-3 bg-light">
                                    <p class="mb-1"><strong>Invoice ID:</strong> #INV-2025001</p>
                                    <p class="mb-1"><strong>Purchase Date:</strong> 2025-03-15</p>
                                    <p class="mb-0"><strong>Delivery Date:</strong> 2025-03-20</p>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- Raw Material Table -->
                        <table class="table table-striped table-bordered">
                            <thead class="thead-priamry" > 
                                <tr >
                                    <th>Material Name</th>
                                   
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Discount (%)</th>
                                    <th>VAT (%)</th>
                                    <th>Subtotal</th>
                                    <th> <button class="btn btn-danger clearAll">Clear All</button></th>
                                </tr>
                       
                                <tr>
                                    <td>
                                        <div class="input-group">
                                        <select class="form-control" id="product_id">
                                            <option value="">Select Raw Materials</option>
                                            @forelse ($product_variants as $product_variant )
                                            <option value="{{$product_variant['id']}}">{{$product_variant['name']}}</option>
                                            @empty
                                                
                                            @endforelse
                                            {{-- <option>Fabric Cotton</option>
                                            <option>Polyester</option>
                                            <option>Thread - White</option> --}}
                                        </select>
                                        <a href="{{ route('product_variants.create') }}" class="btn btn-primary">
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
                                    <li class="mb-0"><span>Amount:</span> </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Summary -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                               
                                <p ><strong >Delivery Address:</strong></p>
                                <p><strong>Notes:</strong> Urgent delivery required.</p>
                            </div>
                            <div class="col-md-6 text-end">
                                <h5>Invoice Summary:</h5>
                                <p><strong>Total Amount:</strong> <span class="total"> </span></p>
                                <p><strong>Discount:</strong>00 <span class='discount'></span></p>
                                <p><strong>VAT (%):</strong><span class="discount"></span></p>
                                <hr>
                                <h4><strong>Grand Total: <span class="grand_total"></span></strong> $</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-success process_btn">Process Invoice</button>
                        <button class="btn btn-success" onclick="window.print();">Print Invoice</button>
                        <button class="btn btn-primary">Save</button>
                        <button class="btn btn-danger">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(function(){
        const cart = new Cart('purchase');
        printCart();
        $.ajaxSetup({
            headers:{
               ' X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        })
       
        $('#supplier_id').on('change', function() {
    let supplier_id = $(this).val();  
    // console.log('Selected Supplier ID:', supplier_id);  

    $.ajax({
        url: "{{url('find_supplier')}}",  
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
           url: "{{url('find_product')}}",
           type: "POST",
           data: {
            id:product_id,
            _token: '{{ csrf_token() }}'
           },
           success: function(res){
               console.log(res.product);
               if(res.product){
                    $(".p_price").val(res.product.
                    unit_price);
                    $(".p_qty").val(res.product.
                    qty);
               }
           },
           error:function(error){
                console.log(error);
           }
         })
});


$('.add-card-btn').on('click',function(){
    let item_id = $("#product_id").val();
    let name = $("#product_id option:selected").text();
    let price = $(".p_price").val();
    let qty = $(".p_qty").val();
    let discount = $(".p_discount").val();
    let vat = $(".p_vat").val();

    let total_amount = (price*qty)
    let total_discount = ((total_amount)*(discount/100))
    let total_vat  =((total_amount)*(vat/100));
    let subtotal = (total_amount - total_discount + total_vat);
     let item = {
        "name":name,
        "item_id":item_id,
        "price":price,
        "qty":parseFloat(qty),
        "p_discount":discount,
        total_amount,
        total_discount,
        "p_vat":total_vat,
        "p_subtotal":subtotal
     }
     console.log(item)
     cart.save(item);
     printCart();
   
})


function printCart() {
    let cartItems = cart.getCart();
    console.log(cartItems);  
    let discount = 0;  
    let htmlData = ""; 
    
    if(cartItems){
        let subtotal = 0;
        let grandtotal = 0;
        cartItems.forEach(element => {
            subtotal += element.p_subtotal;  
            discount += element.total_discount; 
            htmlData += `
                <tr>
                    <td>${element.name}</td>
                    <td>$${element.price}</td>
                    <td>${element.qty}</td>
                    <td>$${element.p_discount}</td>
                    <td>$${element.p_vat}</td>
                    <td>$${element.p_subtotal}</td>
                    <td>
                        <button data="${element.item_id}" class='btn btn-danger remove'>-</button>
                    </td>
                </tr>
            `;
        });
        
        $('.dataAppend').html(htmlData);
        $('.p_subtotal').html(subtotal);
        $('.discount').html(discount); 
        $('.vat').html(grandtotal - subtotal + discount); 
        $('.grand_total').html(subtotal);
        
        cartIconIncrease();
    }
}



    })
    </script>
    <script src="{{asset('assets/js/cart_.js')}}"></script>
    {{-- <script src="{{asset('assets/js/cart_.js')}}"></script> --}}
@endsection
