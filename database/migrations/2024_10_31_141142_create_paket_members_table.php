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
        Schema::create('paket_members', function (Blueprint $table) {
            $table->id();
            $table->enum('durasi', ['1-bulan', '6-bulan','12-bulan']);
            $table->decimal('harga',total:10,places:2);
            $table->enum('status', ['tersedia', 'tidak_tersedia'])->default('tersedia');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_members');
    }
};
