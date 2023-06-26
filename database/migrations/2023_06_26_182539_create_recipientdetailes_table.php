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
        Schema::create('recipientdetailes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 50)->nullable();
            $table->bigInteger('phoneNum')->nullable();
            $table->string('barcode', 535)->nullable()->unique('barcode');
            $table->integer('familyCount')->nullable();
            $table->integer('addressID')->nullable();
            $table->date('birthday')->nullable();
            $table->float('averageSalary', 10, 0)->nullable();
            $table->string('workFor', 20)->nullable();
            $table->bigInteger('passportNum')->nullable();
            $table->string('socialState', 20)->nullable();
            $table->string('residentType', 20)->nullable();
            $table->string('image', 353)->nullable();
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
        Schema::dropIfExists('recipientdetailes');
    }
};
