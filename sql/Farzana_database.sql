-- ========================================
-- 🚀 DATABASE: Order & Buyers Management
-- ========================================

CREATE DATABASE order_management;
USE order_management;

-- ==============================
-- 🟢 Customers Table
-- ==============================
CREATE TABLE customers (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    phone VARCHAR(50) NOT NULL,
    address TEXT NOT NULL,
    company_name VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- 🏷 Sample Data
INSERT INTO customers (name, email, phone, address, company_name) VALUES
('John Doe', 'john@example.com', '1234567890', '123 Main St, NY', 'ABC Corp'),
('Alice Smith', 'alice@example.com', '9876543210', '456 Elm St, CA', 'XYZ Ltd');

-- ==============================
-- 🔵 Order Status Table
-- ==============================
CREATE TABLE order_statuses (
    id TINYINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE NOT NULL
);

-- 🏷 Sample Data
INSERT INTO order_statuses (name) VALUES
('Pending'),
('Processing'),
('Completed'),
('Cancelled');

-- ==============================
-- 🟣 Orders Table
-- ==============================
CREATE TABLE orders (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    customer_id BIGINT NOT NULL,
    order_number VARCHAR(50) UNIQUE NOT NULL,
    order_date DATE NOT NULL,
    status_id TINYINT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (status_id) REFERENCES order_statuses(id)
);

-- 🏷 Sample Data
INSERT INTO orders (customer_id, order_number, order_date, status_id, total_amount) VALUES
(1, 'ORD-1001', '2025-02-23', 1, 150.00),
(2, 'ORD-1002', '2025-02-22', 3, 300.00);

-- ==============================
-- 🟠 Sizes Table
-- ==============================
CREATE TABLE sizes (
    id TINYINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE NOT NULL
);

-- 🏷 Sample Data
INSERT INTO sizes (name) VALUES
('Small'),
('Medium'),
('Large');

-- ==============================
-- 🔴 Colors Table
-- ==============================
CREATE TABLE colors (
    id TINYINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE NOT NULL
);

-- 🏷 Sample Data
INSERT INTO colors (name) VALUES
('Red'),
('Blue'),
('Green'),
('Black'),
('White');

-- ==============================
-- 🟡 Product Categories Table
-- ==============================
CREATE TABLE product_categories (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

-- 🏷 Sample Data
INSERT INTO product_categories (name) VALUES
('Clothing'),
('Electronics'),
('Furniture');

-- ==============================
-- 🟢 Products Table
-- ==============================
CREATE TABLE products (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    category_id BIGINT NOT NULL,
    description TEXT NOT NULL,
    stock_status BOOLEAN NOT NULL DEFAULT TRUE, -- TRUE = In Stock, FALSE = Out of Stock
    base_price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES product_categories(id)
);

-- 🏷 Sample Data
INSERT INTO products (name, category_id, description, stock_status, base_price) VALUES
('T-Shirt', 1, 'Cotton T-Shirt', TRUE, 20.00),
('Laptop', 2, 'Gaming Laptop', TRUE, 1500.00),
('Sofa', 3, 'Leather Sofa', FALSE, 700.00);

-- ==============================
-- 🟠 Product Variants (Size & Color)
-- ==============================
CREATE TABLE product_variants (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    product_id BIGINT NOT NULL,
    size_id TINYINT NOT NULL,
    color_id TINYINT NOT NULL,
    variant_name VARCHAR(255) NOT NULL, -- e.g., "Medium Red"
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (size_id) REFERENCES sizes(id),
    FOREIGN KEY (color_id) REFERENCES colors(id)
);

-- 🏷 Sample Data
INSERT INTO product_variants (product_id, size_id, color_id, variant_name) VALUES
(1, 2, 1, 'Medium Red'),
(1, 3, 2, 'Large Blue');

-- ==============================
-- 🔵 Order Items (Products in Orders)
-- ==============================
CREATE TABLE order_items (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    order_id BIGINT NOT NULL,
    product_variant_id BIGINT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_variant_id) REFERENCES product_variants(id)
);

-- 🏷 Sample Data
INSERT INTO order_items (order_id, product_variant_id, quantity, unit_price, total_price) VALUES
(1, 1, 2, 20.00, 40.00), -- 2 Medium Red T-Shirts
(2, 2, 1, 25.00, 25.00); -- 1 Large Blue T-Shirt

-- ==============================
-- 🟣 Payment Methods Table
-- ==============================
CREATE TABLE payment_methods (
    id TINYINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE NOT NULL
);

-- 🏷 Sample Data
INSERT INTO payment_methods (name) VALUES
('Cash'),
('Credit Card'),
('Bank Transfer');

-- ==============================
-- 🔴 Payments Table
-- ==============================
CREATE TABLE payments (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    order_id BIGINT NOT NULL,
    payment_date DATE NOT NULL,
    amount_paid DECIMAL(10,2) NOT NULL,
    method_id TINYINT NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Pending', 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (method_id) REFERENCES payment_methods(id)
);

-- 🏷 Sample Data
INSERT INTO payments (order_id, payment_date, amount_paid, method_id, status) VALUES
(1, '2025-02-23', 150.00, 2, 'Completed'),
(2, '2025-02-22', 100.00, 1, 'Pending');

-- ==============================
-- 🟠 Sales Reports Table (For Tracking Revenue)
-- ==============================
CREATE TABLE sales_reports (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    order_id BIGINT NOT NULL,
    total_revenue DECIMAL(10,2) NOT NULL,
    report_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

-- 🏷 Sample Data
INSERT INTO sales_reports (order_id, total_revenue, report_date) VALUES
(1, 150.00, '2025-02-23'),
(2, 300.00, '2025-02-22');




-- 1️⃣   Inventory & Warehouse Management Module
________________________________________

-- categories
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE category_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT,
    type_name VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE category_attributes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT,
    attribute_name VARCHAR(255),
    attribute_value VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--End categories


-- Product 

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Unique product ID
    name VARCHAR(255) NOT NULL, -- Product name
    sku VARCHAR(100) UNIQUE NOT NULL, -- Unique SKU for tracking
    description TEXT NULL, -- Product description
    unit_price DECIMAL(10,2) DEFAULT(0.00), -- Selling price per unit
    offer_price DECIMAL(10,2) DEFAULT(0.00), -- Discounted price
    weight INT NULL, -- Weight in grams/kilograms
    size_id INT, -- Reference to size table
    is_raw_material INT NOT NULL, -- 1 = Raw Material, 0 = Finished Product
    barcode VARCHAR(255) UNIQUE NULL, -- Barcode for scanning
    rfid VARCHAR(255) UNIQUE NULL, -- RFID for tracking
    category_id INT NOT NULL, -- Reference to categories table
    uom_id INT NOT NULL, -- Reference to unit_of_measurements table
    valuation_method_id INT NOT NULL, -- Reference to valuation_methods table
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE product_variants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL, -- Reference to products table
    variant_name VARCHAR(255) NOT NULL, -- Variant name (e.g., Small, Medium, Large)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE uom(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE status(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- warehouses Management
CREATE TABLE warehouses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL, -- Warehouse name
    location VARCHAR(255) NOT NULL, -- Warehouse location
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE storage_locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    warehouse_id INT NOT NULL, -- Reference to warehouses table
    location_name VARCHAR(255) NOT NULL, -- Section name (e.g., Aisle 1, Rack 2)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--End warehouses Management

-- Inventory Stock
CREATE TABLE stock_in (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL, -- Reference to products table
    warehouse_id INT NOT NULL, -- Reference to warehouses table
    quantity INT NOT NULL, -- Quantity received
    received_by INT NOT NULL, -- User ID of person receiving stock
    received_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date of receiving
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE stock_out (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL, -- Reference to products table
    warehouse_id INT NOT NULL, -- Reference to warehouses table
    quantity INT NOT NULL, -- Quantity shipped
    shipped_to VARCHAR(255) NOT NULL, -- Destination (e.g., Customer, Factory Unit)
    shipped_by INT NOT NULL, -- User ID of person shipping stock
    shipped_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date of shipping
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE stock_transfers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL, -- Reference to products table
    from_warehouse_id INT NOT NULL, -- From warehouse
    to_warehouse_id INT NOT NULL, -- To warehouse
    quantity INT NOT NULL, -- Quantity transferred
    transferred_by INT NOT NULL, -- User ID
    transferred_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Transfer date
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--END Inventory Stock

-- Inventory Valuation 
CREATE TABLE valuation_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    method_name VARCHAR(255) NOT NULL, -- FIFO, LIFO, Weighted Average
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE stock_ledger (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL, -- Reference to products table
    transaction_type VARCHAR(50) NOT NULL, -- Stock In, Stock Out, Transfer
    quantity INT NOT NULL, -- Quantity involved
    balance INT NOT NULL, -- Remaining stock balance
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date of transaction
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE inventory_audit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    warehouse_id INT NOT NULL, -- Reference to warehouses table
    product_id INT NOT NULL, -- Reference to products table
    counted_quantity INT NOT NULL, -- Quantity found during audit
    recorded_quantity INT NOT NULL, -- Expected quantity
    variance INT NOT NULL, -- Difference between counted and recorded
    audit_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date of audit
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--END Inventory Valuation 


-- END  Inventory & Warehouse Management Module


CREATE TABLE suppliers(
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(80) NOT NULL,
    last_name VARCHAR(80) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    phone VARCHAR(20) UNIQUE NOT NULL,
    address VARCHAR(255) NOT NULL,
    photo VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE purchases(
    id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_id INT NOT NULL,
    product_id INT NOT NULL,
    status_id int NOT NULL,
    order_total DECIMAL(10,2) DEFAULT(0.00) NOT NULL,
    paid_amount DECIMAL(10,2) DEFAULT(0.00),
    discount DECIMAL(10,2) DEFAULT(0.00),
    vat DECIMAL(10,2) DEFAULT(0.00),
    delivery_date DATE,
    shipping_address VARCHAR (255),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE purchase_returns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    purchase_id INT NOT NULL, -- Reference to purchases table
    supplier_id INT NOT NULL, -- Reference to suppliers table
    return_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_return_amount DECIMAL(10, 2) NOT NULL, -- Total return amount
    reason TEXT NULL, -- Reason for return
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE purchase_return_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    purchase_return_id INT NOT NULL, -- Reference to purchase_returns table
    product_id INT NOT NULL, -- Reference to products table
    quantity INT NOT NULL, -- Quantity returned
    price DECIMAL(10,2) DEFAULT(0.00) NOT NULL, -- Price per product
    total_return_price DECIMAL(10,2) NOT NULL, -- Total price of returned products
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE purchase_details(
    id INT AUTO_INCREMENT PRIMARY KEY,
    purchase_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) DEFAULT(0.00) NOT NULL,
    discount_price DECIMAL(10,2) DEFAULT(0.00),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- CREATE TABLE customers(
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     first_name VARCHAR(80) NOT NULL,
--     last_name VARCHAR(80) NOT NULL,
--     email VARCHAR(150) UNIQUE NOT NULL,
--     phone VARCHAR(20) UNIQUE NOT NULL,
--     address VARCHAR(255) NOT NULL,
--     photo VARCHAR(255) NOT NULL,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
-- );
________________________________________
-- 1.4 Inventory Table


CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    warehouse_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    min_stock_level INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
________________________________________
-- 1.5 Stock Movements Table


CREATE TABLE stock_movements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    warehouse_id INT NOT NULL,
    movement_type_id INT NOT NULL, -- Reference to movement_types table
    quantity INT NOT NULL,
    reference VARCHAR(255) NULL, -- GRN, invoice, transfer reference
    movement_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
________________________________________
-- 1.6 Stock Adjustment Table


CREATE TABLE stock_adjustment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    warehouse_id INT NOT NULL,
    adjustment_type_id INT NOT NULL, -- Reference to adjustment_types table
    quantity_adjusted INT NOT NULL,
    reason TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
________________________________________
-- 1.7 Valuation Methods Table


CREATE TABLE valuation_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    method_name VARCHAR(50) NOT NULL -- FIFO, LIFO, Weighted Average
);
________________________________________
-- 1.8 Stock Movement Types Table

CREATE TABLE movement_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL -- Receipt, Shipment, Transfer
);
________________________________________
-- 1.9 Stock Adjustment Types Table


CREATE TABLE adjustment_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL -- Damage, Loss, Manual Adjustment
);

CREATE TABLE low_stock_alerts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL, -- Reference to products table
    warehouse_id INT NOT NULL, -- Reference to warehouses table
    current_stock INT NOT NULL, -- Current stock level
    min_stock_level INT NOT NULL, -- Minimum stock level for the product
    alert_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date when the alert was triggered
    status VARCHAR(50) DEFAULT 'Pending', -- Status of the alert (e.g., Pending, Resolved)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--1 Product Module: Adding a Product

-- Step 1: Insert a new product into the `products` table.
INSERT INTO products (name, sku, description, unit_price, offer_price, weight, size_id, is_raw_material, barcode, rfid, category_attributes_id, uom_id, valuation_method_id, photo)
VALUES ('T-Shirt', 'TSH-001', 'Cotton T-shirt with logo', 10.99, 9.99, 200, 1, 0, '0123456789123', 'RFID123456', 1, 1, 1, 'tshirt.jpg');

-- Step 2: Insert category attributes (if needed) in the `category_attributes` table.
-- Assuming you are associating the product with a category (Men's Wear, Women's Wear).
INSERT INTO category_attributes (category_id, category_type_id, attribute_name, attribute_value)
VALUES (1, 1, 'Color', 'Red');

-- End of cycle 1: This cycle involves the `products` and `category_attributes` tables.
-- Tables involved: 2 (products, category_attributes)

-- Stock In Module: Receiving Stock into the Warehouse

-- Step 1: Insert a new stock entry into the `stock_in` table (when stock arrives at the warehouse).
INSERT INTO stock_in (product_id, quantity, warehouse_id, transaction_type_id, lot_id, description, received_by)
VALUES (1, 500, 1, 1, 1, 'Received new stock from Supplier A', 1);

-- Step 2: Update inventory levels for the received stock in the `inventory` table.
INSERT INTO inventory (warehouse_id, product_id, lot_id, quantity, min_stock_level, valuation_method_id)
VALUES (1, 1, 1, 500, 50, 1);  -- Assuming FIFO as the valuation method

-- End of cycle 2: This cycle involves the `stock_in` and `inventory` tables.
-- Tables involved: 2 (stock_in, inventory)

-- Purchase Module: Create a Purchase Order

-- Step 1: Insert a new purchase order into the `purchases` table.
INSERT INTO purchases (supplier_id, lot_id, status_id, order_total, paid_amount, discount, vat, delivery_date, shipping_address, description)
VALUES (1, 1, 1, 5000.00, 2500.00, 500.00, 250.00, '2025-02-28', 'Warehouse A, Dhaka', 'Bulk order of T-Shirts');

-- Step 2: Insert supplier details into the `suppliers` table (if not already added).
INSERT INTO suppliers (first_name, last_name, email, phone, address, photo)
VALUES ('John', 'Doe', 'supplier@example.com', '+8801712345678', '123 Main Street, Dhaka', 'john_doe.jpg');

-- End of cycle 3: This cycle involves the `purchases` and `suppliers` tables.
-- Tables involved: 2 (purchases, suppliers)


-- Product Variants Module: Creating Variants (e.g., different sizes/colors)

-- Step 1: Insert product variants (sizes/colors) into the `product_variants` table.
INSERT INTO product_variants (product_id, variant_name)
VALUES (1, 'Red - Small'), (1, 'Blue - Medium');

-- End of cycle 4: This cycle involves the `product_variants` table.
-- Tables involved: 1 (product_variants)

-- Stock Adjustment Module: Adjusting Stock

-- Step 1: Insert a new stock adjustment (for loss, damage, or correction) into the `stock_adjustment` table.
INSERT INTO stock_adjustment (product_id, warehouse_id, adjustment_type_id, quantity_adjusted, reason)
VALUES (1, 1, 1, -5, 'Lost during transport');  -- Adjustment type 1: Loss

-- End of cycle 5: This cycle involves the `stock_adjustment` table.
-- Tables involved: 1 (stock_adjustment)

-- Stock Transfer Module: Transferring Stock Between Warehouses

-- Step 1: Insert a new stock transfer record into the `stock_transfers` table.
INSERT INTO stock_transfers (from_warehouse_id, to_warehouse_id, transferred_by)
VALUES (1, 2, 1);  -- Transferring from Warehouse 1 to Warehouse 2

-- End of cycle 6: This cycle involves the `stock_transfers` table.
-- Tables involved: 1 (stock_transfers)


-- Purchase Returns Module: Returning Damaged Goods

-- Step 1: Insert a return record into the `purchase_returns` table.
INSERT INTO purchase_returns (purchase_id, supplier_id, total_return_amount, reason)
VALUES (1, 1, 1000.00, 'Defective items');

-- Step 2: Insert returned item details into the `purchase_return_details` table.
INSERT INTO purchase_return_details (purchase_return_id, product_id, quantity, price, total_return_price)
VALUES (1, 1, 10, 5.00, 50.00);  -- Returning 10 items, $5.00 each

-- End of cycle 7: This cycle involves the `purchase_returns` and `purchase_return_details` tables.
-- Tables involved: 2 (purchase_returns, purchase_return_details)

________________________________________
-- 2️⃣ Sales & Order Management Module
-- 2.1 Customers Table

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone_number VARCHAR(20) NULL,
    shipping_address TEXT NULL,
    billing_address TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
________________________________________
-- 2.2 Orders Table


CREATE TABLE statuses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE -- ('Pending', 'In Progress', 'Completed', 'Canceled') DEFAULT 'Pending',
);


CREATE TABLE orders ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    customer_id INT, 
    order_number VARCHAR(50) UNIQUE NOT NULL, 
    style_name VARCHAR(100), 
    fabric_type VARCHAR(100),
    color VARCHAR(50), 
    trims TEXT,
    order_quantity INT NOT NULL,
    delivery_date DATE, 
    status_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
);




CREATE TABLE order_sizes ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT, 
    size VARCHAR(20) NOT NULL, -- Example: S, M, L, XL quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);    
 



-- CREATE TABLE orders (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     customer_id INT,
--     order_number VARCHAR(50) UNIQUE NOT NULL,
--     style_name VARCHAR(100),
--     fabric_type VARCHAR(100),
--     color VARCHAR(50),
--     trims TEXT,
--     order_quantity INT NOT NULL,
--     size_breakdown JSON,
--     delivery_date DATE,
--     status ENUM('Pending', 'In Progress', 'Completed', 'Canceled') DEFAULT 'Pending',
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--     FOREIGN KEY (customer_id) REFERENCES customers(id)
-- );

CREATE TABLE order_returns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL, -- Reference to orders table
    customer_id INT NOT NULL, -- Reference to customers table
    return_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_return_amount DECIMAL(10, 2) NOT NULL, -- Total amount for the return
    reason TEXT NULL, -- Reason for return
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE order_return_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_return_id INT NOT NULL, -- Reference to order_returns table
    product_id INT NOT NULL, -- Reference to products table
    quantity INT NOT NULL, -- Quantity returned
    price DECIMAL(10,2) DEFAULT(0.00) NOT NULL, -- Price per product
    total_return_price DECIMAL(10,2) NOT NULL, -- Total price of returned products
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

________________________________________

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL
);
________________________________________
-- 2.4 Payments Table


CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    payment_method_id INT NOT NULL, -- Reference to payment_methods table
    payment_status_id INT NOT NULL, -- Reference to payment_statuses table
    amount DECIMAL(10,2) NOT NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
________________________________________
-- 2.5 Order Statuses Table

CREATE TABLE order_statuses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL -- New, Processing, Shipped, Delivered, Canceled
);
________________________________________
-- 2.6 Payment Statuses Table


CREATE TABLE payment_statuses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL -- Pending, Paid, Failed, Refunded
);
________________________________________

