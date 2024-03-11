<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_kritik', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Menggunakan UUID untuk primary key
            $table->string('nama');
            $table->boolean('status')->default(true); // Set default value menjadi true
            $table->uuid('user_id'); // Kolom untuk foreign key ke tabel users
            $table->timestamps();

            // Set foreign key constraint untuk user_id yang merujuk ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_kritik');
    }
};
