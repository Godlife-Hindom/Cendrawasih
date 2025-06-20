<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // user yang mengirim laporan (admin)
            $table->text('title'); // misalnya "Laporan Hasil Evaluasi Lokasi"
            $table->longText('content'); // bisa berisi JSON atau HTML hasil perhitungan
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('evaluation')->nullable(); // evaluasi dari pimpinan
            $table->timestamps();

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
        Schema::dropIfExists('reports');
    }
};