CREATE TABLE payment_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL -- Stripe, PayPal, Bank Transfer, Cash
);









--   {{-- Inventory & Warehouse mangement --}}
--                 <li class="submenu">
--                     <a href="javascript:void(0);">
--                         <i data-feather="shopping-bag"></i>
--                         <span>Inventory</span>
--                         <span class="menu-arrow"></span>
--                     </a>
--                     <ul>
--                         <li class="submenu">
--                             <a href="javascript:void(0);">
--                                 <i data-feather="layers"></i>
--                                 <span>Categories</span>
--                                 <span class="menu-arrow"></span>
--                             </a>
--                             <ul>
--                                 <li><a href="{{ url('/category') }}"> Category List</a></li>
--                                 <li><a href="{{ url('/categoryType') }}"> Category Types</a></li>
--                                 <li><a href="{{ url('/categories/add') }}"> Add Category</a></li>
--                                 <li><a href="{{ url('/categories/attributes') }}">Manage Attributes</a></li>
--                             </ul>
--                         </li>


--                         {{-- Warehouse mangement --}}
--                         <li class="submenu">
--                             <a href="javascript:void(0);">
--                                 <i data-feather="package"></i>
--                                 <span>Warehouse Management</span>

--                             </a>
--                             <ul>
--                                 <!-- Warehouses -->
--                                 <li class="submenu">
--                                     <a href="javascript:void(0);">
--                                         <i data-feather="home"></i>
--                                         <span>Warehouses</span>
--                                         <span class="menu-arrow"></span>
--                                     </a>
--                                     <ul>
--                                         <li><a href="{{ url('/warehouses') }}">Warehouse List</a></li>
--                                         <li><a href="{{ url('/warehouses/add') }}">Add Warehouse</a></li>
--                                     </ul>
--                                 </li>

