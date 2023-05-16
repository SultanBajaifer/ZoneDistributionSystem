<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('Addresses')) {

            Schema::table('Addresses', function (Blueprint $table) {
                if (Schema::hasColumns('Addresses', ['created_at', 'updated_at'])) {
                    $table->dropColumn('created_at');
                    $table->dropColumn('updated_at');
                }
                $table->timestamps();
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
        Schema::table('Addresses', function (Blueprint $table) {

        });
    }
};
