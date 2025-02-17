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

-- 3. Inventory Management

-- CREATE TABLE products ( 
--     product_id INT AUTO_INCREMENT PRIMARY KEY,
--     product_name VARCHAR(255) NOT NULL,
--     product_code VARCHAR(50) UNIQUE,
--     description TEXT,
--     category_id INT REFERENCES product_categories(category_id), -- optional
--     reorder_level DECIMAL(10,2),
--     reorder_quantity DECIMAL(10,2),
--     units VARCHAR(50),
--     created_by INT REFERENCES users(user_id),
--     last_updated_by INT REFERENCES users(user_id)
-- );

-- CREATE TABLE product_categories (  -- Optional: for grouping products
--     category_id INT AUTO_INCREMENT PRIMARY KEY,
--     category_name VARCHAR(255) NOT NULL,
--     description TEXT,
--     created_by INT REFERENCES users(user_id),
--     last_updated_by INT REFERENCES users(user_id)
-- );


-- CREATE TABLE inventory (
--     inventory_id INT AUTO_INCREMENT PRIMARY KEY,
--     product_id INT REFERENCES products(product_id),
--     location_id INT REFERENCES locations(location_id), -- where the item is stored.
--     batch_lot_number VARCHAR(255),
--     quantity_on_hand DECIMAL(10, 2) NOT NULL DEFAULT 0,
--     unit_cost DECIMAL(10,2),
--     last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     created_by INT REFERENCES users(user_id),
--     last_updated_by INT REFERENCES users(user_id)
-- );

-- CREATE TABLE locations (
--     location_id INT AUTO_INCREMENT PRIMARY KEY,
--     location_name VARCHAR(255) NOT NULL,
--     location_type VARCHAR(50), -- Warehouse, Production Line, etc.
--     description TEXT,
--     created_by INT REFERENCES users(user_id),
--     last_updated_by INT REFERENCES users(user_id)
-- );


-- 4. Workforce Management

-- CREATE TABLE employees (
--     employee_id INT AUTO_INCREMENT PRIMARY KEY,
--     first_name VARCHAR(255) NOT NULL,
--     last_name VARCHAR(255) NOT NULL,
--     employee_code VARCHAR(50) UNIQUE,
--     hire_date DATE,
--     job_title VARCHAR(255),
--     department_id INT REFERENCES departments(department_id),
--     skills TEXT,
--     contact_information TEXT,
--     created_by INT REFERENCES users(user_id),
--     last_updated_by INT REFERENCES users(user_id)
-- );

-- CREATE TABLE departments (
--     department_id INT AUTO_INCREMENT PRIMARY KEY,
--     department_name VARCHAR(255) NOT NULL,
--     description TEXT,
--     created_by INT REFERENCES users(user_id),
--     last_updated_by INT REFERENCES users(user_id)
-- );

-- CREATE TABLE shifts (
--     shift_id INT AUTO_INCREMENT PRIMARY KEY,
--     employee_id INT REFERENCES employees(employee_id),
--     shift_date DATE NOT NULL,
--     start_time TIME NOT NULL,
--     end_time TIME NOT NULL,
--     notes TEXT,
--     created_by INT REFERENCES users(user_id),
--     last_updated_by INT REFERENCES users(user_id)
-- );

-- CREATE TABLE task_assignments (
--     task_assignment_id INT AUTO_INCREMENT PRIMARY KEY,
--     shift_id INT REFERENCES shifts(shift_id),
--     task_description VARCHAR(255),
--     task_priority VARCHAR(50),
--     status VARCHAR(50),  -- E.g., "Assigned", "In Progress", "Completed"
--     due_date DATE,
--     actual_completion_date DATE,
--     notes TEXT,
--     created_by INT REFERENCES users(user_id),
--     last_updated_by INT REFERENCES users(user_id)
-- );

-- CREATE TABLE attendance (
--     attendance_id INT AUTO_INCREMENT PRIMARY KEY,
--     employee_id INT REFERENCES employees(employee_id),
--     attendance_date DATE NOT NULL,
--     clock_in TIME,
--     clock_out TIME,
--     hours_worked DECIMAL(5, 2),
--     notes TEXT,
--     created_by INT REFERENCES users(user_id),
--     last_updated_by INT REFERENCES users(user_id)
-- );

-- CREATE TABLE training_sessions (
--     training_session_id INT AUTO_INCREMENT PRIMARY KEY,
--     training_name VARCHAR(255) NOT NULL,
--     description TEXT,
--     start_date DATE,
--     end_date DATE,
--     trainer VARCHAR(255),
--     created_by INT REFERENCES users(user_id),
--     last_updated_by INT REFERENCES users(user_id)
-- );

-- CREATE TABLE employee_training (
--   employee_training_id INT AUTO_INCREMENT PRIMARY KEY,
--   employee_id INT REFERENCES employees(employee_id),
--   training_session_id INT REFERENCES training_sessions(training_session_id),
--   completion_date DATE,
--   certification_valid_until DATE,
--   notes TEXT,
--   created_by INT REFERENCES users(user_id),
--   last_updated_by INT REFERENCES users(user_id)
-- );

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