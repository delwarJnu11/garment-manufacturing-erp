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

CREATE TABLE statuses(
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



CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    order_number VARCHAR(50) UNIQUE NOT NULL,
    style_name VARCHAR(100),
    fabric_type VARCHAR(100),
    color VARCHAR(50),
    trims TEXT,
    order_quantity INT NOT NULL,
    size_breakdown JSON,
    delivery_date DATE,
    status ENUM('Pending', 'In Progress', 'Completed', 'Canceled') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

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
2.3 Order Items Table
Stores items in an order.
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
2.7 Payment Methods Table
Stores available payment methods.
CREATE TABLE payment_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL -- Stripe, PayPal, Bank Transfer, Cash
);


                       📦 Inventory & Warehouse Management
1️⃣
 Dashboard


 
-- Inventory Overview
--  Stock Analytics

--  Products Management

--  Product Categories
--  Products List
-- Barcode & RFID Lookup

--  Warehouse Management

--  Warehouses
--  Storage Locations

--  Stock Movements

--   Stock In (Goods Receipt Notes - GRN)
--   Stock Out (Shipments)
--   Stock Transfers
--  Stock Adjustments 
--   Adjust Stock Levels
-- Manual Stock Updates
-- 6️⃣ Inventory Valuation

-- 💰 FIFO, LIFO, Weighted Average
-- 📄 Valuation Reports
-- 7️⃣ Suppliers & Purchases

-- 🏢 Suppliers
-- 🛒 Purchases
-- 📑 Purchase Details
-- 8️⃣ Reorder & Alerts

-- 🚨 Low Stock Alerts
-- 📌 Reorder Management
-- 9️⃣ Reports & Audits

-- 📋 Inventory Reports
-- 🔍 Stock Ledger
-- ✅ Audit & Cycle Counting
-- 🔟 Settings & Configurations

-- ⚙️ Inventory Rules
-- 🔗 Integration Settings
-- 🛒 Sales & Order Management
-- 1️⃣ Dashboard

-- 📊 Sales Overview
-- 📈 Sales Reports
--  Customers

--  Customer List
-- 📞 Contact Details
-- 3️ Orders Management

--  New Orders
--  Order Tracking
--  Order Fulfillment
-- 4️ Payments & Invoices

--  Payments
--  Invoices
-- 5️ Sales Analytics

--  Reports & Insights
--  Order Trends
-- 6️ Discounts & Promotions

-- 🎟️ Coupons
--  Special Offers
-- 7️ Settings & Configurations

--  Payment Methods
-- 🔗 API Integration