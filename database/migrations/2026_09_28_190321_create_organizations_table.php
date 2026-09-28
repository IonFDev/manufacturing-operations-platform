<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('logo')->nullable();

            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('country', 2)->default('ES');

            $table->string('timezone')->default('Europe/Madrid');
            $table->string('currency', 3)->default('EUR');

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};