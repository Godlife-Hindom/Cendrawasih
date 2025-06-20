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
    Schema::table('criteria', function (Blueprint $table) {
        if (!Schema::hasColumn('criteria', 'code')) {
            $table->string('code')->after('name');
        }

        if (!Schema::hasColumn('criteria', 'type')) {
            $table->enum('type', ['benefit', 'cost'])->after('weight');
        }
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('criteria', function (Blueprint $table) {
            //
        });
    }
};
