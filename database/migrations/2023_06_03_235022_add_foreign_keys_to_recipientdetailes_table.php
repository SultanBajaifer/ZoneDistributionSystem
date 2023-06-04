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
        Schema::table('recipientdetailes', function (Blueprint $table) {
            $table->foreign(['distriputionPointID'], 'FK_RecipientDetailes_DistributionPoints')->references(['id'])->on('distributionpoints')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['addressID'], 'FK_RecipientDetailes_Addresses')->references(['id'])->on('addresses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipientdetailes', function (Blueprint $table) {
            $table->dropForeign('FK_RecipientDetailes_DistributionPoints');
            $table->dropForeign('FK_RecipientDetailes_Addresses');
        });
    }
};
