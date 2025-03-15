<?php

use App\Models\Inventory;
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
        Schema::create('collectible_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedDecimal('price', 8 ,2);
            $table->string('latitude');
            $table->string('longitude');
            $table->foreignIdFor(Inventory::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collectible_items');
    }
};
