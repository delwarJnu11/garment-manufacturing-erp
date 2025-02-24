<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('accounts');
    }
};
