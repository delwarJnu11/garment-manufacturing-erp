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
        
       

        DB::table('account_groups')->insert([
            // Asset Groups
            ['id' => 1, 'code' => 1001, 'name' => 'Fixed Asset', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'code' => 1002, 'name' => 'Current Asset', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'code' => 1003, 'name' => 'Bank Accounts', 'description' => null, 'parent_id' => 2, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'code' => 1004, 'name' => 'Petty Cash', 'description' => null, 'parent_id' => 2, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'code' => 1005, 'name' => 'Accounts Receivable', 'description' => null, 'parent_id' => 2, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'code' => 1006, 'name' => 'Inventory', 'description' => null, 'parent_id' => 2, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            // Liabilities Groups
            ['id' => 7, 'code' => 2001, 'name' => 'Long Term Liabilities', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'code' => 2002, 'name' => 'Short Term Liabilities', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'code' => 2003, 'name' => 'Loan Payable', 'description' => null, 'parent_id' => 7, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'code' => 2004, 'name' => 'Accounts Payable', 'description' => null, 'parent_id' => 8, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            // Equity Groups
            ['id' => 11, 'code' => 3001, 'name' => 'Owner’s Equity', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            // Revenue Groups
            ['id' => 12, 'code' => 4001, 'name' => 'Sales Revenue', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
            
            // Expense Groups
            ['id' => 13, 'code' => 5001, 'name' => 'Operating Expenses', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'code' => 5002, 'name' => 'Cost of Goods Sold', 'description' => null, 'parent_id' => null, 'is_active' => 1, 'system_generated' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
        
        DB::table('accounts')->insert([
            // Accounts Receivable (Garments Manufacturing)
            ['id' => 10050106, 'code' => '10050106', 'name' => 'Fashion Apparel Co.', 'account_group_id' => 5, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Pending payment from Fashion Apparel Co.', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
            ['id' => 10050107, 'code' => '10050107', 'name' => 'Trendy Styles Ltd.', 'account_group_id' => 5, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Outstanding invoice from Trendy Styles Ltd.', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
            ['id' => 10050108, 'code' => '10050108', 'name' => 'Elegant Threads', 'account_group_id' => 5, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Pending payment from Elegant Threads', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
            ['id' => 10050109, 'code' => '10050109', 'name' => 'Chic Couture Ltd.', 'account_group_id' => 5, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Outstanding invoice from Chic Couture Ltd.', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
        
            // Accounts Payable (Garments Manufacturing)
            ['id' => 20040106, 'code' => '20040106', 'name' => 'Textile Suppliers Ltd.', 'account_group_id' => 10, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Pending payment for fabric purchase', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
            ['id' => 20040107, 'code' => '20040107', 'name' => 'Button & Zipper Co.', 'account_group_id' => 10, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Outstanding payment for buttons and zippers', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
            ['id' => 20040108, 'code' => '20040108', 'name' => 'Fabric World Inc.', 'account_group_id' => 10, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Pending payment for fabric supplies', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
            ['id' => 20040109, 'code' => '20040109', 'name' => 'Packaging Solutions Co.', 'account_group_id' => 10, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Outstanding payment for packaging materials', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
        
            // Revenue (Garments Manufacturing)
            ['id' => 40010101, 'code' => '40010101', 'name' => 'Wholesale Clothing Sales', 'account_group_id' => 12, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Revenue from wholesale clothing sales', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
            ['id' => 40010102, 'code' => '40010102', 'name' => 'Custom Apparel Sales', 'account_group_id' => 12, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Revenue from custom apparel orders', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
        
            // Expense (Garments Manufacturing)
            ['id' => 50010101, 'code' => '50010101', 'name' => 'Salaries & Wages', 'account_group_id' => 13, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Salaries and wages for factory workers', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
            ['id' => 50010102, 'code' => '50010102', 'name' => 'Factory Rent', 'account_group_id' => 13, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Rent for factory premises', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
            ['id' => 50010201, 'code' => '50010201', 'name' => 'Fabric Cost', 'account_group_id' => 14, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Cost of raw fabric used in production', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
            ['id' => 50010202, 'code' => '50010202', 'name' => 'Packaging Cost', 'account_group_id' => 14, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Cost of packaging materials', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
            ['id' => 50010203, 'code' => '50010203', 'name' => 'Shipping Cost', 'account_group_id' => 14, 'is_payment_method' => 0, 'is_trx_no_required' => 0, 'description' => 'Shipping and delivery cost for orders', 'is_active' => 1, 'created_at' => now(), 'created_by' => 127, 'updated_at' => now(), 'updated_by' => 127],
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
