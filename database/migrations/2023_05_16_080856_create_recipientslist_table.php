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
        Schema::create('recipientslist', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 50)->nullable();
            $table->dateTime('creationDate')->nullable();
            $table->string('state', 50)->nullable();
            $table->string('note', 353)->nullable();
            $table->integer('distributionPointID');
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
        Schema::dropIfExists('recipientslist');
    }
};
