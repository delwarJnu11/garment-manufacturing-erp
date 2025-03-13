<?php

use App\Models\BankAccount;
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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('account_for_id')->comment('1=Supplier, 2=Buyer');
            $table->timestamps();
        });
        BankAccount::create([
            'account_for_id' => 1,
            'name' => 'Global Textiles Ltd. – Account: 100987654321'
        ]);

        BankAccount::create([
            'account_for_id' => 1,
            'name' => 'Raw Materials Hub – Account: 200123456789'
        ]);

        BankAccount::create([
            'account_for_id' => 1,
            'name' => 'Superior Fabrics Co. – Account: 300987123654'
        ]);

        BankAccount::create([
            'account_for_id' => 1,
            'name' => 'EcoDye Chemical Suppliers – Account: 400765432189'
        ]);

        BankAccount::create([
            'account_for_id' => 1,
            'name' => 'Prime Yarn Distributors – Account: 500234567890'
        ]);

        BankAccount::create([
            'account_for_id' => 2,
            'name' => 'Elite Fashion House – Account: 600123987654'
        ]);

        BankAccount::create([
            'account_for_id' => 2,
            'name' => 'Trendy Wear Ltd. – Account: 700456321098'
        ]);

        BankAccount::create([
            'account_for_id' => 2,
            'name' => 'Urban Outfitters Inc. – Account: 800765432109'
        ]);

        BankAccount::create([
            'account_for_id' => 2,
            'name' => 'Modern Apparel Co. – Account: 900876543210'
        ]);

        BankAccount::create([
            'account_for_id' => 2,
            'name' => 'Global Retail Solutions – Account: 101098765432'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
