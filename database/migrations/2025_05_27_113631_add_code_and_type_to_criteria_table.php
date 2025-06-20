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
    if (!Schema::hasColumn('criteria', 'code')) {
        Schema::table('criteria', function (Blueprint $table) {
            $table->string('code')->after('name');
        });
    }

    // Jangan tambahkan lagi kolom 'type' karena sudah ada
}



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('criteria', function (Blueprint $table) {
        if (Schema::hasColumn('criteria', 'code')) {
            $table->dropColumn('code');
        }
    });
}
};
