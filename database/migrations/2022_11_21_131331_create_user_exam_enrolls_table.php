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
        Schema::create('user_exam_enrolls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quest_id')->unsigned()->index();
            $table->foreign('quest_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('exam_id')->unsigned()->index();
            $table->foreign('exam_id')->references('id')->on('online_exams')->onDelete('cascade');
            $table->boolean('status')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_exam_enrolls');
    }
};
