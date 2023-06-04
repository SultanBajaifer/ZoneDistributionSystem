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
        Schema::create('distriputionrecords', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('recipientID')->nullable()->index('FK_DistriputionRecords_RecipientDetailes');
            $table->dateTime('recrptionDate')->nullable();
            $table->string('state', 12)->nullable()->default('Not');
            $table->integer('recipientListID');
            $table->string('recipientName', 50);
            $table->string('distriputionPointName', 50)->nullable();
            $table->string('distriputerName', 50)->nullable();
            $table->string('listName', 50)->nullable();
            $table->string('packageName', 50)->nullable();
            $table->integer('packageID')->nullable()->index('FK_DistriputionsRecords_package1');
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distriputionrecords');
    }
};
