
-- Statuses

CREATE TABLE hrm_statuses (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Attendance

CREATE TABLE hrm_attendances_lists (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    employee_id BIGINT UNSIGNED NOT NULL,
    date date NOT NULL,
    statuses_id BIGINT UNSIGNED NOT NULL,
    clock_in TIME DEFAULT '00:00:00',
    clock_out TIME DEFAULT '00:00:00',
    late_days TINYINT UNSIGNED DEFAULT 0,
    leave_days TINYINT UNSIGNED DEFAULT 0,
    late_times TIME DEFAULT '00:00:00',
    leave_times TIME DEFAULT '00:00:00',
    total_work_hours DECIMAL(5,2) DEFAULT '0.00',
    overtime_hours TIME DEFAULT '00:00:00',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);


-- Awards

CREATE TABLE hrm_awards (
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

CREATE TABLE hrm_departments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    statuses_id BIGINT UNSIGNED NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);



CREATE TABLE hrm_sub_departments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    departments_id BIGINT UNSIGNED NOT NULL,
    statuses_id BIGINT UNSIGNED NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Employee

CREATE TABLE hrm_employee_positions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    department_id BIGINT UNSIGNED NOT NULL,
    salary DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    statuses_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);


CREATE TABLE hrm_designations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    department_id INT UNSIGNED NOT NULL,
    description TEXT NULL,
    statuses_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);



CREATE TABLE hrm_employees (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    employee_id_number VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    phone VARCHAR(20) UNIQUE NULL,
    gender VARCHAR(20) UNIQUE NULL,
    date_of_birth DATE NULL,
    joining_date DATE NOT NULL,
    bank_account_id INT NOT NULL,
    department_id BIGINT UNSIGNED NOT NULL,
    salary DECIMAL(10,2) NOT NULL,
    designations_id BIGINT UNSIGNED NOT NULL,
    statuses_id BIGINT UNSIGNED NOT NULL,
    branch VARCHAR(100) NOT NULL,
    certificate VARCHAR(100) NOT NULL,
    photo VARCHAR(100) NOT NULL,
    address TEXT NULL,
    resume  TEXT NULL,
    city VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

CREATE TABLE hrm_employee_bank_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    bank_name VARCHAR(255) NOT NULL,
    account_number VARCHAR(50) NOT NULL UNIQUE,
    bank_identifier_code VARCHAR(20) NOT NULL,
    branch_name VARCHAR(255),
    branch_location VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);


CREATE TABLE hrm_employee_performances (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    employees_id BIGINT UNSIGNED NOT NULL,
    department_id BIGINT UNSIGNED NOT NULL,
    designations_id BIGINT UNSIGNED NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    appraisal_date DATE NOT NULL,
    target_achievement , DECIMAL(10,2) NOT NULL,
    feedback TEXT NULL,
    goals TEXT NULL,
    subject TEXT NULL,
    branch TEXT NULL,
    target_rating VARCHAR (200) NOT NULL,
    overall_rating VARCHAR (200) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- Leave

CREATE TABLE hrm_weekly_holiday (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    day ENUM('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday') NOT NULL,
    company_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);



CREATE TABLE `hrm_leave_holidays` (
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



CREATE TABLE hrm_leave_applications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    employee_id BIGINT UNSIGNED NOT NULL,
    leave_type_id VARCHAR(255) NOT NULL,
    attendance_id BIGINT UNSIGNED NOT NULL,
    date DATE NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    number_of_days DECIMAL(5,2) NOT NULL,
    reason TEXT NOT NULL,
    duration VARCHAR(255) NOT NULL,
    statuses_id BIGINT UNSIGNED NOT NULL,
    approver_id BIGINT UNSIGNED DEFAULT NULL,
    photo VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);


CREATE TABLE hrm_leave_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(50) NOT NULL UNIQUE,
    description TEXT NULL,
    max_days INT NOT NULL DEFAULT 0,
    is_paid BOOLEAN NOT NULL DEFAULT 1,
    requires_approval BOOLEAN NOT NULL DEFAULT 1,
    carry_forward BOOLEAN NOT NULL DEFAULT 0,
    statuses_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE hrm_leave_application_approvers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    leave_application_id BIGINT UNSIGNED NOT NULL,
    approver_user_id BIGINT UNSIGNED NOT NULL,
    date DATE NOT NULL,
    approver_role VARCHAR(255) NOT NULL,
    statuses_id BIGINT UNSIGNED NOT NULL,
    approved_at TIMESTAMP NULL,
    rejected_at TIMESTAMP NULL,
    comments  TEXT NULL,
    photo VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);


 -- Notice Board

CREATE TABLE hrm_noticeboards (
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

CREATE TABLE `hrm_payroll_advanced_salaryes` (
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



CREATE TABLE `hrm_payroll_manage_employee_salaryes` (
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



CREATE TABLE hrm_payroll_employee_salaryes (
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

CREATE TABLE hrm_payslip_deductions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    employee_id INT,
    amount DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE hrm_payslip_allowances (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    employee_id INT,
    amount DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE hrm_payslip_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    employee_id INT,
    factor INT not null,
    amount DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE hrm_payslips (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    employee_id INT,
    statuses_id VARCHAR(100) NOT NULL,
    salary_month VARCHAR(10) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    basic_salary DECIMAL(10,2) NOT NULL,
    payslip_items_id INT NOT NULL,
    total_working_days TINYINT UNSIGNED DEFAULT 0,
    working_days_attendance TINYINT UNSIGNED DEFAULT 0,
    leaves_taken TINYINT UNSIGNED DEFAULT 0,
    balance_leaves TINYINT UNSIGNED DEFAULT 0,
    total_earnings DECIMAL(10,2),
    total_deductions DECIMAL(10,2),
    net_salary DECIMAL(10,2),
    payment_method VARCHAR (50) NOT NULL,
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE hrm_payslip_details (
    id INT PRIMARY KEY AUTO_INCREMENT,
    payslip_id INT NOT NULL,
    payslip_items_id INT NOT NULL,
    factor INT not null,
    allowance_amount DECIMAL(10,2),
    deduction_amount DECIMAL(10,2),
    total_amount DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


 -- Recruitment

CREATE TABLE `hrm_recruitment_candidatelists` (
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


CREATE TABLE `hrm_recruitment_interviewes` (
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



CREATE TABLE `hrm_Candidate selections` (
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


CREATE TABLE hrm_training_lists (
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



CREATE TABLE `hrm_trainers` (
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

CREATE TABLE hrm_employee_timesheets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    date DATE NOT NULL,
    shift_start TIME DEFAULT '00:00:00',
    shift_end TIME DEFAULT '00:00:00',
    clock_in TIME DEFAULT '00:00:00',
    clock_out TIME DEFAULT '00:00:00',
    break_duration INT DEFAULT 0,
    total_work_hours DECIMAL(5,2) DEFAULT '0.00',
    fixed_work_hours DECIMAL(5,2) DEFAULT '8',
    overtime_hours DECIMAL(5,2) DEFAULT '0.00',
    statuses_id BIGINT UNSIGNED NOT NULL,
    remarks TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


 -- Procurement


CREATE TABLE hrm_procurement_requests (
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



CREATE TABLE hrm_procurement_orders (
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



CREATE TABLE hrm_suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    contact_person VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(255),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);




CREATE TABLE hrm_procurement_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    item_name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10, 2),
    total_price DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES procurement_orders(id)
);




CREATE TABLE hrm_procurement_approvals (
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




CREATE TABLE hrm_procurement_payments (
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




CREATE TABLE hrm_procurement_audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    details TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
