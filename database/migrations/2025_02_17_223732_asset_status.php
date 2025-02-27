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
        Schema::create('asset_status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        DB::table('asset_status')->insert([
            [
                'name' => 'Active',
                'description' => "The asset is currently in use, operational, and part of the active inventory."
            ],
            [
                'name' => 'Inactive',
                'description' => "The asset is not currently in use but is still available for future use. This could mean it's temporarily out of service, under repair, or stored but not actively being used."
            ],
            [
                'name' => 'Disposed',
                'description' => "The asset has been disposed of, sold, or written off. It’s no longer part of the organization's assets."
            ],
            [
                'name' => 'Retired',
                'description' => "The asset is no longer in use but hasn't been disposed of yet. It might be archived or stored, pending disposal."
            ],
            [
                'name' => 'Under Maintenance',
                'description' => "The asset is undergoing repairs or maintenance, and it's not currently operational but will be once repaired."
            ],
            [
                'name' => 'Decommissioned',
                'description' => "The asset is permanently removed from active use, usually due to age, obsolescence, or irreparable damage. It may be waiting for disposal or recycling."
            ],
            [
                'name' => 'On Loan',
                'description' => "The asset is temporarily loaned out to another department or individual but remains the organization's property."
            ],
            [
                'name' => 'In Storage',
                'description' => "The asset is stored in a warehouse, stockroom, or off-site facility and is not actively in use."
            ],
            [
                'name' => 'Transferred',
                'description' => "The asset has been transferred to another department, location, or owner but is still active and part of the organization’s records."
            ],
            [
                'name' => 'Expired',
                'description' => "The asset has passed its useful life or warranty period, though it might still be in use in some cases."
            ],
            [
                'name' => 'Under Inspection',
                'description' => "The asset is undergoing an inspection, audit, or evaluation to determine its condition or compliance."
            ]

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};


// Migration command
// php artisan migrate --path=database/migrations/2025_02_17_223732_asset_status.php