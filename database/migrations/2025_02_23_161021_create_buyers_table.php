<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buyers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('bank_account_id')->nullable();
            $table->string('photo')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->text('shipping_address')->nullable();
            $table->text('billing_address')->nullable();
            $table->timestamps();
        });

        // Insert a single record
        DB::table('buyers')->insert(
            [
                [
                    'first_name' => 'Andrew',
                    'last_name' => 'Ray',
                    'account_for_id' => '1',
                    'photo' => 'https://via.placeholder.com/150',
                    'email' => 'ray@example.com',
                    'phone' => '+1234567890',
                    'country' => 'USA',
                    'shipping_address' => '1234 Elm Street, Springfield, IL',
                    'billing_address' => '1234 Elm Street, Springfield, IL',
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
