


 @extends('layout.backend.main')

 @section('page_content')
 <div class="container mt-5">
     <div class="card">
         <div class="">
             <h3 class="card-header text-center bg-primary text-white">Purchase Invoice - Raw Materials</h3>
         </div>
         <div class="card-body">
             <div class="row">
                 <div class="col-md-6">
                     <h5>Supplier Details:</h5>
                     <p><strong>Name:</strong> {{ optional($purchaseOrder->inv_supplier)->first_name }} {{ optional($purchaseOrder->inv_supplier)->last_name }}</p>
                     <p><strong>Address:</strong> {{ optional($purchaseOrder->inv_supplier)->address }}</p>
                     <p><strong>Email:</strong> {{ optional($purchaseOrder->inv_supplier)->email }}</p>
                 </div>
                 <div class="col-md-6 text-end">
                     <h5>Invoice Details:</h5>
                     <p><strong>Invoice ID:</strong> #INV-{{ str_pad($purchaseOrder->id, 6, "0", STR_PAD_LEFT) }}</p>
                     <p><strong>Purchase Date:</strong> {{ $purchaseOrder->purchase_date }}</p>
                     <p><strong>Delivery Date:</strong> {{ $purchaseOrder->delivery_date }}</p>
                 </div>
             </div>
             <hr>
             <h5>Product Details</h5>
             <table class="table table-bordered">
                 <thead>
                     <tr>
                         <th>Material Name</th>
                         <th>Unit Price</th>
                         <th>Quantity</th>
                         <th>Discount (%)</th>
                         <th>VAT (%)</th>
                         <th>Subtotal</th>
                     </tr>
                 </thead>
                 <tbody>
                    @forelse($purchaseOrder->purchaseDetails as $detail) 
                    <tr>
                        <td>{{ optional($detail->product)->name }}</td> <!-- Product Name -->
                        <td>${{ number_format($detail->price, 2) }}</td> <!-- Product Price -->
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ $detail->discount }}</td>
                        <td>{{ $detail->vat }}</td>
                       
                        <td>
                            ${{ number_format(
                                (($detail->price * $detail->quantity) - 
                                (($detail->discount / 100) * ($detail->price * $detail->quantity))) + 
                                ((($detail->price * $detail->quantity) - (($detail->discount / 100) * ($detail->price * $detail->quantity))) * ($detail->vat / 100)),
                                2
                            ) }}
                        </td>
                        
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No products found for this purchase order.</td>
                        </tr>
                    @endforelse
                </tbody>
                
             </table>
             <div class="row">
                 <div class="col-md-6">
                     <p><strong>Shipping Address:</strong> {{ $purchaseOrder->shipping_address }}</p>
                     <p><strong>Notes:</strong> {{ $purchaseOrder->description }}</p>
                 </div>
                 <div class="col-md-6 text-end">
                     <h4>Total: ${{ number_format($purchaseOrder->total_amount, 2) }}</h4>
                     <h5>Paid: ${{ number_format($purchaseOrder->paid_amount, 2) }}</h5>
                     <h5>Grand Total: ${{ number_format($purchaseOrder->total_amount - $purchaseOrder->paid_amount, 2) }}</h5>
                 </div>
             </div>
         </div>
         <div class="card-footer text-center">
             {{-- <a href="{{ route('purchase.generatePDF', $purchaseOrder->id) }}" class="btn btn-danger">Download PDF</a> --}}
             <a href="{{ route('purchase.generatePDF', $purchaseOrder->id) }}" class="btn btn-danger">Download PDF</a>

             <button class="btn btn-success" onclick="window.print();">Print Invoice</button>
         </div>
     </div>
 </div>
 @endsection
 