--                                 <!-- Storage Locations -->
--                                 <li class="submenu">
--                                     <a href="javascript:void(0);">
--                                         <i data-feather="map"></i>
--                                         <span>Storage Locations</span>
--                                     </a>
--                                     <ul>
--                                         <li><a href="{{ url('/storage-locations') }}">Location List</a></li>
--                                         <li><a href="{{ url('/storage-locations/add') }}">Add Storage
--                                                 Location</a></li>
--                                     </ul>
--                                 </li>

--                                 <!-- Stock Movements -->
--                                 <li class="submenu">
--                                     <a href="javascript:void(0);">
--                                         <i data-feather="shuffle"></i>
--                                         <span>Stock Movements</span>
--                                         <span class="menu-arrow"></span>
--                                     </a>
--                                     <ul>
--                                         <li><a href="{{ url('/stock-movements/in') }}">Stock In (Goods Receipt
--                                                 Notes - GRN)</a></li>
--                                         <li><a href="{{ url('/stock-movements/out') }}">Stock Out
--                                                 (Shipments)</a></li>
--                                         <li><a href="{{ url('/stock-movements/transfers') }}">Stock
--                                                 Transfers</a></li>
--                                         <li><a href="{{ url('/stock-movements/adjustments') }}">Stock
--                                                 Adjustments</a></li>
--                                         <li><a href="{{ url('/stock-movements/adjust-levels') }}">Adjust Stock
--                                                 Levels</a></li>
--                                     </ul>
--                                 </li>
--                             </ul>
--                         </li>

