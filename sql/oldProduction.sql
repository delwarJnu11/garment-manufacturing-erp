-- create database if not exists production_management;
-- use production_management;


CREATE TABLE `core_users` (
  `id` int(10) primary key auto_increment,
  `name` varchar(50) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `photo` varchar(50) DEFAULT NULL,
  `verify_code` varchar(50) DEFAULT NULL,
  `inactive` tinyint(1) UNSIGNED DEFAULT 0,
  `mobile` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `remember_token` varchar(145) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `core_users`
--

INSERT INTO `core_users` (`id`, `name`, `role_id`, `password`, `email`, `full_name`, `created_at`, `photo`, `verify_code`, `inactive`, `mobile`, `updated_at`, `ip`, `email_verified_at`, `remember_token`) VALUES
(127, 'admin', 1, '$2y$10$zeyUFTm0vqQ0uAUS04kl4ubY6.2Y0zQXqcFC70XvD.8Ot5s3Om5PG', 'towhid1@outlook.com', 'Mohammad Towhidul Islam', '2024-04-29 05:28:06', '127.jpg', '45354353', 0, '34324324', '2022-02-15 21:00:46', '192.168.150.29', NULL, NULL),
(192, 'naeem', 2, '$2y$10$BTQzbrLdYG9/hSfLBf7mzOLzDG1kp6E90OaMh9jEWBafyGkG6oAt6', 'naymur@gmail.com', 'Naymur Rahman', '2024-04-04 05:43:27', NULL, NULL, 0, '01800000000', NULL, '192.168.150.25', NULL, NULL),
(194, 'jakaria', 2, '$2y$10$Zyt3rgYgF9vnDBhNRN/8lO1BirJFCCNr3rhTRiI.7W1aVIuriBJiS', 'jkp.jakaria@gmail.com', 'jkp', '2024-04-15 04:53:54', NULL, NULL, 0, '01642527454', NULL, '192.168.150.47', NULL, NULL),
(196, 'Aminur', 2, '$2y$10$u1Wku9Uh61adCVAPm6ToSOp.8EgdXkiXo/DGp3oD.i/8o9I6a/Dai', 'amiur@gmail.com', 'Aminur Rahman', '2024-04-04 05:45:19', NULL, NULL, 0, '01800000000', NULL, '192.168.150.25', NULL, NULL),
(197, 'Tanim', 2, '$2y$10$NcNFqz1p2N76l4NH96f4Y.KTU8s/e.CqZB.lD7lewc4rcBvMstgaK', 'tanim@gmail.com', 'Rifat Ahammed Tanim', '2024-04-04 05:54:06', NULL, NULL, 0, '01900000000', NULL, '192.168.150.34', NULL, NULL),
(199, 'midul', 2, '$2y$10$sUhLutkkEUOUTWY2yWi.C.B55DFNOhUrbfFnrzcKM2FK7xdDF6Rby', 'midul@yahoo.com', 'Midul Islam', '2024-04-04 05:50:50', NULL, NULL, 0, '0198748343', NULL, '192.168.150.5', NULL, NULL),
(200, 'Jabed ', 2, '$2y$10$mgdw/E0HYncsz1wZaxygKerTF9VAfiPMnq4TSLsscA5CVHSih/RbS', 'olba@gmail.com', 'Javed ', '2024-04-04 05:59:27', NULL, NULL, 0, '01869546555', NULL, '192.168.150.22', NULL, NULL),
(201, 'omar', 2, '$2y$10$GnOgIBKPRsNIeM3OJExotuuBjGqzgcYGnfQeZpz4pug/GNqiLCWwS', 'omar@gmail.com', 'Omar Faruk', '2024-04-15 04:57:44', NULL, NULL, 0, '343434', NULL, '192.168.150.11', NULL, NULL),
(204, 'Anni', 2, '$2y$10$JWg5tGwzGUwnFT/PZBT4wuqIKAw3Vb6X7kWs9zC3ueLSi1RMzi87W', 'jannatulneasa464@gmail.com', 'Jannatul Neasa', '2024-04-04 05:54:32', NULL, NULL, 0, '3254436756', NULL, '192.168.150.29', NULL, NULL),
(206, 'mir3', 4, '$2y$10$wYZrszbJ9LIadOof3PRIzuHQNnjAQuTanA.JBmsreow3nJm04hCRW', 'mir@gmail.com', 'Mizanur Rahman ', '2024-05-15 07:36:41', 'mir3.png', NULL, 0, '', '0000-00-00 00:00:00', '::1', '0000-00-00 00:00:00', ''),
(209, 'abc', 1, '$2y$10$M52jied3IiUeo/ke8QU5SO0tS5IrW3T7aXVEL3a7l7/HN/4l98XKO', 'abc@gmail.com', NULL, '2024-05-15 06:29:14', 'abc-gmail-com.jpg', NULL, 0, NULL, '2024-05-15 12:08:29', '::1', '0000-00-00 00:00:00', ''),
(213, 'sium', 2, '$2y$10$Ziq..GqX0z4Lf2H4tE62VOsSDmyq8BUhESIhHu4BEfLKvrJLUszOS', 'sium@gmail.com', NULL, '2024-05-15 07:43:08', 'sium.jpeg', NULL, 0, NULL, '0000-00-00 00:00:00', '192.168.150.18', '0000-00-00 00:00:00', '');

CREATE TABLE `core_roles` (
 `id` int(10) primary key auto_increment,
  `name` varchar(20) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `core_roles`
--

INSERT INTO `core_roles` (`id`, `name`, `updated_at`, `created_at`) VALUES
(1, 'Admin', '2024-03-02 04:59:14', '2024-03-02 04:59:14'),
(2, 'Manager', '2024-02-28 12:10:59', '2024-02-28 06:10:59'),
(4, 'Guest', '2024-03-07 10:24:21', '2024-03-07 04:24:21'),
(5, 'Manager', '2024-03-07 12:25:34', '2024-03-07 06:25:34'),
(6, 'Manager', '2024-03-07 12:25:53', '2024-03-07 06:25:53');






create table if not exists `core_products`(
    id int primary key auto_increment,
    name varchar (50),
    price double,
    offer_price double,
    categorie_id int,
    uom_id int,
    barcode int, 
    sku int,
    manufacturer_id int,
    star varchar (50),
    photo varchar(100),
    description varchar (200),
    weight int,
    size int,
    is_feature varchar (50),
    is_brand varchar (50),
    is_raw_material boolean,
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);


create table if not exists `core_manufacturers`(
    id int primary key auto_increment,
    name varchar (50),
    phone varchar(20),
    email varchar(30),
    address varchar (200),
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




create table if not exists `core_suppliers`(
    id int primary key auto_increment,
    name varchar (50),
    photo varchar(100),
    phone varchar(20),
    email varchar(30),
    address varchar (200),
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




create table if not exists `core_purchases`(
    id int primary key auto_increment,
    supplier_id int,
    product_id int,
    status_id int,
    order_total double,
    paid_amount double,
    discount double,
    vat double,
    delivery_date date,
    date date,
    shipping_address varchar (150),
    description varchar (150),
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




create table if not exists `core_purchases_details`(
    id int primary key auto_increment,
    purchases_id int,
    product_id int,
    qty double,
    price double,
    discount double,
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




create table if not exists `core_categories`(
    id int primary key auto_increment,
    name varchar (50),
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);

create table if not exists `core_sub_categories`(
    id int primary key auto_increment,
    name varchar (50),
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);



create table if not exists `core_uom`(
    id int primary key auto_increment,
    name varchar (50),
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




create table if not exists `core_status`(
    id int primary key auto_increment,
    name varchar (50),
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




create table if not exists `core_customars`(
    id int primary key auto_increment,
    name varchar (50),
    photo varchar(100),
    phone varchar(20),
    email varchar(30),
    address varchar (200),
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




create table if not exists `core_orders`(
    id int primary key auto_increment,
    customar_id int,
    order_total double,
    discount double,
    shipping_address varchar (200),
    paid_amount double,
    status_id int,
    order_date date,
    delivery_date date,
    vat double,
    uom_id int,
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




create table if not exists `core_order_details`(
    id int primary key auto_increment,
    order_id int,
    product_id int,
    qty double,
    price double,
    vat double,
    uom_id int,
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




create table if not exists `core_stock`(
    id int primary key auto_increment,
    raw_material_id int,
    finish_goods_id int,
    wip_id int,
    transaction_type_id int,
    warehouse_id int,
    qty double,
    uom_id int,
    remark varchar (200),
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




create table if not exists `core_warehouse`(
    id int primary key auto_increment,
    name varchar (50),
    phone varchar(20),
    location varchar(200),
    address varchar (200),
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




create table if not exists `core_transaction_type`(
    id int primary key auto_increment,
    name varchar (50),
    factor float,
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);

create table if not exists `core_adjustment_type`(
    id int primary key auto_increment,
    name varchar (50),
    factor float,
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




create table if not exists `core_stock_adjustment`(
    id int primary key auto_increment,
    user_id int,
    adjustment_type_id int,
    warehouse_id int,
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




create table if not exists `core_stock_adjustment_details`(
    id int primary key auto_increment,
    stock_adjustment_id int,
    product_id int,
    qty double,
    price double,
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);



create table if not exists `core_production`(
    id int primary key auto_increment,
    material_id int,
    uom_id int,
    product_id int,
    production_date date,
    qty int,
    status_id int,
    unit_cost DECIMAL(10, 2),
    total_cost DECIMAL(10, 2),
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);


create table if not exists `core_production_details`(
    id int primary key auto_increment,
    material_id int,
    uom_id int,
    production_id int,
    product_id int,
    qty int,
    start_date DATE,
    end_date DATE,
    worker_assigned VARCHAR(255),
    status_id int,
    unit_cost DECIMAL(10, 2),                       
    total_cost DECIMAL(10, 2),
    notes varchar(200),
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);


CREATE TABLE IF NOT EXISTS `core_build` (
    id INT AUTO_INCREMENT PRIMARY KEY,                
    production_detail_id INT,    
    material_id int,
    uom_id int,                        
    build_step VARCHAR(255),                     
    start_date DATE,                           
    end_date DATE,                                   
    status_id int,
    worker_assigned VARCHAR(255),                        
    qty INT,                        
    materials_used TEXT,                              
    notes TEXT,                                         
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);


CREATE TABLE raw_materials(
    id INT AUTO_INCREMENT PRIMARY KEY,
    material_name VARCHAR(200),
    description TEXT,
    quantity DECIMAL(10, 2),
    uom_id int,
    cost_per_unit DECIMAL(10, 2),
    supplier_id VARCHAR(200),
    created_at datetime default current_timestamp,
    updated_at datetime default current_timestamp
);




-- select core_products.*, core_manufacturers.name as manufacturer, core_categories.name as categories, core_uom.name as uom from core_products
-- left join core_manufacturers on core_products.manufacturer_id = core_manufacturers.id
-- left join core_categories on core_products.categorie_id = core_categories.id
-- left join core_uom on core_products.uom_id = core_uom.id;


-- create view all_product_views as
-- select core_products.*, core_manufacturers.name as manufacturer, core_categories.name as categories,core_sub_categories.name as subcategory, core_uom.name as uom from core_products
-- left join core_manufacturers on core_products.manufacturer_id = core_manufacturers.id
-- left join core_categories on core_products.categorie_id = core_categories.id
-- left join core_sub_categories on core_products.sub_categorie_id = core_sub_categories.id
-- left join core_uom on core_products.uom_id = core_uom.id;





-- create view all_purchases_view as
-- select core_purchases.*, core_suppliers.name as supllier, core_status.name as status from core_purchases
-- left join core_suppliers on core_purchases.supplier_id = core_suppliers.id
-- left join core_status on core_purchases.status_id = core_status.id;




-- create view all_order_view as
-- select core_orders.*, core_customars.name as customar, core_status.name as status, core_uom.name as uom from core_orders
-- left join core_customars on core_orders.customar_id = core_customars.id
-- left join core_status on core_orders.status_id = core_status.id
-- left join core_uom on core_orders.uom_id = core_uom.id;



-- select core_products.*, core_manufacturers.name as manufacturer, core_categories.name as categories, core_uom.name as uom from core_products
-- join core_manufacturers on core_products.core_manufacturer_id = core_manufacturers.id
-- join core_categories on core_products.core_categories_id = core_categories.id
-- join core_uom on core_products.core_uom_id = core_uom.id;




-- select core_order_details.*, core_orders.order_total, core_products.name as product, core_uom.name as uom from core_order_details
-- join core_orders on core_order_details.core_orders_id = core_orders.id
-- join core_products on core_order_details.core_products_id = core_products.id
-- join core_uom on core_order_details.core_uom_id = core_uom.id;


-- select SUM(core_stock.qty) as quantity, core_stock.*, core_products.name as product, core_warehouse.name as warehouse from core_stock
-- left join core_products on core_stock.product_id = core_products.id
-- left join core_warehouse on core_stock.warehouse_id = core_warehouse.id GROUP BY core_stock.product_id;



-- select core_build .*, core_products.name as product, core_status.name as status, core_uom.name as uom from core_build
-- left join core_products on core_build.product_id = core_products.id
-- left join core_status on core_build.status_id = core_status.id
-- left join core_uom on core_build.status_id = core_uom.id;



/*Production Module Previous Database Table*/

-- 1. Production Planning

CREATE TABLE production_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plan_name VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    notes TEXT,
    status VARCHAR(50),  -- E.g., "Draft", "Approved", "Active", "Completed"
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE production_plan_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    production_plan_id INT REFERENCES production_plans(production_plan_id),
    product_id INT REFERENCES products(product_id),  -- Assuming you have a Products table
    planned_quantity DECIMAL(10, 2) NOT NULL,
    target_start_date DATE,
    target_end_date DATE,
    notes TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE demand_forecasts (
    demand_forecast_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT REFERENCES products(product_id),
    forecast_date DATE NOT NULL,
    forecast_quantity DECIMAL(10, 2) NOT NULL,
    actual_quantity DECIMAL(10, 2),
    forecast_method VARCHAR(255),
    notes TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

-- 5. Quality Control

CREATE TABLE quality_checks (
    quality_check_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT REFERENCES products(product_id),
    check_date DATE NOT NULL,
    stage VARCHAR(255),   -- Raw Material, In-Process, Finished Goods
    inspector_id INT REFERENCES employees(employee_id),  -- Which employee did the inspection
    status VARCHAR(50),  -- Pass, Fail, Pending
    notes TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE defect_logs (
    defect_log_id INT AUTO_INCREMENT PRIMARY KEY,
    quality_check_id INT REFERENCES quality_checks(quality_check_id),
    defect_description TEXT,
    defect_severity VARCHAR(50),   -- Minor, Major, Critical
    quantity_affected INT,
    resolution_action TEXT,
    resolution_date DATE,
    resolved_by INT REFERENCES employees(employee_id),
    root_cause VARCHAR(255),
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);


-- 6. Raw Material Management

CREATE TABLE suppliers (
    supplier_id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_name VARCHAR(255) NOT NULL,
    contact_information TEXT,
    payment_terms VARCHAR(255),
    performance_rating DECIMAL(3,2),
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE purchase_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_id INT REFERENCES suppliers(supplier_id),
    order_date DATE NOT NULL,
    expected_delivery_date DATE,
    total_amount DECIMAL(12, 2),
    status VARCHAR(50),  -- E.g., "Open", "Received", "Cancelled"
    notes TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE purchase_order_items (
    purchase_order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    purchase_order_id INT REFERENCES purchase_orders(purchase_order_id),
    product_id INT REFERENCES products(product_id), -- Treat raw materials as Products
    quantity DECIMAL(10, 2) NOT NULL,
    unit_price DECIMAL(10, 2),
    received_quantity DECIMAL(10, 2),
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);


-- 7. Production Scheduling

CREATE TABLE work_orders (
    work_order_id INT AUTO_INCREMENT PRIMARY KEY,
    production_plan_item_id INT REFERENCES production_plan_items(production_plan_item_id),
    product_id INT REFERENCES products(product_id),
    quantity DECIMAL(10, 2) NOT NULL,
    start_date DATE,
    end_date DATE,
    status VARCHAR(50),  -- Scheduled, In Progress, Completed, On Hold
    notes TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE work_order_operations (
    work_order_operation_id INT AUTO_INCREMENT PRIMARY KEY,
    work_order_id INT REFERENCES work_orders(work_order_id),
    operation_description VARCHAR(255),
    station_id INT REFERENCES work_stations(station_id),  -- Where the operation is performed
    assigned_employee_id INT REFERENCES employees(employee_id),
    planned_start_date DATE,
    planned_end_date DATE,
    actual_start_date DATE,
    actual_end_date DATE,
    status VARCHAR(50),
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE work_stations (  -- Represents a physical location in the factory
    station_id INT AUTO_INCREMENT PRIMARY KEY,
    station_name VARCHAR(255) NOT NULL,
    station_type VARCHAR(255),
    capacity INT,
    notes TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);


-- 8. Cost Management

CREATE TABLE budgets (
    budget_id INT AUTO_INCREMENT PRIMARY KEY,
    budget_date DATE,
    description TEXT,
    total_amount DECIMAL(12,2),
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE budget_items (
    budget_item_id INT AUTO_INCREMENT PRIMARY KEY,
    budget_id INT REFERENCES budgets(budget_id),
    category_id INT REFERENCES expense_categories(category_id), -- group related expenses
    budget_amount DECIMAL(12,2),
    notes TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE expenses (
    expense_id INT AUTO_INCREMENT PRIMARY KEY,
    expense_date DATE NOT NULL,
    description TEXT,
    category_id INT REFERENCES expense_categories(category_id),
    amount DECIMAL(12, 2) NOT NULL,
    payment_method VARCHAR(255),
    notes TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE expense_categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL,
    description TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);



-- 9. Performance Tracking

CREATE TABLE production_metrics (
    production_metric_id INT AUTO_INCREMENT PRIMARY KEY,
    work_order_id INT REFERENCES work_orders(work_order_id),
    metric_date DATE NOT NULL,
    output_quantity DECIMAL(10, 2),
    cycle_time DECIMAL(10,2),
    downtime DECIMAL(10, 2),  -- In minutes
    defect_rate DECIMAL(5, 2),   -- Percentage
    notes TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);


-- 10. Equipment Maintenance

CREATE TABLE equipment (
    equipment_id INT AUTO_INCREMENT PRIMARY KEY,
    equipment_name VARCHAR(255) NOT NULL,
    serial_number VARCHAR(255),
    purchase_date DATE,
    warranty_expiry_date DATE,
    station_id INT REFERENCES work_stations(station_id),
    maintenance_schedule TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE maintenance_logs (
    maintenance_log_id INT AUTO_INCREMENT PRIMARY KEY,
    equipment_id INT REFERENCES equipment(equipment_id),
    maintenance_date DATE NOT NULL,
    performed_by INT REFERENCES employees(employee_id),
    description TEXT,
    parts_replaced TEXT,
    cost DECIMAL(12, 2),
    next_maintenance_date DATE,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

-- 11. Reports and Analytics (This module primarily uses data from other tables, so no dedicated table)
--     - Reports are generated by querying other tables and summarizing data.

-- 12. Safety and Compliance

CREATE TABLE safety_protocols (
    protocol_id INT AUTO_INCREMENT PRIMARY KEY,
    protocol_name VARCHAR(255) NOT NULL,
    description TEXT,
    effective_date DATE,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE safety_incidents (
    incident_id INT AUTO_INCREMENT PRIMARY KEY,
    incident_date DATE NOT NULL,
    description TEXT,
    location TEXT,
    reported_by INT REFERENCES employees(employee_id),
    severity VARCHAR(50),
    corrective_action TEXT,
    closure_date DATE,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE regulatory_requirements (
    requirement_id INT AUTO_INCREMENT PRIMARY KEY,
    requirement_name VARCHAR(255) NOT NULL,
    regulatory_body VARCHAR(255),
    compliance_date DATE,
    notes TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE compliance_checks (
    compliance_check_id INT AUTO_INCREMENT PRIMARY KEY,
    requirement_id INT REFERENCES regulatory_requirements(requirement_id),
    check_date DATE,
    checked_by INT REFERENCES employees(employee_id),
    status VARCHAR(50),
    notes TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);


-- 13. Waste Management

CREATE TABLE waste_materials (
    waste_material_id INT AUTO_INCREMENT PRIMARY KEY,
    material_name VARCHAR(255) NOT NULL,
    description TEXT,
    disposal_method VARCHAR(255),
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);

CREATE TABLE waste_logs (
    waste_log_id INT AUTO_INCREMENT PRIMARY KEY,
    waste_date DATE NOT NULL,
    work_order_id INT REFERENCES work_orders(work_order_id),
    waste_material_id INT REFERENCES waste_materials(waste_material_id),
    quantity DECIMAL(10, 2),
    disposal_cost DECIMAL(12, 2),
    notes TEXT,
    created_by INT REFERENCES users(user_id),
    last_updated_by INT REFERENCES users(user_id)
);