/**
* GARMENTS MANUFACTURING ERP SOFTWARE
* INVENTORY & WAREHOUSE MODULE SQL FILE
* SALES & ORDER MODULE SQL FILE
* Author: FARZANA AKTER
*/

-- GARMENTS Profile
CREATE TABLE garment_profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL-- Stores the name of the company.
    established_year INT,-- Year the company was established.
    company_type VARCHAR(255),-- Type of company (e.g., Garments Manufacturer, Exporter).
    business_address VARCHAR(255),-- The physical address of the factory.
    head_office VARCHAR(255),-- head_office: The head office address.
    contact_number VARCHAR(20),-- contact_number: Company contact phone number.
    email VARCHAR(100),-- email: Official company email address.
    website VARCHAR(255),-- website: Link to the company's website.
    factory_size VARCHAR(100),-- factory_size: Size of the factory (in square feet or meters).
    production_capacity VARCHAR(255),
-- production_capacity: The monthly production capacity (e.g., "500,000 pcs/month").
    number_of_employees INT,-- Total number of employees in the company.
    machinery_equipment TEXT,-- List or details of key machinery and equipment used.
    product_categories TEXT,-- Types of garments produced (e.g., T-shirts, Polo Shirts).
    export_markets TEXT,--- Markets where the company exports (e.g., USA, Europe).
    major_buyers TEXT,-- List of major buyers/brands.
    certifications TEXT,--: Certifications obtained (e.g., ISO, WRAP).
    sustainability_initiatives TEXT,--Eco-friendly practices, energy, and water conservation.
    compliance_standards TEXT,-- Ethical sourcing and compliance standards.
    lead_time VARCHAR(100),-- Standard production lead time.
    shipping_logistics TEXT,-- Details about shipping and logistics methods.
    payment_terms VARCHAR(100)-- Accepted payment methods (e.g., LC, TT, Cash).
);

-- 1️⃣   Inventory & Warehouse Management Module
________________________________________

CREATE TABLE category_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT,
    type_name VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- categories
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE category_attributes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT,
    category_type_id INT,
    attribute_name VARCHAR(255),
    attribute_value VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--End categories


-- Product 
-- Table: Products (Stores product details)
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    name VARCHAR(255) NOT NULL, -- 'T-Shirt', 'Jeans', 'Jacket'
    sku VARCHAR(100) UNIQUE NOT NULL, -- 'TSH-001', 'JNS-002', 'JKT-003'
    description TEXT NULL, -- 'Cotton T-shirt with logo'
    unit_price DECIMAL(10,2) DEFAULT(0.00), -- 10.99, 25.50, 40.00
    offer_price DECIMAL(10,2) DEFAULT(0.00), -- 9.99, 22.00, 38.00
    weight INT NULL, -- 200 (grams), 500, 1000
    size_id INT, -- 1 (S), 2 (M), 3 (L)
    is_raw_material TINYINT NOT NULL, -- 1 (Yes - Fabric), 0 (No - Finished Goods)
    barcode VARCHAR(255) UNIQUE NULL, -- '0123456789123'
    rfid VARCHAR(255) UNIQUE NULL, -- 'RFID123456'
    category_attributes_id INT NOT NULL, -- 1 (Men's Wear), 2 (Women's Wear)
    uom_id INT NOT NULL, -- 1 (Pieces), 2 (Kilograms)
    valuation_method_id INT NOT NULL, -- 1 (FIFO), 2 (LIFO)
    photo VARCHAR(200), -- 'tshirt.jpg', 'jeans.jpg'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: Product Variants (Different sizes/colors)
