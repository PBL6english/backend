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
        Schema::table('user_exam_question_answers', function (Blueprint $table) {
            $table->bigInteger('enroll_id')->unsigned()->index();
            $table->foreign('enroll_id')->references('id')->on('user_exam_enrolls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_exam_question_answers', function (Blueprint $table) {
            $table->dropColumn('enroll_id');
        });
    }
};
