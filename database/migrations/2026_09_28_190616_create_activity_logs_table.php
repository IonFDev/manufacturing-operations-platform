<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organization_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('action');

            $table->string('entity_type')
                ->nullable();

            $table->unsignedBigInteger('entity_id')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->json('metadata')
                ->nullable();

            $table->timestamps();

            $table->index([
                'organization_id',
                'entity_type',
                'entity_id'
            ]);

            $table->index([
                'organization_id',
                'created_at'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};