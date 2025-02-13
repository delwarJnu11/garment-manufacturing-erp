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
    size INT,
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



CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
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



