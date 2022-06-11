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
        Schema::create('exam_rules', function (Blueprint $table) {
            $table->id();
            $table->float('total_mark');
            $table->float('pass_mark');
            $table->text('note')->nullable();
            $table->foreignId('session_id')
                ->nullable()
                ->constrained('school_sessions')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('exam_id')
                ->nullable()
                ->constrained('exams')
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
        Schema::table('exam_rules', function (Blueprint $table) {
            $table->dropConstrainedForeignId('session_id');
            $table->dropConstrainedForeignId('exam_id');
        });
        Schema::dropIfExists('exam_rules');
    }
};
