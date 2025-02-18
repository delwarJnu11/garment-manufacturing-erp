-- Orders & Production Management
CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    contact_info TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
    size_breakdown JSON,
    delivery_date DATE,
    status ENUM('Pending', 'In Progress', 'Completed', 'Canceled') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id)
);

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
    FOREIGN KEY (order_id) REFERENCES orders(id)
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

CREATE TABLE production_plan_statuses(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE work_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    production_plan_id INT,
    section ENUM('Cutting', 'Sewing', 'Finishing'),
    assigned_to INT,
    target_quantity INT,
    actual_quantity INT,
    status ENUM('Pending', 'Completed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (production_plan_id) REFERENCES production_plans(id),
    FOREIGN KEY (assigned_to) REFERENCES users(id)
);

-- Cost Estimation & Control
CREATE TABLE cost_estimations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    material_cost DECIMAL(10,2),
    labor_cost DECIMAL(10,2),
    overhead_cost DECIMAL(10,2),
    utility_cost DECIMAL(10,2),
    total_cost DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

CREATE TABLE materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type ENUM('Fabric', 'Trim', 'Accessory') NOT NULL,
    supplier_id INT,
    unit_price DECIMAL(10,2),
    wastage_allowance DECIMAL(5,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
);

CREATE TABLE material_usage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    material_id INT,
    quantity_used DECIMAL(10,2),
    wastage DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (material_id) REFERENCES materials(id)
);

-- Inventory & Suppliers
CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    contact_person VARCHAR(100),
    phone VARCHAR(20),
    email VARCHAR(100),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    material_id INT,
    quantity_available DECIMAL(10,2),
    reorder_level INT,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (material_id) REFERENCES materials(id)
);

-- Quality Control
CREATE TABLE quality_inspections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    inspection_stage ENUM('Inline', 'Final') NOT NULL,
    AQL_level VARCHAR(10),
    defects_found INT,
    rework_needed BOOLEAN DEFAULT FALSE,
    status ENUM('Passed', 'Failed', 'Rework') DEFAULT 'Passed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

CREATE TABLE defects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    inspection_id INT,
    defect_type VARCHAR(100),
    severity ENUM('Minor', 'Major', 'Critical'),
    corrective_action TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (inspection_id) REFERENCES quality_inspections(id)
);

-- Reporting & Security
CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    report_type VARCHAR(50),
    generated_by INT,
    data JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (generated_by) REFERENCES users(id)
);

CREATE TABLE audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(255),
    module_affected VARCHAR(100),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    config_name VARCHAR(100),
    config_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

















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
    purchase_order_id INT AUTO_INCREMENT PRIMARY KEY,
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