<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kritik_saran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable(); // Karena bisa dari guest user
            $table->text('isi');
            $table->string('gambar')->nullable(); // Kolom ini nullable jika tidak ada gambar yang diupload
            $table->uuid('kategori_id');
            $table->boolean('status')->default(false);
            $table->timestamps();

            // Membuat foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // Jika user dihapus, set user_id menjadi null
            $table->foreign('kategori_id')->references('id')->on('kategori_kritik')->onDelete('cascade'); // Jika kategori dihapus, hapus juga kritik dan saran
        });
    }

    public function down()
    {
        Schema::dropIfExists('kritik_saran');
    }
};
