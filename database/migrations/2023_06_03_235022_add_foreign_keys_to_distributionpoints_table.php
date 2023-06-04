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
        Schema::table('distributionpoints', function (Blueprint $table) {
            $table->foreign(['userID'], 'FK_DistributionPoints_users')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['addressID'], 'FK_DistributionPoints_Addresses')->references(['id'])->on('addresses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['id'], 'distributionpoints_ibfk_1')->references(['distriputionPointID'])->on('recipientslist')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distributionpoints', function (Blueprint $table) {
            $table->dropForeign('FK_DistributionPoints_users');
            $table->dropForeign('FK_DistributionPoints_Addresses');
            $table->dropForeign('distributionpoints_ibfk_1');
        });
    }
};