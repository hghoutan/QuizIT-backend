<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToQuizzesTable extends Migration
{
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