--                         <li class="submenu">
--                             <a href="javascript:void(0);">
--                                 <i data-feather="shopping-bag"></i>
--                                 <span>Products</span>
--                                 <span class="menu-arrow"></span>
--                             </a>
--                             <ul>
--                                 <li><a href="{{ url('/products') }}">Product List</a></li>
--                                 <li><a href="{{ url('/products/create') }}"> Add Product</a></li>
--                                 <li><a href="{{ url('/products/variants') }}">Product Variants</a></li>
--                                 <li><a href="{{ url('uoms') }}">Units of Mesures</a></li>

--                                 <li><a href="{{ url('/products/pricing') }}"> Pricing & Costing</a></li>
--                                 <li><a href="{{ url('/products/stock') }}"> Stock Management</a></li>
--                                 <li><a href="{{ url('/products/barcode') }}"> Print Barcode & QR</a></li>
--                                 <li><a href="{{ url('/products/bom') }}">Bill of Materials (BOM)</a></li>
--                             </ul>
--                         </li>

--                         <li class="submenu">
--                             <a href="javascript:void(0);">
--                                 <i data-feather="dollar-sign"></i>
--                                 <span>Inventory Valuation</span>
--                                 <span class="menu-arrow"></span>
--                             </a>
--                             <ul>
--                                 <li><a href="{{ url('/inventory/valuation/fifo') }}">FIFO</a></li>
--                                 <li><a href="{{ url('/inventory/valuation/lifo') }}">LIFO</a></li>
--                                 <li><a href="{{ url('/inventory/valuation/weighted') }}">Weighted Average</a>
--                                 </li>
--                             </ul>
--                         </li>

