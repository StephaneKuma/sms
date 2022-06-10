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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->foreignId('session_id')
                ->nullable()
                ->constrained('school_sessions')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('semester_id')
                ->nullable()
                ->constrained('semesters')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('class_id')
                ->nullable()
                ->constrained('school_classes')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('course_id')
                ->nullable()
                ->constrained('courses')
                ->cascadeOnUpdate()
                ->nullOnDelete();
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
        Schema::table('exams', function (Blueprint $table) {
            $table->dropConstrainedForeignId('session_id');
            $table->dropConstrainedForeignId('semester_id');
            $table->dropConstrainedForeignId('class_id');
            $table->dropConstrainedForeignId('course_id');
        });
        Schema::dropIfExists('exams');
    }
};
