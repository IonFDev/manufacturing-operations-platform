<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organization_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('item_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('location_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('quantity', 15, 4)
                ->default(0);

            $table->timestamps();

            $table->unique(['item_id', 'location_id']);

            $table->index(['organization_id', 'location_id']);
            $table->index(['organization_id', 'item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};