<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('walk_in_checkups', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('nurse_id')->nullable();
            $table->foreign('nurse_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('prescription');
            $table->string('complaint');
            $table->string('diagnosis');
            $table->date('date');
            $table->time('time');
            $table->string('documents', 2048)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walk_in_checkups');
    }
};
