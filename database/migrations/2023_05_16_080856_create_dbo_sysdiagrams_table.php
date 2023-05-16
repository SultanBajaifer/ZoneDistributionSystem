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
        Schema::create('sysdiagrams', function (Blueprint $table) {
            $table->string('name', 9)->nullable();
            $table->tinyInteger('principal_id')->nullable();
            $table->smallInteger('diagram_id')->nullable();
            $table->tinyInteger('version')->nullable();
            $table->mediumText('definition')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dbo.sysdiagrams');
    }
};