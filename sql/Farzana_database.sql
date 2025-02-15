-- 1️⃣   Inventory & Warehouse Management Module
________________________________________

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    sku VARCHAR(100) UNIQUE NOT NULL,
    description TEXT NULL,
    unit_price DECIMAL(10,2) DEFAULT(0.00),
    offer_price DECIMAL(10,2) DEFAULT(0.00),
    description varchar (200),
    weight INT,
    size_id INT,
    is_raw_material INT NOT NULL,
    barcode VARCHAR(255) UNIQUE NULL,
    rfid VARCHAR(255) UNIQUE NULL,
    category_id INT NOT NULL,
    manufacturer_id INT NOT NULL,
    uom_id INT NOT NULL, -- e.g., pcs, kg, liters
    valuation_method_id INT NOT NULL, -- Reference to valuation_methods table
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Category Type Table (Finished Goods, Work-in-Process)
CREATE TABLE category_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE -- Example: 'Finished Goods', 'Work-in-Process'
);

-- Categories Table (Jeans, T-Shirts, etc.)
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_type_id INT NOT NULL,   -- Links to category_types table
    name VARCHAR(255) NOT NULL,      -- Example: 'Jeans', 'T-Shirts'
    description TEXT DEFAULT NULL,   -- Description of the category
    status_id INT NOT NULL,          -- Links to category_status table
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Status Table (Active, Inactive)
CREATE TABLE statuses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE -- Example: 'Active', 'Inactive'
);



-- Attributes Table
CREATE TABLE category_attributes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    attribute_name VARCHAR(255) NOT NULL UNIQUE, -- Example: 'Size', 'Color', 'Fabric Type'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Category Attributes Mapping Table (To support multiple attributes per category)
CREATE TABLE category_attribute_values (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    attribute_id INT NOT NULL,
    attribute_value VARCHAR(255) NOT NULL, -- Example: 'Large', 'Red', 'Cotton'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);





CREATE TABLE manufacturers(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR (100),
    phone VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    address VARCHAR(200),
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

CREATE TABLE warehouses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    location TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

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
    customer_id INT NOT NULL,
    order_status_id INT NOT NULL, -- Reference to order_statuses table
    total_amount DECIMAL(10,2) NOT NULL,
    payment_status_id INT NOT NULL, -- Reference to payment_statuses table
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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