--                         <!-- 📋 Inventory Reports -->
--                         <li class="submenu">
--                             <a href="javascript:void(0);">
--                                 <i data-feather="clipboard"></i>
--                                 <span>Inventory Reports</span>
--                                 <span class="menu-arrow"></span>
--                             </a>
--                             <ul>
--                                 <li><a href="{{ url('/inventory/reports/stock-ledger') }}"> Stock Ledger</a>
--                                 </li>
--                                 <li><a href="{{ url('/inventory/reports/audit') }}">Audit & Cycle
--                                         Counting</a></li>
--                             </ul>
--                         </li>
--                     </ul>
--                 </li>
--                 {{-- END Inventory & Warehouse mangement --}}

--                 {{-- Sale &  & Order Management --}}
--                 <li class="submenu">
--                     <a href="javascript:void(0);">
--                         <i data-feather="shopping-cart"></i>
--                         <span> Order & Customers<span class="menu-arrow"></span></span>
--                     </a>
--                     <ul>
--                         <!-- Orders -->
--                         <li class="submenu">
--                             <a href="javascript:void(0);">
--                                 <i data-feather="file-text"></i>
--                                 <span>Orders</span>
--                                 <span class="menu-arrow"></span>
--                             </a>
--                             <ul>
--                                 <li><a href="{{ url('/orders') }}">Order List</a></li>
--                                 <li><a href="{{ url('/orders/create') }}">Create Order</a></li>
--                                 <li><a href="{{ url('/orders/pending') }}">Pending Orders</a></li>
--                                 <li><a href="{{ url('/orders/completed') }}">Completed Orders</a></li>
--                                 <li><a href="{{ url('/orders/cancelled') }}">Cancelled Orders</a></li>
--                             </ul>
--                         </li>

