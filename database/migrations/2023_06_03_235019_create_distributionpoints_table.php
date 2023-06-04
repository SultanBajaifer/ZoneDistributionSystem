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
        Schema::create('distributionpoints', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 50)->nullable();
            $table->string('state', 12)->nullable()->default('Active');
            $table->string('addressDistriputions', 535)->nullable();
            $table->dateTime('creation_date')->nullable()->useCurrent();
            $table->integer('userID')->nullable()->index('FK_DistributionPoints_users');
            $table->integer('addressID')->nullable()->index('FK_DistributionPoints_Addresses');
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
        Schema::dropIfExists('distributionpoints');
    }
};
