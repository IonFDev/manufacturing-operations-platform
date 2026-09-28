<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organization_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('sku');
            $table->string('name');

            $table->text('description')->nullable();

            $table->string('type');

            $table->string('unit', 20)
                ->default('unit');

            $table->decimal('minimum_stock', 15, 4)
                ->default(0);

            $table->string('image')->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->unique(['organization_id', 'sku']);
            $table->index(['organization_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};