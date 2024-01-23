<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('description')->nullable();
            $table->json('answers');
            $table->string('correct_answer');
            $table->text('explanation')->nullable();
            $table->text('tip')->nullable();
            $table->json('tags');
            $table->enum('category', ['PHP', 'Code', 'Linux', 'CMS', 'Docker', 'HTML', 'SQL', 'WordPress', 'BASH', 'DevOps', 'Kubernetes']);
            $table->enum('difficulty', ['Easy', 'Medium', 'Hard']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}