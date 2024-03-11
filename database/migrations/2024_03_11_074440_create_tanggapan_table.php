<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('kritik_id');
            $table->uuid('user_id');
            $table->text('isi_tanggapan');
            $table->tinyInteger('level_prioritas');
            $table->boolean('status')->default(true);
            $table->timestamps();

            // Membuat foreign key constraints
            $table->foreign('kritik_id')->references('id')->on('kritik_saran')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tanggapan');
    }
};
