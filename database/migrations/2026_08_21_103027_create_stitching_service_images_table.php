<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stitching_service_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('stitching_service_id')
                ->constrained('stitching_services')
                ->cascadeOnDelete();

            $table->string('image');

            $table->boolean('is_primary')->default(false);

            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stitching_service_images');
    }
};