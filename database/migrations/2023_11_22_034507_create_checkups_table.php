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
        Schema::create('checkups', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->foreign('appointment_id')
                ->references('id')
                ->on('appointments')
                ->onDelete('cascade');
            $table->string('name');
            // $table->unsignedBigInteger('doctor_id')->nullable();
            // $table->foreign('doctor_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('cascade');

            // $table->unsignedBigInteger('nurse_id')->nullable();
            // $table->foreign('nurse_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('cascade');
            
            $table->string('prescription');
            $table->string('disposition');
            $table->string('diagnosis');
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
        Schema::dropIfExists('checkups');
    }
};
