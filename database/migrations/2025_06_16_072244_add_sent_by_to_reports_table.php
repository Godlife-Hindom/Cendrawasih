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
    Schema::table('reports', function (Blueprint $table) {
        $table->unsignedBigInteger('sent_by')->nullable()->after('user_id');

        // Jika ingin menambahkan relasi ke tabel users
        $table->foreign('sent_by')->references('id')->on('users')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('reports', function (Blueprint $table) {
        $table->dropForeign(['sent_by']);
        $table->dropColumn('sent_by');
    });
}
};
