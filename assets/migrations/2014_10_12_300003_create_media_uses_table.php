<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_uses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->relation('media_id', 'media');
            $table->string('entity')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable()->index();

            $table->userTimeStamp();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_uses');
    }
}