--                         <!-- Customers -->
--                         <li class="submenu">
--                             <a href="javascript:void(0);">
--                                 <i data-feather="users"></i>
--                                 <span>Customers</span>
--                                 <span class="menu-arrow"></span>
--                             </a>
--                             <ul>
--                                 <li><a href="{{ url('/customers') }}">Customer List</a></li>
--                                 <li><a href="{{ url('/customers/add') }}">Add Customer</a></li>
--                                 <li><a href="{{ url('/customers/groups') }}">Customer Groups</a></li>
--                             </ul>
--                         </li>

--                         <!-- Invoices & Payments -->
--                         <li class="submenu">
--                             <a href="javascript:void(0);">
--                                 <i data-feather="credit-card"></i>
--                                 <span>Invoices & Payments</span>
--                                 <span class="menu-arrow"></span>
--                             </a>
--                             <ul>
--                                 <li><a href="{{ url('/invoices') }}">Invoices</a></li>
--                                 <li><a href="{{ url('/payments') }}">Payments</a></li>
--                                 <li><a href="{{ url('/refunds') }}">Refunds</a></li>
--                             </ul>
--                         </li>

--                         <!-- Sales Reports -->
--                         <li class="submenu">
--                             <a href="javascript:void(0);">
--                                 <i data-feather="bar-chart-2"></i>
--                                 <span>Sales Reports</span>
--                                 <span class="menu-arrow"></span>
--                             </a>
--                             <ul>
--                                 <li><a href="{{ url('/reports/sales') }}">Sales Summary</a></li>
--                                 <li><a href="{{ url('/reports/revenue') }}">Revenue Report</a></li>
--                                 <li><a href="{{ url('/reports/customers') }}">Customer Sales Report</a></li>
--                             </ul>
--                         </li>
--                     </ul>
--                 </li>
--                 {{-- END Sale &  & Order Management --}}

