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
        Schema::create('asset_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        DB::table('asset_types')->insert(
            [

                [
                    'name' => "Furniture",
                    'description' => "Includes desks, chairs, cabinets, shelves, and other office furnishings."
                ],

                [
                    'name' => "Office Equipment",
                    'description' => "Includes items like phones, fax machines, projectors, and other office tools used for daily operations."
                ],

                [
                    'name' => "Computers/IT Equipment",
                    'description' => "Desktops, laptops, tablets, and servers that are part of the organization's IT infrastructure."
                ],

                [
                    'name' => "Vehicles",
                    'description' => "Cars, trucks, vans, and other vehicles used for transportation, delivery, or other purposes."
                ],

                [
                    'name' => "Machinery/Production Equipment",
                    'description' => "Heavy machinery, production equipment, tools, and instruments used in manufacturing or other specialized industries."
                ],

                [
                    'name' => "Buildings/Real Estate",
                    'description' => "Includes office buildings, warehouses, industrial buildings, or any property owned by the organization."
                ],

                [
                    'name' => "Land",
                    'description' => "The land owned by the company for development, sale, or investment purposes."
                ],

                [
                    'name' => "Software",
                    'description' => "Licensed software, ERP systems, and other digital assets owned by the organization."
                ],

                [
                    'name' => "Intangible Assets",
                    'description' => "Includes patents, trademarks, copyrights, goodwill, and other non-physical assets."
                ],

                [
                    'name' => "Inventory/Stock",
                    'description' => "Raw materials, work-in-progress, and finished goods used in manufacturing or retail operations."
                ],

                [
                    'name' => "Tools & Equipment",
                    'description' => "Small tools or specialized equipment, such as hand tools, power tools, and other non-machinery devices."
                ],

                [
                    'name' => "Leasehold Improvements",
                    'description' => "Assets created through the improvement or customization of leased properties (e.g., office partitions, flooring, etc.)."
                ],

                [
                    'name' => "Fixtures",
                    'description' => "Permanent fixtures attached to the building or infrastructure, such as lights, signs, plumbing, and electrical systems."
                ],

                [
                    'name' => "Assets Under Construction",
                    'description' => "Assets that are currently being built or installed but are not yet operational (e.g., buildings or large equipment being assembled)."
                ],

                [
                    'name' => "Consumer Goods",
                    'description' => "Items that the company uses for resale or as part of its operational activities, like food products or electronics in retail businesses."
                ],

                [
                    'name' => "Supplies",
                    'description' => "Items used regularly for operational needs (e.g., office supplies, maintenance items, etc.)."
                ],

                [
                    'name' => "Security Equipment",
                    'description' => "Surveillance cameras, alarm systems, and other physical security devices."
                ],

                [
                    'name' => "Artwork/Collectibles",
                    'description' => "Includes any valuable artwork, antiques, or collectibles the company might own."
                ],

                [
                    'name' => "Leased Assets",
                    'description' => "Assets that the company leases (e.g., office equipment, vehicles, real estate), usually recorded differently than owned assets in accounting."
                ],

                [
                    'name' => "Health & Safety Equipment",
                    'description' => "Personal protective equipment (PPE), fire extinguishers, safety signs, and other safety-related assets."
                ]
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_types');
    }
};

// Migration command
// php artisan migrate --path=database/migrations/2025_02_17_231426_create_asset_types_table.php