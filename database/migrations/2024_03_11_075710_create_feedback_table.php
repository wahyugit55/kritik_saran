<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('tanggapan_id');
            $table->uuid('user_id')->nullable(); // Karena bisa dari guest user
            $table->text('isi_feedback');
            $table->integer('rating')->default(1); // Asumsi rating berkisar 1-5
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('tanggapan_id')->references('id')->on('tanggapan')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // Set user_id menjadi null jika user dihapus
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback');
    }
};
