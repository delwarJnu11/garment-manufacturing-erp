<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the account_groups table
        if (!Schema::hasTable("account_groups")) {
            Schema::create("account_groups", function (Blueprint $table) {
                $table->id();
                $table->integer("code");
                $table->string("name");
                $table->text("description")->nullable();
                $table->integer("parent_id")->nullable();
                $table->integer("is_active")->default(1);
                $table->integer("system_generated")->default(1);
                $table->timestamps(0); // `created_at` and `updated_at` timestamps
            });
        }


        if (!Schema::hasTable("accounts")) {
            Schema::create("accounts", function (Blueprint $table) {
                $table->id();
                $table->integer("code");
                $table->string("name", 50);
                $table->integer("account_group_id");
                $table->integer("parent_id")->nullable();  // For sub-accounts
                $table->integer("is_payment_method")->default(0);
                $table->integer("is_trx_no_required")->default(0);
                $table->text("description")->nullable();
                $table->integer("is_active")->default(1);
                // $table->dateTime("created_at")->default(DB::raw("CURRENT_TIMESTAMP"));
                $table->integer("created_by")->nullable();
                // $table->dateTime("updated_at")->nullable();
                $table->integer("updated_by")->nullable();
                $table->timestamps(0); // `created_at` and `updated_at` timestamps
            });

        }

        // Insert account group records based on Chart of Accounts (COA)
        DB::table("account_groups")->insert(
            [
                // Assets (1000-1999)
                ["code" => 1000, "name" => "Current Assets", "description" => "Assets that are expected to be converted to cash or used up within one year", "parent_id" => null],
                ["code" => 1100, "name" => "Cash", "description" => "Cash in hand or bank", "parent_id" => 1000],
                ["code" => 1200, "name" => "Accounts Receivable", "description" => "Amounts due from customers", "parent_id" => 1000],
                ["code" => 1300, "name" => "Inventory", "description" => "Goods available for sale", "parent_id" => 1000],
                ["code" => 1400, "name" => "Prepaid Expenses", "description" => "Expenses paid in advance", "parent_id" => 1000],

                // Liabilities (2000-2999)
                ["code" => 2000, "name" => "Current Liabilities", "description" => "Liabilities expected to be settled within one year", "parent_id" => null],
                ["code" => 2100, "name" => "Accounts Payable", "description" => "Amounts owed to suppliers", "parent_id" => 2000],
                ["code" => 2200, "name" => "Short-term Loans", "description" => "Loans that are due within one year", "parent_id" => 2000],

                // Equity (3000-3999)
                ["code" => 3000, "name" => "Shareholders\" Equity", "description" => "Owner’s equity in the business", "parent_id" => null],
                ["code" => 3100, "name" => "Common Stock", "description" => "Equity from issued shares", "parent_id" => 3000],
                ["code" => 3200, "name" => "Retained Earnings", "description" => "Profits that are reinvested in the business", "parent_id" => 3000],

                // Revenue (4000-4999)
                ["code" => 4000, "name" => "Revenue", "description" => "Income earned from business operations", "parent_id" => null],
                ["code" => 4100, "name" => "Sales Revenue", "description" => "Revenue from selling goods or services", "parent_id" => 4000],
                ["code" => 4200, "name" => "Service Revenue", "description" => "Revenue from providing services", "parent_id" => 4000],

                // Expenses (5000-5999)
                ["code" => 5000, "name" => "Operating Expenses", "description" => "Expenses incurred in normal business operations", "parent_id" => null],
                ["code" => 5100, "name" => "Salaries and Wages", "description" => "Employee compensation expenses", "parent_id" => 5000],
                ["code" => 5200, "name" => "Rent Expense", "description" => "Costs related to leasing property", "parent_id" => 5000],
                ["code" => 5300, "name" => "Utilities Expense", "description" => "Costs for electricity, water, etc.", "parent_id" => 5000],
                ["code" => 5400, "name" => "Depreciation", "description" => "Depreciation of assets", "parent_id" => 5000],

            ]);

        DB::table("accounts")->insert([
            // 1. Assets
            ["code" => 1000, "name" => "Current Assets", "account_group_id" => 1],
            ["code" => 1010, "name" => "Cash", "account_group_id" => 1, "parent_id" => 1000],
            ["code" => 1020, "name" => "Accounts Receivable", "account_group_id" => 1, "parent_id" => 1000],
            ["code" => 1030, "name" => "Inventory", "account_group_id" => 1, "parent_id" => 1000],
            ["code" => 1040, "name" => "Prepaid Expenses", "account_group_id" => 1, "parent_id" => 1000],
            ["code" => 1050, "name" => "Short-Term Investments", "account_group_id" => 1, "parent_id" => 1000],

            ["code" => 1100, "name" => "Fixed Assets", "account_group_id" => 1],
            ["code" => 1110, "name" => "Property, Plant & Equipment (PP&E)", "account_group_id" => 1, "parent_id" => 1100],
            ["code" => 1120, "name" => "Accumulated Depreciation", "account_group_id" => 1, "parent_id" => 1100],
            ["code" => 1130, "name" => "Furniture and Fixtures", "account_group_id" => 1, "parent_id" => 1100],
            ["code" => 1140, "name" => "Vehicles", "account_group_id" => 1, "parent_id" => 1100],
            ["code" => 1150, "name" => "Computer Equipment", "account_group_id" => 1, "parent_id" => 1100],

            ["code" => 1200, "name" => "Other Assets", "account_group_id" => 1],
            ["code" => 1210, "name" => "Intangible Assets", "account_group_id" => 1, "parent_id" => 1200],
            ["code" => 1220, "name" => "Deposits", "account_group_id" => 1, "parent_id" => 1200],

            // 2. Liabilities
            ["code" => 2000, "name" => "Current Liabilities", "account_group_id" => 2],
            ["code" => 2010, "name" => "Accounts Payable", "account_group_id" => 2, "parent_id" => 2000],
            ["code" => 2020, "name" => "Accrued Expenses", "account_group_id" => 2, "parent_id" => 2000],
            ["code" => 2030, "name" => "Short-Term Loans", "account_group_id" => 2, "parent_id" => 2000],
            ["code" => 2040, "name" => "Sales Tax Payable", "account_group_id" => 2, "parent_id" => 2000],
            ["code" => 2050, "name" => "Payroll Liabilities", "account_group_id" => 2, "parent_id" => 2000],
            ["code" => 2060, "name" => "Credit Cards Payable", "account_group_id" => 2, "parent_id" => 2000],

            ["code" => 2100, "name" => "Long-Term Liabilities", "account_group_id" => 2],
            ["code" => 2110, "name" => "Long-Term Loans", "account_group_id" => 2, "parent_id" => 2100],
            ["code" => 2120, "name" => "Mortgages Payable", "account_group_id" => 2, "parent_id" => 2100],
            ["code" => 2130, "name" => "Notes Payable", "account_group_id" => 2, "parent_id" => 2100],

            // 3. Equity
            ["code" => 3000, "name" => "Owner’s Equity", "account_group_id" => 3],
            ["code" => 3010, "name" => "Owner’s Capital", "account_group_id" => 3, "parent_id" => 3000],
            ["code" => 3020, "name" => "Retained Earnings", "account_group_id" => 3, "parent_id" => 3000],
            ["code" => 3030, "name" => "Distributions/Draws", "account_group_id" => 3, "parent_id" => 3000],
            ["code" => 3040, "name" => "Stockholder Equity", "account_group_id" => 3, "parent_id" => 3000],
            ["code" => 3050, "name" => "Dividends Payable", "account_group_id" => 3, "parent_id" => 3000],

            // 4. Revenue (Income)
            ["code" => 4000, "name" => "Revenue (Sales)", "account_group_id" => 4],
            ["code" => 4010, "name" => "Sales Revenue", "account_group_id" => 4, "parent_id" => 4000],
            ["code" => 4020, "name" => "Service Revenue", "account_group_id" => 4, "parent_id" => 4000],
            ["code" => 4030, "name" => "Other Income", "account_group_id" => 4, "parent_id" => 4000],
            ["code" => 4040, "name" => "Interest Income", "account_group_id" => 4, "parent_id" => 4000],

            ["code" => 4100, "name" => "Discounts and Returns", "account_group_id" => 4],
            ["code" => 4110, "name" => "Sales Discounts", "account_group_id" => 4, "parent_id" => 4100],
            ["code" => 4120, "name" => "Sales Returns and Allowances", "account_group_id" => 4, "parent_id" => 4100],

            // 5. Expenses
            ["code" => 5000, "name" => "Cost of Goods Sold (COGS)", "account_group_id" => 5],
            ["code" => 5010, "name" => "Direct Labor", "account_group_id" => 5, "parent_id" => 5000],
            ["code" => 5020, "name" => "Direct Materials", "account_group_id" => 5, "parent_id" => 5000],
            ["code" => 5030, "name" => "Manufacturing Overhead", "account_group_id" => 5, "parent_id" => 5000],
            ["code" => 5040, "name" => "Inventory Write-offs", "account_group_id" => 5, "parent_id" => 5000],

            ["code" => 6000, "name" => "Operating Expenses", "account_group_id" => 5],
            ["code" => 6010, "name" => "Rent Expense", "account_group_id" => 5, "parent_id" => 6000],
            ["code" => 6020, "name" => "Utilities", "account_group_id" => 5, "parent_id" => 6000],
            ["code" => 6030, "name" => "Office Supplies", "account_group_id" => 5, "parent_id" => 6000],
            ["code" => 6040, "name" => "Insurance", "account_group_id" => 5, "parent_id" => 6000],
            ["code" => 6050, "name" => "Advertising and Marketing", "account_group_id" => 5, "parent_id" => 6000],
            ["code" => 6060, "name" => "Travel and Meals", "account_group_id" => 5, "parent_id" => 6000],
            ["code" => 6070, "name" => "Salaries and Wages", "account_group_id" => 5, "parent_id" => 6000],
            ["code" => 6080, "name" => "Payroll Taxes", "account_group_id" => 5, "parent_id" => 6000],
            ["code" => 6090, "name" => "Professional Fees", "account_group_id" => 5, "parent_id" => 6000],
            ["code" => 6100, "name" => "Depreciation Expense", "account_group_id" => 5, "parent_id" => 6000],
            ["code" => 6110, "name" => "Bank Fees", "account_group_id" => 5, "parent_id" => 6000],

            ["code" => 7000, "name" => "Other Expenses", "account_group_id" => 5],
            ["code" => 7010, "name" => "Interest Expense", "account_group_id" => 5, "parent_id" => 7000],
            ["code" => 7020, "name" => "Loss on Sale of Assets", "account_group_id" => 5, "parent_id" => 7000],
            ["code" => 7030, "name" => "Miscellaneous Expenses", "account_group_id" => 5, "parent_id" => 7000],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        // Schema::dropIfExists("account_groups");
        // Schema::dropIfExists("accounts");
    }
};

// php artisan migrate --path=database/migrations/2025_02_23_061028_create_Charts_Of_Accounts.php;