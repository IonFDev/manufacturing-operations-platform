<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organization_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('type');

            $table->text('description')->nullable();

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('country', 2)->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['organization_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};