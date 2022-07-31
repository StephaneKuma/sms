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
        Schema::create('assigned_teachers', function (Blueprint $table) {
            $table->id();
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
            $table->foreignId('section_id')
                ->nullable()
                ->constrained('sections')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('course_id')
                ->nullable()
                ->constrained('courses')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('teacher_id')
                ->nullable()
                ->constrained('users')
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
        Schema::table('assigned_teachers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('session_id');
            $table->dropConstrainedForeignId('semester_id');
            $table->dropConstrainedForeignId('class_id');
            $table->dropConstrainedForeignId('section_id');
            $table->dropConstrainedForeignId('course_id');
            $table->dropConstrainedForeignId('teacher_id');
        });
        Schema::dropIfExists('assigned_teachers');
    }
};
