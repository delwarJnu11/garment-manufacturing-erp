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
