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
        Schema::table('distriputionrecords', function (Blueprint $table) {
            $table->foreign(['packageID'], 'FK_DistriputionsRecords_package1')->references(['id'])->on('packages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['recipientID'], 'FK_DistriputionRecords_RecipientDetailes')->references(['id'])->on('recipientdetailes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distriputionrecords', function (Blueprint $table) {
            $table->dropForeign('FK_DistriputionsRecords_package1');
            $table->dropForeign('FK_DistriputionRecords_RecipientDetailes');
        });
    }
};