--                 {{-- Suppliers & purchase  --}}
--                 <li class="submenu">
--                     <a href="javascript:void(0);">
--                         <i data-feather="truck"></i>
--                         <span>Suppliers & Purchases<span class="menu-arrow"></span></span>
--                     </a>
--                     <ul>
--                         <!-- Suppliers -->
--                         <li class="submenu">
--                             <a href="">
--                                 <i data-feather="user-check"></i>
--                                 <span>Suppliers</span>
--                                 <span class="menu-arrow"></span>
--                             </a>
--                             <ul>
--                                 <li><a href="{{ url('/suppliers') }}">Supplier List</a></li>
--                                 <li><a href="{{ url('/suppliers/add') }}">Add Supplier</a></li>
--                                 <li><a href="{{ url('/suppliers/contracts') }}">Supplier Contracts</a></li>
--                             </ul>
--                         </li>

--                         <!-- Purchase Orders -->
--                         <li class="submenu">
--                             <a href="javascript:void(0);">
--                                 <i data-feather="file-text"></i>
--                                 <span>Purchase Orders</span>
--                                 <span class="menu-arrow"></span>
--                             </a>
--                             <ul>
--                                 <li><a href="{{ url('/purchases') }}">Purchase Order List</a></li>
--                                 <li><a href="{{ url('/purchases/create') }}">Create Purchase Order</a></li>
--                                 <li><a href="{{ url('/purchases/pending') }}">Pending Purchases</a></li>
--                                 <li><a href="{{ url('/purchases/completed') }}">Completed Purchases</a></li>
--                             </ul>
--                         </li>

--                         <!-- Payments -->
--                         <li class="submenu">
--                             <a href="javascript:void(0);">
--                                 <i data-feather="credit-card"></i>
--                                 <span>Payments</span>
--                                 <span class="menu-arrow"></span>
--                             </a>
--                             <ul>
--                                 <li><a href="{{ url('/payments/suppliers') }}">Supplier Payments</a></li>
--                                 <li><a href="{{ url('/payments/pending') }}">Pending Payments</a></li>
--                                 <li><a href="{{ url('/payments/completed') }}">Completed Payments</a></li>
--                             </ul>
--                         </li>

