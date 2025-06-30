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
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->text('deskripsi');
            $table->string('akreditasi');
            $table->string('link_akreditasi')->nullable();
            $table->string('subject');
            $table->string('penerbit');
            $table->string('link_penerbit')->nullable();
            $table->string('judul');
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnals');
    }
};
