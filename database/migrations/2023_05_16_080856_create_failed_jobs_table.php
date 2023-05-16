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
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('uuid')->nullable();
            $table->string('connection', 535)->nullable();
            $table->string('queue', 535)->nullable();
            $table->string('payload', 535)->nullable();
            $table->string('exception', 535)->nullable();
            $table->dateTime('failed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_jobs');
    }
};
