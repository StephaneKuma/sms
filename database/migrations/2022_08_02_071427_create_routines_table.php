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
        Schema::create('routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')
                ->nullable()
                ->constrained('school_sessions')
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
            $table->unsignedInteger('weekday');
            $table->string('start_at');
            $table->string('end_at');
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
        Schema::table('routines', function (Blueprint $table) {
            $table->dropConstrainedForeignId('session_id');
            $table->dropConstrainedForeignId('class_id');
            $table->dropConstrainedForeignId('section_id');
            $table->dropConstrainedForeignId('course_id');
        });
        Schema::dropIfExists('routines');
    }
};
