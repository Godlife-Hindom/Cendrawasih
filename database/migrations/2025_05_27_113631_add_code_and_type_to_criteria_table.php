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
        // Tambahkan kolom 'code' jika belum ada
        if (!Schema::hasColumn('criteria', 'code')) {
            Schema::table('criteria', function (Blueprint $table) {
                $table->string('code')->after('name');
            });
        }

        // Tambahkan kolom 'type' jika belum ada
        if (!Schema::hasColumn('criteria', 'type')) {
            Schema::table('criteria', function (Blueprint $table) {
                $table->enum('type', ['benefit', 'cost'])->after('weight');
            });
        }
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

            if (Schema::hasColumn('criteria', 'type')) {
                $table->dropColumn('type');
            }
        });
    }
};
