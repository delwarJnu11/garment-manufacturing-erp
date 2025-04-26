<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_groups', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('system_generated')->default(1);
            $table->timestamps();
        });

        // Dummy Data
        DB::table('account_groups')->insert([
            ['code' => 1001, 'name' => 'Fixed Asset', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 1002, 'name' => 'Current Asset', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 1003, 'name' => 'Bank Accounts', 'description' => null, 'parent_id' => 2, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 1004, 'name' => 'Petty Cash', 'description' => null, 'parent_id' => 2, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 1005, 'name' => 'Accounts Receivable', 'description' => null, 'parent_id' => 2, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 1006, 'name' => 'Inventory', 'description' => null, 'parent_id' => 2, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 2001, 'name' => 'Long Term Liabilities', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 2002, 'name' => 'Short Term Liabilities', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 2003, 'name' => 'Loan Payable', 'description' => null, 'parent_id' => 7, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 2004, 'name' => 'Accounts Payable', 'description' => null, 'parent_id' => 8, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 3001, 'name' => 'Owner’s Equity', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 4001, 'name' => 'Sales Revenue', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 5001, 'name' => 'Operating Expenses', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 5002, 'name' => 'Cost of Goods Sold', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-10 19:38:43', 'updated_at' => '2025-03-10 19:38:43'],
            ['code' => 100205, 'name' => 'Cash', 'description' => 'All type of cash transactions', 'parent_id' => 2, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-19 13:28:09', 'updated_at' => '2025-03-19 13:28:09'],
            ['code' => 100206, 'name' => 'GMERP EBL', 'description' => 'Bank Transactions', 'parent_id' => 2, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-19 13:29:15', 'updated_at' => '2025-03-19 13:29:15'],
            ['code' => 300101, 'name' => 'Equity', 'description' => 'Equity of MERP', 'parent_id' => 11, 'is_active' => 1, 'system_generated' => 1, 'created_at' => '2025-03-22 19:28:01', 'updated_at' => '2025-03-22 19:28:01'],
        ]);

        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->string('name', 50);
            $table->foreignId('account_group_id')->constrained('account_groups');
            $table->integer('parent_id')->nullable();
            $table->integer('is_payment_method')->default(0);
            $table->integer('is_trx_no_required')->default(0);
            $table->text('description')->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });

        DB::table('accounts')->insert([
            ['code' => 10050106, 'name' => 'Fashion Apparel Co.', 'account_group_id' => 5, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Pending payment from Fashion Apparel Co.', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 10050107, 'name' => 'Trendy Styles Ltd.', 'account_group_id' => 5, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Outstanding invoice from Trendy Styles Ltd.', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 10050108, 'name' => 'Elegant Threads', 'account_group_id' => 5, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Pending payment from Elegant Threads', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 10050109, 'name' => 'Chic Couture Ltd.', 'account_group_id' => 5, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Outstanding invoice from Chic Couture Ltd.', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 20040106, 'name' => 'Textile Suppliers Ltd.', 'account_group_id' => 10, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Pending payment for fabric purchase', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 20040107, 'name' => 'Button & Zipper Co.', 'account_group_id' => 10, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Outstanding payment for buttons and zippers', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 20040108, 'name' => 'Fabric World Inc.', 'account_group_id' => 10, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Pending payment for fabric supplies', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 20040109, 'name' => 'Packaging Solutions Co.', 'account_group_id' => 10, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Outstanding payment for packaging materials', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 40010101, 'name' => 'Wholesale Clothing Sales', 'account_group_id' => 12, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Revenue from wholesale clothing sales', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 40010102, 'name' => 'Custom Apparel Sales', 'account_group_id' => 12, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Revenue from custom apparel orders', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010101, 'name' => 'Salaries & Wages', 'account_group_id' => 13, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Salaries and wages for factory workers', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010102, 'name' => 'Factory Rent', 'account_group_id' => 13, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Rent for factory premises', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010201, 'name' => 'Fabric Cost', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Cost of raw fabric used in production', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010202, 'name' => 'Packaging Cost', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Cost of packaging materials', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010203, 'name' => 'Shipping Cost', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Shipping and delivery cost for orders', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010204, 'name' => 'Operating Expenses', 'account_group_id' => 13, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Expenses incurred in normal business operations', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010205, 'name' => 'Rent Expense', 'account_group_id' => 13, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Costs related to leasing property', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010206, 'name' => 'Utilities Expense', 'account_group_id' => 13, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Costs for electricity, water, etc.', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010207, 'name' => 'Depreciation', 'account_group_id' => 13, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Depreciation of assets', 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010208, 'name' => 'Cost of Goods Sold (COGS)', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010209, 'name' => 'Direct Labor', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010210, 'name' => 'Direct Materials', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010211, 'name' => 'Manufacturing Overhead', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010212, 'name' => 'Inventory Write-offs', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010213, 'name' => 'Office Supplies', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010214, 'name' => 'Insurance', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010215, 'name' => 'Advertising and Marketing', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010216, 'name' => 'Travel and Meals', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010217, 'name' => 'Payroll Taxes', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010218, 'name' => 'Professional Fees', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010219, 'name' => 'Bank Fees', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010220, 'name' => 'Other Expenses', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010221, 'name' => 'Interest Expense', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010222, 'name' => 'Loss on Sale of Assets', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 50010223, 'name' => 'Miscellaneous Expenses', 'account_group_id' => 14, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 100301, 'name' => 'GMERP EBL', 'account_group_id' => 3, 'parent_id' => null, 'is_payment_method' => 1, 'is_trx_no_required' => 1, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 10020501, 'name' => 'Cash', 'account_group_id' => 20, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 30010101, 'name' => 'Mr. Delwar', 'account_group_id' => 22, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 30010102, 'name' => 'SM Rana', 'account_group_id' => 22, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 30010103, 'name' => 'Miss Farzana', 'account_group_id' => 22, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 30010104, 'name' => 'Md. Helal Uddin', 'account_group_id' => 22, 'parent_id' => null, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => null, 'is_active' => 1, 'created_by' => 1, 'updated_by' => null, 'created_at' => now(), 'updated_at' => now()]
        ]);
        

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_ref', 200);
            $table->date('transaction_date');
            $table->foreignId('account_id')->constrained('accounts');
            $table->decimal('amount', 15, 2);
            $table->text('description')->nullable();
            $table->integer('transaction_against')->nullable();
            $table->decimal('debit', 10, 2)->default(0.00);
            $table->decimal('credit', 10, 2)->default(0.00);
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('account_groups');
    }
};