CREATE TABLE product_variants (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    product_id INT NOT NULL, -- 1 (T-Shirt), 2 (Jeans)
    variant_name VARCHAR(255) NOT NULL, -- 'Red - Small', 'Blue - Medium'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: UOM (Unit of Measurement)
CREATE TABLE uoms (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    name VARCHAR(100) NOT NULL -- 'Pieces', 'Kilograms', 'Liters'
);

-- Table: Status (Order/Purchase Status)
CREATE TABLE status (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    name VARCHAR(100) NOT NULL -- 'Pending', 'Approved', 'Rejected'
);

-- Table: Warehouses (Storage locations)
CREATE TABLE warehouses (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    name VARCHAR(255) NOT NULL, -- 'Main Warehouse', 'Secondary Storage'
    location VARCHAR(255) NOT NULL -- 'Dhaka, Bangladesh'
);

-- Table: Lots (Batch Tracking)
CREATE TABLE lots (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    product_id INT NOT NULL, -- 1 (T-Shirt), 2 (Jeans)
    quantity INT NOT NULL, -- 500, 1000, 250
    cost_price DECIMAL(10,2), -- 5.50, 20.00, 15.75
    sales_price DECIMAL(10,2), -- 10.99, 25.50, 40.00
    warehouse_id INT NOT NULL, -- 1 (Main Warehouse)
    transaction_type_id INT, -- 1 (Stock In), 2 (Sales)
    description TEXT, -- 'New stock received from supplier'
    expiration_date DATE NULL, -- '2025-12-31' (for perishable stock)
);

-- Table: Stock Movement (Stock In)
CREATE TABLE stock_in (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    product_id INT NOT NULL, -- 1 (T-Shirt), 2 (Jeans)
    quantity INT NOT NULL, -- 500, 200
    warehouse_id INT NOT NULL, -- 1 (Main Warehouse)
    transaction_type_id INT, -- 1 (Purchase), 2 (Return)
    lot_id INT, -- 1 (Batch 001)
    description TEXT, -- 'Received new stock from Supplier A'
    received_by INT NOT NULL, -- 1 (Admin), 2 (Warehouse Staff)
    received_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: Stock Transfers (Movement between warehouses)
CREATE TABLE stock_transfers (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    from_warehouse_id INT NOT NULL, -- 1 (Main Warehouse)
    to_warehouse_id INT NOT NULL, -- 2 (Outlet Store)
    transferred_by INT NOT NULL, -- 1 (Admin)
    transferred_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: Inventory (Current Stock Levels)
CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    warehouse_id INT NOT NULL, -- 1 (Main Warehouse)
    product_id INT NOT NULL, -- 1 (T-Shirt)
    lot_id INT NULL, -- 1 (Batch 001)
    quantity INT NOT NULL DEFAULT 0, -- 1000, 500
    min_stock_level INT NOT NULL DEFAULT 0, -- 50 (Reorder level)
    valuation_method_id INT NOT NULL DEFAULT 1, -- 1 (FIFO), 2 (LIFO)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: Suppliers
CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    first_name VARCHAR(80) NOT NULL, -- 'John'
    last_name VARCHAR(80) NOT NULL, -- 'Doe'
    email VARCHAR(150) UNIQUE NOT NULL, -- 'supplier@example.com'
    phone VARCHAR(20) UNIQUE NOT NULL, -- '+8801712345678'
    address VARCHAR(255) NOT NULL, -- '123 Main Street, Dhaka'
    photo VARCHAR(255) NOT NULL, -- 'john_doe.jpg'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: Purchases (Orders from Suppliers)
CREATE TABLE purchases (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    supplier_id INT NOT NULL, -- 1 (Supplier A)
    lot_id INT NULL, -- 1 (Batch 001)
    status_id INT NOT NULL, -- 1 (Pending), 2 (Approved)
    order_total DECIMAL(10,2) DEFAULT(0.00) NOT NULL, -- 5000.00
    paid_amount DECIMAL(10,2) DEFAULT(0.00), -- 2500.00
    discount DECIMAL(10,2) DEFAULT(0.00), -- 500.00
    vat DECIMAL(10,2) DEFAULT(0.00), -- 250.00
    delivery_date DATE, -- '2025-02-28'
    shipping_address VARCHAR(255), -- 'Warehouse A, Dhaka'
    description TEXT, -- 'Bulk order of T-Shirts'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    warehouse_id INT NOT NULL,  -- Store warehouse ID manually (No FK)
    product_id INT NOT NULL,  -- Store product ID manually (No FK)
    quantity INT NOT NULL DEFAULT 0,  -- Current stock level
    min_stock_level INT NOT NULL DEFAULT 0,  -- Minimum stock before reorder
    
    -- NEW ADDITIONS:
    lot_id INT NULL,  -- Lot tracking (helps with FIFO/LIFO)
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Last update time

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Table: Purchase Returns
CREATE TABLE purchase_returns (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    purchase_id INT NOT NULL, -- 1 (Purchase 001)
    supplier_id INT NOT NULL, -- 1 (Supplier A)
    return_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_return_amount DECIMAL(10, 2) NOT NULL, -- 1000.00
    reason TEXT NULL, -- 'Defective items'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- Table: Purchase Return Details (Tracks returned items in purchase returns)
CREATE TABLE purchase_return_details (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    purchase_return_id INT NOT NULL, -- Reference to purchase_returns table (1, 2, 3)
    product_id INT NOT NULL, -- Reference to products table (101, 102)
    quantity INT NOT NULL, -- 10, 5, 2 (Number of items returned)
    price DECIMAL(10,2) DEFAULT(0.00) NOT NULL, -- 5.00, 10.99 (Price per product)
    total_return_price DECIMAL(10,2) NOT NULL, -- 50.00, 54.95 (Total returned value)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table: Stock Adjustment (Records stock changes due to loss, damage, or corrections)
CREATE TABLE stock_adjustment (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    product_id INT NOT NULL, -- 101 (T-Shirt)
    warehouse_id INT NOT NULL, -- 1 (Main Warehouse)
    adjustment_type_id INT NOT NULL, -- 1 (Loss), 2 (Damage), 3 (Correction)
    quantity_adjusted INT NOT NULL, -- -5 (Lost 5), 3 (Added 3 due to correction)
    reason TEXT NULL, -- 'Stock lost during transport'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: Stock Adjustment Details (More granular breakdown of stock adjustments)
CREATE TABLE stock_adjustment_details (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    product_id INT NOT NULL, -- 101 (T-Shirt)
    warehouse_id INT NOT NULL, -- 1 (Main Warehouse)
    adjustment_type_id INT NOT NULL, -- 1 (Loss), 2 (Damage), 3 (Correction)
    quantity_adjusted INT NOT NULL, -- -5 (Lost 5), 3 (Added 3 due to correction)
    reason TEXT NULL, -- 'Damaged items returned'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: Valuation Methods (Defines inventory valuation methods like FIFO, LIFO)
CREATE TABLE valuation_methods (
    id INT AUTO_INCREMENT PRIMARY KEY, -- 1, 2, 3...
    method_name VARCHAR(50) NOT NULL -- 'FIFO', 'LIFO', 'Weighted Average'
);


________________________________________
-- 1.6 Stock Adjustment Table


CREATE TABLE adjustment_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL -- Damage, Loss, Manual Adjustment
);

________________________________________

-- CREATE TABLE storage_locations (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     warehouse_id INT NOT NULL, -- Reference to warehouses table
--     location_name VARCHAR(255) NOT NULL, -- Section name (e.g., Aisle 1, Rack 2)
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
-- );

-- CREATE TABLE stock_ledger (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     product_id INT NOT NULL, -- Reference to products table
--     transaction_type VARCHAR(50) NOT NULL, -- Stock In, Stock Out, Transfer
--     quantity INT NOT NULL, -- Quantity involved
--     balance INT NOT NULL, -- Remaining stock balance
--     transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date of transaction
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
-- );
-- 1.5 Stock Movements Table


-- CREATE TABLE stock_movements (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     product_id INT NOT NULL,
--     warehouse_id INT NOT NULL,
--     movement_type_id INT NOT NULL, -- Reference to movement_types table
--     quantity INT NOT NULL,
--     reference VARCHAR(255) NULL, -- GRN, invoice, transfer reference
--     movement_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- CREATE TABLE stock_out (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     product_id INT NOT NULL, -- Reference to products table
--     warehouse_id INT NOT NULL, -- Reference to warehouses table
--     quantity INT NOT NULL, -- Quantity shipped
--     shipped_to VARCHAR(255) NOT NULL, -- Destination (e.g., Customer, Factory Unit)
--     shipped_by INT NOT NULL, -- User ID of person shipping stock
--     shipped_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date of shipping
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
-- );

-- CREATE TABLE low_stock_alerts (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     product_id INT NOT NULL, -- Reference to products table
--     warehouse_id INT NOT NULL, -- Reference to warehouses table
--     current_stock INT NOT NULL, -- Current stock level
--     min_stock_level INT NOT NULL, -- Minimum stock level for the product
--     alert_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Date when the alert was triggered
--     status VARCHAR(50) DEFAULT 'Pending', -- Status of the alert (e.g., Pending, Resolved)
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
-- );

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



/**
* GARMENTS MANUFACTURING ERP SOFTWARE
* PRODUCTION MODULE SQL FILE
* Author: DELWAR HOSSAIN
*/


CREATE TABLE production_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    production_plan_status_id INT NOT NULL,
    production_line VARCHAR(50),
    daily_target INT,
    allocated_machines INT,
    allocated_workers INT,
    start_date DATE,
    end_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    -- FOREIGN KEY (order_id) REFERENCES orders(id)
    -- FOREIGN KEY (production_plan_status_id) REFERENCES production_plan_statuses(id)
);

CREATE TABLE production_plan_statuses(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCH AR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE production_work_sections(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE production_work_statuses(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE production_work_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    production_plan_id INT,
    production_work_section_id INT NOT NULL,
    production_work_status_id INT NOT NULL,--('Pending', 'Completed') DEFAULT 'Pending',
    assigned_to INT,
    target_quantity INT,
    actual_quantity INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- FOREIGN KEY (order_id) REFERENCES orders(id),
    -- FOREIGN KEY (production_plan_id) REFERENCES production_plans(id),
    -- FOREIGN KEY (production_work_status_id) REFERENCES production_work_statuses(id),
    -- FOREIGN KEY (assigned_to) REFERENCES users(id)
);


-- BOM

CREATE TABLE bom (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    material_cost DECIMAL(10,2),
    labor_cost DECIMAL(10,2),
    overhead_cost DECIMAL(10,2),
    utility_cost DECIMAL(10,2),
    total_cost DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    -- FOREIGN KEY (order_id) REFERENCES orders(id)
);


CREATE TABLE bom_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bom_id INT,
    material_id INT,
    quantity_used DECIMAL(10,2),
    unit_cost
    wastage DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    -- FOREIGN KEY (order_id) REFERENCES orders(id),
    -- FOREIGN KEY (material_id) REFERENCES materials(id)
);



-- Cost Estimation & Control
CREATE TABLE prodcution_cost_estimations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    bom_id INT,
    material_cost DECIMAL(10,2),
    labor_cost DECIMAL(10,2),
    overhead_cost DECIMAL(10,2),
    utility_cost DECIMAL(10,2),
    total_cost DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    -- FOREIGN KEY (order_id) REFERENCES orders(id)
);


CREATE TABLE material_usage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    material_id INT,
    quantity_used DECIMAL(10,2),
    unit_cost
    wastage DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    -- FOREIGN KEY (order_id) REFERENCES orders(id),
    -- FOREIGN KEY (material_id) REFERENCES materials(id)
);

-- CREATE TABLE materials (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(100) NOT NULL,
--     type ENUM('Fabric', 'Trim', 'Accessory') NOT NULL,
--     supplier_id INT,
--     unit_price DECIMAL(10,2),
--     wastage_allowance DECIMAL(5,2),
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

--     -- FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
-- );



-- Production Floor Management
CREATE TABLE cutting_section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    fabric_used DECIMAL(10,2),
    panels_cut INT,
    defective_pieces INT,
    status ENUM('Pending', 'Completed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    -- FOREIGN KEY (order_id) REFERENCES orders(id)
);

CREATE TABLE sewing_section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    tasks_completed INT,
    machine_downtime DECIMAL(10,2),
    operator_performance DECIMAL(10,2),
    defect_count INT,
    status ENUM('Pending', 'Completed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    -- FOREIGN KEY (order_id) REFERENCES orders(id)
);

CREATE TABLE finishing_section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    inspections_done INT,
    pressing_done INT,
    packaging_done INT,
    shipment_ready BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    -- FOREIGN KEY (order_id) REFERENCES orders(id)
);

-- Wastage Management
CREATE TABLE wastage_type(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE wastage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    wastage_type_id INT NOT NULL, --ENUM('Material', 'Production'),
    quantity DECIMAL(10,2),
    reason TEXT,
    cost DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    -- FOREIGN KEY (order_id) REFERENCES orders(id)
);

-- Quality Control
CREATE TABLE quality_inspections_stages(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE quality_inspections_statuses(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE quality_inspections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    quality_inspections_stage_id INT NOT NULL, --ENUM('Inline', 'Final') NOT NULL,
    quality_inspections_status_id INT NOT NULL, --ENUM('Passed', 'Failed', 'Rework') DEFAULT 'Passed',
    AQL_level VARCHAR(10),
    defects_found INT,
    rework_needed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    -- FOREIGN KEY (order_id) REFERENCES orders(id)
    -- FOREIGN KEY (quality_inspections_stage_id) REFERENCES quality_inspections_stages(id)
    -- FOREIGN KEY (quality_inspections_status_id) REFERENCES quality_inspections_statuses(id)
);

CREATE TABLE defect_severity(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE defects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    inspection_id INT,
    defect_severity_id INT NOT NULL, --ENUM('Minor', 'Major', 'Critical'),
    defect_type VARCHAR(100),
    corrective_action TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    -- FOREIGN KEY (inspection_id) REFERENCES quality_inspections(id)
    -- FOREIGN KEY (defect_severity_id) REFERENCES defect_severity(id)
);

-- Reporting & Security
CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    report_type VARCHAR(50),
    generated_by INT,
    data JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- FOREIGN KEY (generated_by) REFERENCES users(id)
);

CREATE TABLE audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(255),
    module_affected VARCHAR(100),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    config_name VARCHAR(100),
    config_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



/**
* GARMENTS MANUFACTURING ERP SOFTWARE
* ACCOUNTS & FINANCE MODULE SQL FILE
* Author: HELAL UDDIN
*/


CREATE TABLE chart_of_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_code VARCHAR(50),
    account_name VARCHAR(255),
    account_type VARCHAR(50),
    -- account_type ENUM('Asset', 'Liability', 'Equity', 'Income', 'Expense'),
    parent_account_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    -- FOREIGN KEY (parent_account_id) REFERENCES chart_of_accounts(account_id)

);

CREATE TABLE account_types(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE accounts_receivable (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    invoice_number VARCHAR(100),
    invoice_date DATE,
    due_date DATE,
    total_amount DECIMAL(15, 2),
    amount_paid DECIMAL(15, 2) DEFAULT 0,
    outstanding_balance DECIMAL(15, 2) AS (total_amount - amount_paid) STORED,
    status VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    -- status ENUM('Unpaid', 'Paid', 'Partial') DEFAULT 'Unpaid',
    -- FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);
CREATE TABLE accounts_payable (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vendor_id INT,
    invoice_number VARCHAR(100),
    invoice_date DATE,
    due_date DATE,
    total_amount DECIMAL(15, 2),
    amount_paid DECIMAL(15, 2) DEFAULT 0,
    outstanding_balance DECIMAL(15, 2) AS (total_amount - amount_paid) STORED,
    status ENUM('Unpaid', 'Paid', 'Partial') DEFAULT 'Unpaid',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    -- FOREIGN KEY (vendor_id) REFERENCES vendors(vendor_id)
);
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_date DATE,
    description TEXT,
    amount DECIMAL(15, 2),
    debit_account_id INT,
    credit_account_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    -- FOREIGN KEY (debit_account_id) REFERENCES chart_of_accounts(account_id),
    -- FOREIGN KEY (credit_account_id) REFERENCES chart_of_accounts(account_id)
);
CREATE TABLE journals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    journal_date DATE,
    description TEXT,
    total_debit DECIMAL(15, 2),
    total_credit DECIMAL(15, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE journal_entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    journal_id INT,
    account_id INT,
    debit_amount DECIMAL(15, 2) DEFAULT 0,
    credit_amount DECIMAL(15, 2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    -- FOREIGN KEY (journal_id) REFERENCES journals(journal_id),
    -- FOREIGN KEY (account_id) REFERENCES chart_of_accounts(account_id)
);
CREATE TABLE general_ledger (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT,
    transaction_date DATE,
    debit_amount DECIMAL(15, 2) DEFAULT 0,
    credit_amount DECIMAL(15, 2) DEFAULT 0,
    balance DECIMAL(15, 2) AS (debit_amount - credit_amount) STORED,
    FOREIGN KEY (account_id) REFERENCES chart_of_accounts(account_id)
);
CREATE TABLE bank_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_number VARCHAR(50),
    bank_name VARCHAR(255),
    balance DECIMAL(15, 2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE cost_of_goods_sold (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    quantity_sold INT,
    unit_cost DECIMAL(15, 2),
    total_cost DECIMAL(15, 2) AS (quantity_sold * unit_cost) STORED,
    sale_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    -- FOREIGN KEY (product_id) REFERENCES products(product_id)
);
CREATE TABLE financial_statements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    period_start DATE,
    period_end DATE,
    total_income DECIMAL(15, 2),
    total_expense DECIMAL(15, 2),
    net_profit DECIMAL(15, 2) AS (total_income - total_expense) STORED,
    statement_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



/**
* GARMENTS MANUFACTURING ERP SOFTWARE
* HRM MODULE SQL FILE
* Author: Rana Hossain
*/


-- Statuses

CREATE TABLE statuses (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Attendance

CREATE TABLE attendance_monthly (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    employee_id BIGINT UNSIGNED NOT NULL,
    year SMALLINT NOT NULL,
    month TINYINT NOT NULL CHECK (month BETWEEN 1 AND 12),
    total_working_days TINYINT UNSIGNED NOT NULL,
    present_days TINYINT UNSIGNED NOT NULL,
    absent_days TINYINT UNSIGNED NOT NULL,
    late_days TINYINT UNSIGNED DEFAULT 0,
    leave_days TINYINT UNSIGNED DEFAULT 0,
    overtime_hours DECIMAL(5,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);


-- Awards

CREATE TABLE awards (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    employee_id BIGINT UNSIGNED NOT NULL,
    award_name VARCHAR(255) NOT NULL,
    award_type VARCHAR(100) NOT NULL,
    award_date DATE NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);


-- Departments

CREATE TABLE departments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    statuses_id BIGINT UNSIGNED NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



CREATE TABLE sub_departments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    departments_id BIGINT UNSIGNED NOT NULL,
    statuses_id BIGINT UNSIGNED NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Employee

CREATE TABLE employee_positions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    department_id BIGINT UNSIGNED NOT NULL,
    salary DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    statuses_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);


CREATE TABLE designations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    department_id INT UNSIGNED NOT NULL,
    description TEXT NULL,
    statuses_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);



CREATE TABLE employees (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    phone VARCHAR(20) UNIQUE NULL,
    gender VARCHAR(20) UNIQUE NULL,
    date_of_birth DATE NULL,
    hire_date DATE NOT NULL,
    department_id BIGINT UNSIGNED NOT NULL,
    position_id BIGINT UNSIGNED NOT NULL,
    salary DECIMAL(10,2) NOT NULL,
    designations_id BIGINT UNSIGNED NOT NULL,
    statuses_id BIGINT UNSIGNED NOT NULL,
    address TEXT NULL,
    city VARCHAR(100) NULL,
    state VARCHAR(100) NULL,
    country VARCHAR(100) NULL,
    zip_code VARCHAR(20) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);



CREATE TABLE employee_performance (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    employee_id BIGINT UNSIGNED NOT NULL,
    reviewer_id BIGINT UNSIGNED NOT NULL,
    review_period_start DATE NOT NULL,
    review_period_end DATE NOT NULL,
    performance_score DECIMAL(5,2) NOT NULL CHECK (performance_score BETWEEN 0 AND 100),
    feedback TEXT NULL,
    goals TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);


-- Leave

CREATE TABLE weekly_holiday (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    day ENUM('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday') NOT NULL,
    company_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);



CREATE TABLE `leave_holidays` (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    holiday_name VARCHAR(255) NOT NULL,
    holiday_form_date DATE NOT NULL,
    holiday_to_date DATE NOT NULL,
    holiday_total_date DATE NOT NULL,
    reason TEXT NOT NULL,
    statuses_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);



CREATE TABLE leave_applications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    leave_type VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    number_of_days DECIMAL(5,2) NOT NULL,
    reason TEXT NOT NULL,
    statuses_id BIGINT UNSIGNED NOT NULL,
    approver_id BIGINT UNSIGNED DEFAULT NULL,
    photo VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);


CREATE TABLE leave_application_approver (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    leave_application_id BIGINT UNSIGNED NOT NULL,
    approver_user_id BIGINT UNSIGNED NOT NULL, -- The user who is the approver (foreign key to users table)
    approver_role VARCHAR(255) NOT NULL, -- Role of the approver (e.g., manager, HR, etc.)
    statuses_id BIGINT UNSIGNED NOT NULL, -- Status of approval
    approved_at TIMESTAMP NULL, -- Timestamp of when the leave was approved
    rejected_at TIMESTAMP NULL, -- Timestamp of when the leave was rejected
    comments TEXT NULL, -- Comments or feedback from the approver
    photo VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- When the approver was added
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- When the record was last updated
);


 -- Notice Board

CREATE TABLE noticeboard (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    posted_by BIGINT UNSIGNED NOT NULL, -- assuming there's a 'users' table
    posted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    statuses_id BIGINT UNSIGNED NOT NULL, -- 'active' or 'inactive' status for the notice
    start_date DATE NULL, -- date when the notice becomes effective
    end_date DATE NULL, -- date when the notice expires
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (posted_by) REFERENCES users(id) ON DELETE CASCADE
);



-- Payroll Advanched Salary

CREATE TABLE `payroll_advanced_salary` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `employee_id` INT UNSIGNED NOT NULL,
    `amount` DECIMAL(10, 2) NOT NULL,
    `approved_by` INT UNSIGNED NOT NULL,
    `approval_date` DATE NOT NULL,
    `status` ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    `reason` TEXT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`employee_id`) REFERENCES `employees`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`approved_by`) REFERENCES `users`(`id`) ON DELETE CASCADE
);



CREATE TABLE `payroll_manage_employee_salary` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `employee_id` INT UNSIGNED NOT NULL,
    `basic_salary` DECIMAL(10, 2) NOT NULL,
    `housing_allowance` DECIMAL(10, 2) DEFAULT 0.00,
    `transport_allowance` DECIMAL(10, 2) DEFAULT 0.00,
    `medical_allowance` DECIMAL(10, 2) DEFAULT 0.00,
    `bonus` DECIMAL(10, 2) DEFAULT 0.00,
    `overtime` DECIMAL(10, 2) DEFAULT 0.00,
    `tax_deductions` DECIMAL(10, 2) DEFAULT 0.00,
    `total_salary` DECIMAL(10, 2) GENERATED ALWAYS AS (`basic_salary` + `housing_allowance` + `transport_allowance` + `medical_allowance` + `bonus` + `overtime` - `tax_deductions`) STORED,
    `payroll_month` DATE NOT NULL,
    `payment_date` DATE NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`employee_id`) REFERENCES `employees`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE payroll_employee_salary (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,               -- Foreign key reference to employees table
    basic_salary DECIMAL(15, 2) NOT NULL,    -- Basic salary of the employee
    bonus DECIMAL(15, 2) DEFAULT 0,         -- Bonus for the employee
    deductions DECIMAL(15, 2) DEFAULT 0,    -- Deductions for the employee (e.g., taxes, contributions)
    net_salary DECIMAL(15, 2) NOT NULL,     -- Calculated net salary after deductions and bonuses
    pay_date DATE NOT NULL,                 -- The date when the salary is paid
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
);


 -- Recruitment

CREATE TABLE `recruitment_candidatelist` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `phone_number` VARCHAR(15) NOT NULL,
    `address` TEXT,
    `gender` ENUM('Male', 'Female', 'Other') NOT NULL,
    `dob` DATE NOT NULL,
    `position_applied` VARCHAR(255) NOT NULL,
    `education` VARCHAR(255),
    `experience` TEXT,
    `resume` VARCHAR(255), -- stores file path or filename of the uploaded resume
    `status` ENUM('Applied', 'Interviewed', 'Selected', 'Rejected') DEFAULT 'Applied',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

Total marks	Selection	Action


CREATE TABLE `recruitment_interview` (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    Candidate id  INT NOT NULL,
    Job position VARCHAR(255) UNIQUE NOT NULL,
    Interview  DATE NOT NULL,
    Viva marks double,
    Written total marks	double,
    Mcq total marks	double,
    Total marks	Selection double,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



CREATE TABLE `Candidate selection` (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    candidate_id  INT NOT NULL,
    employee_id  INT NOT NULL,
    job position VARCHAR(255) UNIQUE NOT NULL,
    selection_terms VARCHAR(255) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Training


CREATE TABLE training_list (
    id INT AUTO_INCREMENT PRIMARY KEY,
    training_name VARCHAR(255) NOT NULL,
    description TEXT,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    duration INT, -- in hours or days
    trainer_name VARCHAR(255),
    location VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



CREATE TABLE `trainers` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `phone_number` VARCHAR(20) NULL,
    `gender` ENUM('male', 'female', 'other') NOT NULL,
    `date_of_birth` DATE NULL,
    `hire_date` DATE NOT NULL,
    `qualification` VARCHAR(255) NULL,
    `specialization` VARCHAR(255) NULL,
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Timesheet

CREATE TABLE `timesheets` (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    employee_id BIGINT UNSIGNED NOT NULL,
    date DATE NOT NULL,
    clock_in TIME NULL,
    clock_out TIME NULL,
    break_duration INT DEFAULT 0,  -- Duration of breaks in minutes
    hours_worked DECIMAL(5, 2) DEFAULT 0, -- Hours worked calculated automatically
    statuses_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);


 -- Procurement


CREATE TABLE procurement_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    requester_id INT NOT NULL,
    department_id INT NOT NULL,
    item_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    purpose TEXT,
    status ENUM('pending', 'approved', 'rejected', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (requester_id) REFERENCES employees(id),
    FOREIGN KEY (department_id) REFERENCES departments(id)
);



CREATE TABLE procurement_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    request_id INT NOT NULL,
    supplier_id INT NOT NULL,
    order_date DATE,
    expected_delivery_date DATE,
    actual_delivery_date DATE,
    total_cost DECIMAL(10, 2),
    status ENUM('ordered', 'delivered', 'cancelled') DEFAULT 'ordered',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (request_id) REFERENCES procurement_requests(id),
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
);



CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    contact_person VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(255),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);




CREATE TABLE procurement_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    item_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10, 2),
    total_price DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES procurement_orders(id)
);




CREATE TABLE procurement_approvals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    request_id INT NOT NULL,
    approver_id INT NOT NULL,
    status ENUM('approved', 'rejected') NOT NULL,
    comments TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (request_id) REFERENCES procurement_requests(id),
    FOREIGN KEY (approver_id) REFERENCES employees(id)
);




CREATE TABLE procurement_payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    payment_date DATE,
    amount DECIMAL(10, 2),
    payment_method ENUM('cash', 'cheque', 'bank_transfer', 'credit_card'),
    status ENUM('paid', 'pending', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES procurement_orders(id)
);


CREATE TABLE procurement_audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

