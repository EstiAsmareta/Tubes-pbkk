<?php

use App\Models\Neverland;
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
        Schema::create('wahanas', function (Blueprint $table) {
            $table->char('id', 6)->primary();
            $table->string('nama');
            $table->string('gambar');
            $table->string('deskripsi');
            $table->date('tgl_dibuka');
            $table->integer('luas_area');
            $table->enum('kategori', ['keluarga', 'dewasa', 'alam', 'anak_anak']);
            $table->foreignIdFor(Neverland::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wahanas');
    }
};
