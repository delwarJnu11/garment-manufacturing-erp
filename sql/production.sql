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
    FOREIGN KEY (production_plan_status_id) REFERENCES production_plan_statuses(id)
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

    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (production_plan_id) REFERENCES production_plans(id),
    FOREIGN KEY (production_work_status_id) REFERENCES production_work_statuses(id),
    FOREIGN KEY (assigned_to) REFERENCES users(id)
);

-- Cost Estimation & Control
CREATE TABLE prodcution_cost_estimations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    material_cost DECIMAL(10,2),
    labor_cost DECIMAL(10,2),
    overhead_cost DECIMAL(10,2),
    utility_cost DECIMAL(10,2),
    total_cost DECIMAL(10,2),
    profit DECIMAL(10,2),
    sales_price DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE material_usage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    material_id INT,
    quantity_used DECIMAL(10,2),
    wastage DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
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
);

-- Production


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
    FOREIGN KEY (order_id) REFERENCES orders(id)
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
    FOREIGN KEY (order_id) REFERENCES orders(id)
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
    FOREIGN KEY (order_id) REFERENCES orders(id)
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
    FOREIGN KEY (order_id) REFERENCES orders(id)
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
    FOREIGN KEY (order_id) REFERENCES orders(id)
    FOREIGN KEY (quality_inspections_stage_id) REFERENCES quality_inspections_stages(id)
    FOREIGN KEY (quality_inspections_status_id) REFERENCES quality_inspections_statuses(id)
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
    FOREIGN KEY (inspection_id) REFERENCES quality_inspections(id)
    FOREIGN KEY (defect_severity_id) REFERENCES defect_severity(id)
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
