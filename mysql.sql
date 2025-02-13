

CREATE TABLE employees (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    dob DATE,
    gender ENUM('Male', 'Female', 'Other'),
    contact_number VARCHAR(15),
    email VARCHAR(100),
    address TEXT,
    department_id INT,
    hire_date DATE,
    position VARCHAR(100),
    salary DECIMAL(10, 2),
    status ENUM('Active', 'Inactive', 'Resigned', 'Terminated'),
    FOREIGN KEY (department_id) REFERENCES departments(department_id)
);




CREATE TABLE departments (
    department_id INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(100),
    description TEXT
);



CREATE TABLE attendance (
    attendance_id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    check_in DATETIME,
    check_out DATETIME,
    status ENUM('Present', 'Absent', 'Leave', 'Late'),
    FOREIGN KEY (employee_id) REFERENCES employees(employee_id)
);



CREATE TABLE leaves (
    leave_id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    leave_type ENUM('Sick', 'Vacation', 'Casual', 'Maternity', 'Other'),
    start_date DATE,
    end_date DATE,
    leave_status ENUM('Pending', 'Approved', 'Rejected'),
    reason TEXT,
    FOREIGN KEY (employee_id) REFERENCES employees(employee_id)
);



CREATE TABLE payroll (
    payroll_id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    pay_date DATE,
    basic_salary DECIMAL(10, 2),
    bonuses DECIMAL(10, 2),
    deductions DECIMAL(10, 2),
    net_salary DECIMAL(10, 2),
    FOREIGN KEY (employee_id) REFERENCES employees(employee_id)
);




CREATE TABLE performance (
    performance_id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    review_period DATE,
    performance_rating ENUM('Excellent', 'Good', 'Average', 'Poor'),
    feedback TEXT,
    FOREIGN KEY (employee_id) REFERENCES employees(employee_id)
);



CREATE TABLE training (
    training_id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    training_name VARCHAR(255),
    training_date DATE,
    trainer_name VARCHAR(255),
    training_location VARCHAR(255),
    FOREIGN KEY (employee_id) REFERENCES employees(employee_id)
);



CREATE TABLE exits (
    exit_id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    exit_date DATE,
    exit_reason ENUM('Resignation', 'Retirement', 'Termination', 'Other'),
    clearance_status ENUM('Pending', 'Completed'),
    exit_interview_notes TEXT,
    FOREIGN KEY (employee_id) REFERENCES employees(employee_id)
);




CREATE TABLE status (
    status_id INT AUTO_INCREMENT PRIMARY KEY,
    Pending VARCHAR(100),
    Approved VARCHAR(100),
    Rejected VARCHAR(100),
    FOREIGN KEY (employee_id) REFERENCES employees(employee_id)
);
