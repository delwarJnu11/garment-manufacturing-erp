<?php

use App\Models\InvSupplier;
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
        Schema::create('inv_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('bank_account_id')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('address');
            $table->string('photo')->nullable();
            $table->timestamps();
        });

        DB::table('inv_suppliers')->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'bank_account_id' => '4',
            'email' => 'john.doe@example.com',
            'phone' => '+88015510000001',
            'address' => '123 Main St, Dhaka, Bangladesh',
            'photo' => 'https://randomuser.me/api/portraits/men/1.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
