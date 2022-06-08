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
        Schema::create('profile', function (Blueprint $table) {
            $table->smallIncrements('id');

            $table->string('first_name', 32)->nullable(false);
            $table->string('last_name', 32)->nullable(false);
            $table->string('phone', 16)->nullable(false);
            $table->string('address', 64)->nullable(false);
            $table->string('zip_code', 16)->nullable(false);
            $table->boolean('is_available')->nullable(false)->default(true);
            $table->text('img')->nullable(false);

            $table->unsignedSmallInteger('city_id')->nullable(false);
        });

        Schema::table('profile', function (Blueprint $table) {
            $table->foreign('city_id')
                ->references('id')
                ->on('city')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['first_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
};
