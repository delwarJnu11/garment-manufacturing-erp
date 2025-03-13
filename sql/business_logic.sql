SELECT 
    po.id AS purchase_order_id,
    po.supplier_id,
    po.order_total,
    po.paid_amount,
    po.discount,
    po.vat,
    po.delivery_date,
    po.shipping_address,
    po.description AS purchase_order_description,
    l.id AS lot_id,
    l.raw_material_id,
    l.quantity AS lot_quantity,
    l.cost_price AS lot_cost_price,
    l.sales_price AS lot_sales_price, -- If applicable
    pd.id AS purchase_detail_id,
    pd.raw_material_id AS detail_raw_material_id,
    pd.quantity AS detail_quantity,
    pd.price AS detail_price,
    pd.discount_price AS detail_discount_price,
    pd.created_at AS detail_created_at
FROM purchase_orders po
JOIN lots l ON po.lot_id = l.id
JOIN purchase_details pd ON po.id = pd.purchase_id
ORDER BY po.id, pd.id;

-- Product_Lot TAble

-- <table border="1">
--     <thead>
--         <tr>
--             <th>id</th>
--             <th>raw_material_id</th>
--             <th>quantity</th>
--             <th>cost_price</th>
--             <th>warehouse_id</th>
--             <th>description</th>
--             <th>created_at</th>
--             <th>updated_at</th>
--         </tr>
--     </thead>
--     <tbody>
--         <tr>
--             <td>1</td>
--             <td>1</td>
--             <td>500</td>
--             <td>120.75</td>
--             <td>3</td>
--             <td>Batch of high-quality cotton fabric</td>
--             <td>2025-02-24 10:00:00</td>
--             <td>2025-02-24 10:00:00</td>
--         </tr>
--     </tbody>
-- </table>





-- purchase_order TABLE
-- <table border="1">
--     <thead>
--         <tr>
--             <th>id</th>
--             <th>supplier_id</th>
--             <th>lot_id</th>
--             <th>status_id</th>
--             <th>order_total</th>
--             <th>paid_amount</th>
--             <th>discount</th>
--             <th>vat</th>
--             <th>delivery_date</th>
--             <th>shipping_address</th>
--             <th>description</th>
--             <th>quantity</th>
--             <th>created_at</th>
--             <th>updated_at</th>
--         </tr>
--     </thead>
--     <tbody>
--         <tr>
--             <td>1</td>
--             <td>1</td>
--             <td>10</td>
--             <td>2</td>
--             <td>5000.00</td>
--             <td>1500.00</td>
--             <td>500.00</td>
--             <td>250.00</td>
--             <td>2025-03-10</td>
--             <td>123 Main Street, City</td>
--             <td>Order for 500 meters of cotton fabric</td>
--             <td>500</td>
--             <td>2025-02-24 12:00:00</td>
--             <td>2025-02-24 12:00:00</td>
--         </tr>
--     </tbody>
-- </table>




--puchase_order_details
-- <table border="1">
--     <thead>
--         <tr>
--             <th>id</th>
--             <th>purchase_id</th>
--             <th>lot_id</th>
--             <th>quantity</th>
--             <th>price</th>
--             <th>discount_price</th>
--             <th>created_at</th>
--             <th>updated_at</th>
--         </tr>
--     </thead>
--     <tbody>
--         <tr>
--             <td>1</td>
--             <td>1</td>
--             <td>10</td>
--             <td>50</td>
--             <td>100.50</td>
--             <td>5.00</td>
--             <td>2025-02-24 14:00:00</td>
--             <td>2025-02-24 14:00:00</td>
--         </tr>
--     </tbody>
-- </table>
