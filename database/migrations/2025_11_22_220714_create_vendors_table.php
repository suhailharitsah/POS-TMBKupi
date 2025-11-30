<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();

            // Info dasar vendor
            $table->string('nama');
            $table->string('kontak')->nullable();
            $table->string('alamat')->nullable();

            // Jenis vendor (supplier biasa / konsinyasi)
            $table->enum('tipe', ['Supplier', 'Konsinyasi'])->default('Supplier');

            // Vendor aktif / nonaktif
            $table->boolean('status')->default(true);

            // Catatan tambahan
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
