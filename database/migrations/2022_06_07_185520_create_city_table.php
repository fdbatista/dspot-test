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
        Schema::create('city', function (Blueprint $table) {
            $table->smallIncrements('id');

            $table->string('title', 32)->nullable(false)->unique();
            $table->unsignedSmallInteger('state_id')->nullable(false);
        });

        Schema::table('city', function (Blueprint $table) {
            $table->foreign('state_id')
                ->references('id')
                ->on('state')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city');
    }
};
