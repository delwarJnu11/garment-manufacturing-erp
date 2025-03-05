<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        if (!Schema::hasTable('accounts')) {
            Schema::create('accounts', function (Blueprint $table) {
                $table->id();
                $table->integer('code');
                $table->string('name', 50);
                $table->integer('account_group_id');
                $table->integer('is_payment_method')->default(0);
                $table->integer('is_trx_no_required')->default(0);
                $table->text('description')->nullable();
                $table->integer('is_active')->default(1);
                $table->timestamp('created_at')->useCurrent();
                $table->integer('created_by')->nullable();
                $table->timestamp('updated_at')->nullable();
                $table->integer('updated_by')->nullable();
            });
        }
        

        if (!Schema::hasTable('account_types')) {
            Schema::create('account_types', function (Blueprint $table) {
                $table->id();
                $table->string('name', 50);
                $table->timestamps(0); // This will add `created_at` and `updated_at` columns
            });
        }

    
        if (!Schema::hasTable('account_groups')) {
            Schema::create('account_groups', function (Blueprint $table) {
                $table->id();
                $table->integer('code');
                $table->string('name', 50);
                $table->text('description')->nullable();
                $table->integer('parent_id')->nullable();
                $table->integer('is_active')->default(1);
                $table->integer('system_generated')->default(1);
                $table->timestamps(0); // This will add `created_at` and `updated_at` columns
            });
        }

        if (!Schema::hasTable('transactions')) {
            Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->string('voucher_ref', 200);
                $table->date('transaction_date');
                $table->integer('account_id');
                $table->decimal('amount', 15, 2);
                $table->text('description')->nullable();
                $table->integer('transaction_against')->nullable();
                $table->decimal('debit', 10, 2)->default(0.00);
                $table->decimal('credit', 10, 2)->default(0.00);
                $table->integer('user_id')->nullable();
                $table->timestamps(0); // This will add `created_at` and `updated_at` columns
            });
        }

        DB::table('accounts')->insert([
            // **Assets Accounts:**
            ['code' => 1001, 'name' => 'Cash', 'account_group_id' => 1, 'is_payment_method' => 1, 'is_trx_no_required' => 0, 'description' => 'Cash on hand', 'is_active' => 1],
            ['code' => 1002, 'name' => 'Bank Account (Main)', 'account_group_id' => 1, 'is_payment_method' => 1, 'is_trx_no_required' => 0, 'description' => 'Main operating bank account', 'is_active' => 1],
            ['code' => 1003, 'name' => 'Bank Account (Secondary)', 'account_group_id' => 1, 'is_payment_method' => 1, 'is_trx_no_required' => 0, 'description' => 'Secondary bank account', 'is_active' => 1],
            ['code' => 1004, 'name' => 'Accounts Receivable (Customers)', 'account_group_id' => 2, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Receivables from customers', 'is_active' => 1],
            ['code' => 1005, 'name' => 'Raw Materials Inventory', 'account_group_id' => 3, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Inventory of raw materials', 'is_active' => 1],
            ['code' => 1006, 'name' => 'Work-in-Progress (WIP)', 'account_group_id' => 3, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Work-in-progress items', 'is_active' => 1],
            ['code' => 1007, 'name' => 'Finished Goods Inventory', 'account_group_id' => 3, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Inventory of finished goods', 'is_active' => 1],
            ['code' => 1008, 'name' => 'Prepaid Expenses', 'account_group_id' => 3, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Prepaid expenses for future periods', 'is_active' => 1],
            ['code' => 1009, 'name' => 'Fixed Assets', 'account_group_id' => 3, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Fixed assets (machinery, office equipment, etc.)', 'is_active' => 1],
            ['code' => 1010, 'name' => 'Machinery and Equipment', 'account_group_id' => 3, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Machinery and equipment used in production', 'is_active' => 1],
            ['code' => 1011, 'name' => 'Office Equipment', 'account_group_id' => 3, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Office equipment and furnishings', 'is_active' => 1],
            ['code' => 1012, 'name' => 'Vehicles', 'account_group_id' => 3, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Vehicles used for transportation', 'is_active' => 1],
            ['code' => 1013, 'name' => 'Accrued Income', 'account_group_id' => 3, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Income that is earned but not yet received', 'is_active' => 1],
        
            // **Liabilities Accounts:**
            ['code' => 2001, 'name' => 'Accounts Payable (Suppliers)', 'account_group_id' => 4, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Payables to suppliers', 'is_active' => 1],
            ['code' => 2002, 'name' => 'Short-term Loans', 'account_group_id' => 4, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Short-term loans due within a year', 'is_active' => 1],
            ['code' => 2003, 'name' => 'Long-term Loans', 'account_group_id' => 4, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Long-term loans due after more than a year', 'is_active' => 1],
            ['code' => 2004, 'name' => 'Accrued Liabilities', 'account_group_id' => 4, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Accrued liabilities (taxes, wages, etc.)', 'is_active' => 1],
            ['code' => 2005, 'name' => 'Accrued Wages', 'account_group_id' => 4, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Wages accrued but not yet paid', 'is_active' => 1],
            ['code' => 2006, 'name' => 'Accrued Taxes', 'account_group_id' => 4, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Taxes accrued but not yet paid', 'is_active' => 1],
            ['code' => 2007, 'name' => 'Accrued Expenses', 'account_group_id' => 4, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Expenses accrued but not yet paid', 'is_active' => 1],
            ['code' => 2008, 'name' => 'VAT Payable', 'account_group_id' => 4, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Value Added Tax payable to authorities', 'is_active' => 1],
            ['code' => 2009, 'name' => 'Sales Tax Payable', 'account_group_id' => 4, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Sales tax payable to authorities', 'is_active' => 1],
            ['code' => 2010, 'name' => 'Customer Advances / Deposits', 'account_group_id' => 4, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Advance payments or deposits received from customers', 'is_active' => 1],
        
            // **Equity Accounts:**
            ['code' => 3001, 'name' => 'Owner\'s Equity / Capital', 'account_group_id' => 5, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Capital invested by the owner(s)', 'is_active' => 1],
            ['code' => 3002, 'name' => 'Retained Earnings', 'account_group_id' => 5, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Profits retained in the business', 'is_active' => 1],
            ['code' => 3003, 'name' => 'Dividends Payable', 'account_group_id' => 5, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Dividends owed to shareholders', 'is_active' => 1],
            ['code' => 3004, 'name' => 'Other Comprehensive Income', 'account_group_id' => 5, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Other income not included in retained earnings', 'is_active' => 1],
        
            // **Revenue Accounts:**
            ['code' => 4001, 'name' => 'Sales Revenue - Garment Sales', 'account_group_id' => 6, 'is_payment_method' => 0, 'is_trx_no_required' => 1, 'description' => 'Revenue from garment sales', 'is_active' => 1],
            ['code' => 4002, 'name' => 'Sales Revenue - Custom Orders', 'account_group_id' => 6, 'is_payment_method' => 0, 'is_trx_no_required' => 1, 'description' => 'Revenue from custom orders', 'is_active' => 1],
            ['code' => 4003, 'name' => 'Sales Revenue - Wholesale', 'account_group_id' => 6, 'is_payment_method' => 0, 'is_trx_no_required' => 1, 'description' => 'Revenue from wholesale garment sales', 'is_active' => 1],
            ['code' => 4004, 'name' => 'Service Income - Shipping', 'account_group_id' => 6, 'is_payment_method' => 0, 'is_trx_no_required' => 1, 'description' => 'Revenue from shipping services', 'is_active' => 1],
            ['code' => 4005, 'name' => 'Service Income - Embroidery Services', 'account_group_id' => 6, 'is_payment_method' => 0, 'is_trx_no_required' => 1, 'description' => 'Revenue from embroidery services', 'is_active' => 1],
            ['code' => 4006, 'name' => 'Other Revenue - Miscellaneous', 'account_group_id' => 6, 'is_payment_method' => 0, 'is_trx_no_required' => 1, 'description' => 'Other miscellaneous revenue sources', 'is_active' => 1],
        
            // **Cost of Goods Sold (COGS):**
            ['code' => 5001, 'name' => 'Direct Material Costs - Fabric', 'account_group_id' => 7, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Cost of fabric used in production', 'is_active' => 1],
            ['code' => 5002, 'name' => 'Direct Material Costs - Trims & Accessories', 'account_group_id' => 7, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Cost of trims and accessories used in production', 'is_active' => 1],
            ['code' => 5003, 'name' => 'Direct Labor Costs - Production Staff', 'account_group_id' => 7, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Wages for production staff', 'is_active' => 1],
            ['code' => 5004, 'name' => 'Manufacturing Overhead - Factory Utilities', 'account_group_id' => 7, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Utilities used in the factory', 'is_active' => 1],
            ['code' => 5005, 'name' => 'Manufacturing Overhead - Machine Maintenance', 'account_group_id' => 7, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Machine maintenance and repair costs', 'is_active' => 1],
            ['code' => 5006, 'name' => 'Manufacturing Overhead - Factory Rent', 'account_group_id' => 7, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Rent for the factory building', 'is_active' => 1],
            ['code' => 5007, 'name' => 'Manufacturing Overhead - Depreciation', 'account_group_id' => 7, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Depreciation of factory assets and machinery', 'is_active' => 1],
            ['code' => 5008, 'name' => 'Freight and Shipping Costs', 'account_group_id' => 7, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Shipping costs for raw materials and goods', 'is_active' => 1],
            ['code' => 5009, 'name' => 'Custom Duties', 'account_group_id' => 7, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Import duties on raw materials or goods', 'is_active' => 1],
        
            // **Operating Expenses:**
            ['code' => 6001, 'name' => 'Selling Expenses - Marketing', 'account_group_id' => 8, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Expenses related to marketing and advertising', 'is_active' => 1],
            ['code' => 6002, 'name' => 'General Expenses - Salaries', 'account_group_id' => 8, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Salaries of administrative and office staff', 'is_active' => 1],
            ['code' => 6003, 'name' => 'Office Supplies', 'account_group_id' => 8, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Costs of office supplies and materials', 'is_active' => 1],
            ['code' => 6004, 'name' => 'Legal & Professional Fees', 'account_group_id' => 8, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Expenses for legal, audit, and consulting services', 'is_active' => 1],
        
            // **Tax Accounts:**
            ['code' => 7001, 'name' => 'Income Tax Payable', 'account_group_id' => 9, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Income tax payable', 'is_active' => 1],
            ['code' => 7002, 'name' => 'Sales Tax Receivable', 'account_group_id' => 9, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Sales tax receivable from customers', 'is_active' => 1],
            ['code' => 7003, 'name' => 'Withholding Tax Payable', 'account_group_id' => 9, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Taxes withheld from payments and payable to authorities', 'is_active' => 1],
            ['code' => 7004, 'name' => 'Other Tax Payables', 'account_group_id' => 9, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Other tax payables (VAT, excise tax, etc.)', 'is_active' => 1],
        
            // **Miscellaneous Accounts:**
            ['code' => 8001, 'name' => 'Bank Charges', 'account_group_id' => 10, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Bank fees and charges', 'is_active' => 1],
            ['code' => 8002, 'name' => 'Foreign Exchange Gain/Loss', 'account_group_id' => 10, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Gain or loss from currency exchange rate fluctuations', 'is_active' => 1],
            ['code' => 8003, 'name' => 'Interest Income', 'account_group_id' => 10, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Interest earned from bank accounts or investments', 'is_active' => 1],
            ['code' => 8004, 'name' => 'Interest Expense', 'account_group_id' => 10, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Interest paid on loans or debts', 'is_active' => 1],
            ['code' => 8005, 'name' => 'Loss on Sale of Assets', 'account_group_id' => 10, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Loss incurred from selling assets below their book value', 'is_active' => 1],
        ]);
        

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('accounts');
    }
};
