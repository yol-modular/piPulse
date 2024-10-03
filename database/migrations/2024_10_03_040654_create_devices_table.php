<?php

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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('status');
            $table->timestamp('last_downtime')->nullable();
            $table->string('ip_address')->nullable();
            $table->float('cpu_usage')->nullable();
            $table->float('memory_usage')->nullable();
            $table->float('disk_space')->nullable();
            $table->float('temperature')->nullable();
            $table->json('running_processes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
