public function store(Request $request)
{
    try {
        DB::beginTransaction();

        -- // Create a sales record
        $sale = new SalesInvoice;
        $sale->customer_id = $request->customer_id;
        $sale->sale_date = now();
        $sale->total_amount = $request->total_amount;
        $sale->paid_amount = $request->paid_amount;
        $sale->discount = $request->discount;
        $sale->vat = $request->vat;
        $sale->status = 'completed';
        $sale->created_at = now();
        $sale->updated_at = now();
        $sale->save();

        $sale_id = $sale->id;

        $products = $request->products;
        foreach ($products as $product) {
            $remainingQty = $product['qty'];

            -- // Fetch Finished Goods from Production
            while ($remainingQty > 0) {
                $production = Production::where('product_id', $product['item_id'])
                    ->where('remaining_qty', '>', 0)
                    ->orderBy('created_at', 'asc')
                    ->first();

                if (!$production) {
                    throw new Exception("Not enough finished goods for Product ID: " . $product['item_id']);
                }

                -- // Deduct from production batch
                $deductQty = min($production->remaining_qty, $remainingQty);
                $production->decrement('remaining_qty', $deductQty);
                $remainingQty -= $deductQty;

                -- // Fetch sale price from product table (or directly from production)
                $salePrice = $product['sale_price']; // You can replace this with $production->sale_price if needed

                -- // Store sales details
                $salesDetail = new SalesDetails;
                $salesDetail->sales_id = $sale_id;
                $salesDetail->production_id = $production->id; // Track production batch
                $salesDetail->qty = $deductQty;
                $salesDetail->price = $salePrice;  // Price from production or product table
                $salesDetail->discount = $product['total_discount'];
                $salesDetail->created_at = now();
                $salesDetail->updated_at = now();
                $salesDetail->save();

                -- // Update stock
                $stock = new Stock();
                $stock->product_id = $product['item_id'];
                $stock->qty = -$deductQty;
                $stock->transaction_type_id = 2; // Sales deduction
                $stock->remark = "Sales Deduction";
                $stock->created_at = now();
                $stock->updated_at = now();
                $stock->warehouse_id = 1;
                $stock->save();
            }
        }

        DB::commit();
        return response()->json(['success' => "Sale successfully processed!"]);
    } catch (\Throwable $th) {
        DB::rollBack();
        return response()->json(['error' => $th->getMessage()]);
    }
}


-- CREATE TABLE productions (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     order_id INT NOT NULL,  -- Order from which the production is generated
--     product_id INT NOT NULL,  -- Product ID (raw material)
--     finished_goods_qty INT NOT NULL,  -- Finished goods produced
--     raw_material_qty INT NOT NULL,  -- Raw materials used
--     sale_price DECIMAL(10, 2),  -- Sale price of the finished goods (optional)
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
-- );