--                         <!-- Purchase Reports -->
--                         <li class="submenu">
--                             <a href="javascript:void(0);">
--                                 <i data-feather="bar-chart-2"></i>
--                                 <span>Purchase Reports</span>
--                                 <span class="menu-arrow"></span>
--                             </a>
--                             <ul>
--                                 <li><a href="{{ url('/reports/purchases') }}">Purchase Summary</a></li>
--                                 <li><a href="{{ url('/reports/supplier-performance') }}">Supplier
--                                         Performance</a></li>
--                             </ul>
--                         </li>
--                     </ul>
--                 </li>
--                 {{-- END Suppliers & purchase  --}}























. Category Attributes
category_id links to a category table (not included in the script).
category_type_id links to a category type (presumably another table).
2. Products
category_attributes_id references category_attributes.id.
size_id might reference a sizes table (not shown).
uom_id references uom.id (Unit of Measurement).
valuation_method_id references valuation_methods.id (FIFO/LIFO methods).
3. Product Variants
product_id references products.id.
4. UOM (Unit of Measurement)
Standalone table, used by products to define units (e.g., pieces, kilograms).



5. Status (Order/Purchase Status)
Standalone table, linked to purchases/orders by status_id.
6. Warehouses
Standalone table, used by inventory, stock_in, stock_transfers, etc.
7. Lots
product_id links to products.id.
warehouse_id links to warehouses.id.
transaction_type_id (not shown, could be linked to a transaction types table).
8. Stock In
product_id links to products.id.
warehouse_id links to warehouses.id.
lot_id links to lots.id.
transaction_type_id links to transaction_types.id (not shown).
9. Stock Transfers
from_warehouse_id and to_warehouse_id link to warehouses.id.
10. Inventory
warehouse_id links to warehouses.id.
product_id links to products.id.
lot_id links to lots.id (for batch tracking).
valuation_method_id links to valuation_methods.id (FIFO/LIFO).
11. Suppliers
Standalone table, linked by supplier_id to purchases, purchase_returns, etc.
12. Purchases
supplier_id links to suppliers.id.
lot_id links to lots.id.
status_id links to status.id.
13. Purchase Returns
purchase_id links to purchases.id.
supplier_id links to suppliers.id.
14. Stock Adjustment
product_id links to products.id.
warehouse_id links to warehouses.id.
adjustment_type_id links to adjustment_types.id (Damage, Loss, etc.).
15. Valuation Methods
Used by products and inventory to determine stock valuation method (FIFO/LIFO).
16. Adjustment Types
Used in the stock_adjustment table to categorize the type of adjustment (e.g., damage, loss).


Based on the tables you provided, here s the relational structure that links them:

1. Category Attributes
category_id links to a category table (not included in the script).
category_type_id links to a category type (presumably another table).
2. Products
category_attributes_id references category_attributes.id.
size_id might reference a sizes table (not shown).
uom_id references uom.id (Unit of Measurement).
valuation_method_id references valuation_methods.id (FIFO/LIFO methods).
3. Product Variants
product_id references products.id.
4. UOM (Unit of Measurement)
Standalone table, used by products to define units (e.g., pieces, kilograms).
5. Status (Order/Purchase Status)
Standalone table, linked to purchases/orders by status_id.
6. Warehouses
Standalone table, used by inventory, stock_in, stock_transfers, etc.
7. Lots
product_id links to products.id.
warehouse_id links to warehouses.id.
transaction_type_id (not shown, could be linked to a transaction types table).
8. Stock In
product_id links to products.id.
warehouse_id links to warehouses.id.
lot_id links to lots.id.
transaction_type_id links to transaction_types.id (not shown).
9. Stock Transfers
from_warehouse_id and to_warehouse_id link to warehouses.id.
10. Inventory
warehouse_id links to warehouses.id.
product_id links to products.id.
lot_id links to lots.id (for batch tracking).
valuation_method_id links to valuation_methods.id (FIFO/LIFO).
11. Suppliers
Standalone table, linked by supplier_id to purchases, purchase_returns, etc.
12. Purchases
supplier_id links to suppliers.id.
lot_id links to lots.id.
status_id links to status.id.
13. Purchase Returns
purchase_id links to purchases.id.
supplier_id links to suppliers.id.
14. Stock Adjustment
product_id links to products.id.
warehouse_id links to warehouses.id.
adjustment_type_id links to adjustment_types.id (Damage, Loss, etc.).
15. Valuation Methods
Used by products and inventory to determine stock valuation method (FIFO/LIFO).
16. Adjustment Types
Used in the stock_adjustment table to categorize the type of adjustment (e.g., damage, loss).

