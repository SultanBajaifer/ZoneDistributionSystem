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
        Schema::create('recipientslist', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('name', 50)->nullable()->unique('name');
            $table->string('state', 50)->default('0');
            $table->string('note', 353)->nullable();
            $table->tinyInteger('is_send')->nullable()->default(0);
            $table->integer('distriputionPointID')->nullable()->index('distriputionPointID');
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