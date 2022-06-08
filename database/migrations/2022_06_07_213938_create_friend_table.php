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
        Schema::create('friend', function (Blueprint $table) {
            $table->mediumIncrements('id');

            $table->unsignedSmallInteger('profile_id')->nullable(false);
            $table->unsignedSmallInteger('friend_id')->nullable(false);
        });

        Schema::table('friend', function (Blueprint $table) {
            $table->foreign('profile_id')
                ->references('id')
                ->on('profile')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('friend_id')
                ->references('id')
                ->on('profile')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['profile_id', 'friend_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friend');
    }
};