public function store(Request $request)
{
    try {
        DB::beginTransaction();

        -- // Create a sales record
        $sale = new SalesInvoice;
        $sale->customer_id = $request->customer_id;
        $sale->sale_date = now();
        $sale->total_amount = $request->total_amount;
        $sale->paid_amount = $request->paid_amount;
        $sale->discount = $request->discount;
        $sale->vat = $request->vat;
        $sale->status = 'completed';
        $sale->created_at = now();
        $sale->updated_at = now();
        $sale->save();

        $sale_id = $sale->id;

        $products = $request->products;

        foreach ($products as $product) {
            $remainingQty = $product['qty'];

            -- // 1. Deduct Raw Materials from Stock (via Product Lot)
            if ($product['product_type_id'] == 1) { // Raw material
                while ($remainingQty > 0) {
                    $lot = ProductLot::where('product_id', $product['item_id'])
                        ->where('qty', '>', 0)
                        ->orderBy('created_at', 'asc')
                        ->first();

                    if (!$lot) {
                        throw new Exception("Not enough raw material stock for Product ID: " . $product['item_id']);
                    }

                    -- // Deduct from lot
                    $deductQty = min($lot->qty, $remainingQty);
                    $lot->decrement('qty', $deductQty);
                    $remainingQty -= $deductQty;

                    -- // Record in Stock table (deduct stock)
                    $stock = new Stock();
                    $stock->product_id = $product['item_id'];
                    $stock->warehouse_id = 1;  // Assuming warehouse_id = 1 for simplicity
                    $stock->qty = -$deductQty;
                    $stock->transaction_type_id = 3; // Production (raw material consumption)
                    $stock->lot_id = $lot->id;
                    $stock->remark = "Raw Material Deduction";
                    $stock->created_at = now();
                    $stock->updated_at = now();
                    $stock->save();
                }
            }

            -- // 2. Produce Finished Goods (Increase Stock)
            if ($product['product_type_id'] == 2) { // Finished goods
                -- // Increase finished goods stock after production
                $production = new ProductionWorkOrder();
                $production->order_id = $request->order_id; -- from here 
                -- $production->product_id = $product['item_id'];
                -- $production->finished_goods_qty = $product['qty'];
                $production->raw_material_qty = $product['raw_material_qty']; --// Qty of raw material used in production
                $production->sale_price = $product['sale_price'];  --// Price after production (optional)
                $production->save();

                -- // Increase finished goods stock in ProductLot
                $finishedGoodsLot = new ProductLot();
                $finishedGoodsLot->product_id = $product['item_id'];
                $finishedGoodsLot->qty = $product['qty'];
                $finishedGoodsLot->sales_price = $product['sale_price'];
                $finishedGoodsLot->transaction_type_id = 2;  --// Finished goods
                $finishedGoodsLot->warehouse_id = 1;
                $finishedGoodsLot->description = "Finished goods from production";
                $finishedGoodsLot->save();

                -- // Record in Stock table (add stock)
                $stock = new Stock();
                $stock->product_id = $product['item_id'];
                $stock->warehouse_id = 1;
                $stock->qty = $product['qty'];
                $stock->transaction_type_id = 3; // Production (finished goods produced)
                $stock->lot_id = $finishedGoodsLot->id;
                $stock->remark = "Finished Goods Added";
                $stock->created_at = now();
                $stock->updated_at = now();
                $stock->save();
            }

            -- // 3. Create Sales Details and Deduct Finished Goods from Stock (when invoiced)
            $remainingQty = $product['qty'];
            while ($remainingQty > 0) {
                $finishedGoodsLot = ProductLot::where('product_id', $product['item_id'])
                    ->where('qty', '>', 0)
                    ->orderBy('created_at', 'asc')
                    ->first();

                if (!$finishedGoodsLot) {
                    throw new Exception("Not enough finished goods stock for Product ID: " . $product['item_id']);
                }

                $deductQty = min($finishedGoodsLot->qty, $remainingQty);
                $finishedGoodsLot->decrement('qty', $deductQty);
                $remainingQty -= $deductQty;

                -- // Store sales details
                $salesDetail = new SalesInvoiceDetails;
                $salesDetail->sales_id = $sale_id;
                $salesDetail->production_work_order_id = $production->id;  --// Link to production batch
                $salesDetail->qty = $deductQty;
                $salesDetail->price = $product['sale_price'];
                $salesDetail->%_of_discount = $product['p_discount'];--per product %
                $salesDetail->discount = $product['total_discount'];--per product discount
                $salesDetail->%_of_vat = $product['p_vat'];--per product %
                $salesDetail->vat = $product['total_vat'];--per product vat
                $salesDetail->created_at = now();
                $salesDetail->updated_at = now();
                $salesDetail->save();

                -- // Record in Stock table (sales deduction)
                $stock = new Stock();
                $stock->product_id = $product['item_id'];
                $stock->warehouse_id = 1;
                $stock->qty = -$deductQty;
                $stock->transaction_type_id = 2;  // Sales
                $stock->lot_id = $finishedGoodsLot->id;
                $stock->remark = "Finished Goods Sold";
                $stock->created_at = now();
                $stock->updated_at = now();
                $stock->save();
            }
        }

        DB::commit();
        return response()->json(['success' => "Sale and production successfully processed!"]);
    } catch (\Throwable $th) {
        DB::rollBack();
        return response()->json(['error' => $th->getMessage()]);
    }
}

SELECT SUM(quantity_used) AS total_quantity_used
FROM bom_details
WHERE bom_id = (
    SELECT id FROM bom WHERE order_id = (
        SELECT order_id FROM production_work_orders WHERE id = :work_order_id
    )
);

-- 12.03.25
<script>
    $(document).ready(function() {
        -- // Set CSRF token for AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        -- // When buyer is selected, get buyer details
        $('#buyer_id').on('change', function() {
            let buyer_id = $(this).val();

            $.ajax({
                url: "{{ url('find_buyer') }}",
                type: 'POST',
                data: {
                    id: buyer_id
                },
                success: function(res) {
                    if (res.buyer) {
                        $(".email").text(res.buyer.email);
                        $(".address").text(res.buyer.shipping_address);
                        $(".buyer_id").text(res.buyer.id);
                    } else {
                        $(".email").text('');
                        $(".address").text('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", error);
                    console.log(xhr.responseText); 
                }
            });
        });

        -- // When order is selected, get order details
        $('#order_id').on('change', function() {
            let order_id = $(this).val();

            $.ajax({
                url: "{{ url('find_order') }}",  // You will need to create this route
                type: 'POST',
                data: {
                    id: order_id
                },
                success: function(res) {
                    if (res.order) {
                        $(".invoice_id").text(res.order.order_number);
                        $(".sale_date").text(res.order.created_at);
                        -- // Additional order details (like buyer information for that order)
                    } else {
                        $(".invoice_id").text('');
                        $(".sale_date").text('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", error);
                    console.log(xhr.responseText);
                }
            });
        });

        -- // Add item to sales details table
        $(".add-item-btn").on('click', function() {
            let product = $(".product").val();
            let unit_price = $(".unit_price").val();
            let qty = $(".qty").val();
            let discount = $(".discount").val();
            let vat = $(".vat").val();
            let subtotal = (unit_price * qty) - discount + vat;

            let row = `<tr>
                <td>${product}</td>
                <td>${unit_price}</td>
                <td>${qty}</td>
                <td>${discount}</td>
                <td>${vat}</td>
                <td>${subtotal}</td>
                <td><button class="btn btn-danger remove-item-btn">Remove</button></td>
            </tr>`;

            $(".sales-details-table-body").append(row);

            -- // Clear input fields
            $(".product").val('');
            $(".unit_price").val('');
            $(".qty").val('');
            $(".discount").val('');
            $(".vat").val('');
        });

        -- // Remove item from sales details table
        $(document).on('click', '.remove-item-btn', function() {
            $(this).closest('tr').remove();
        });

        -- // Clear all items from the table
        $(".clearAll").on('click', function() {
            $(".sales-details-table-body").empty();
        });
    });
</script>
