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
        Schema::create('consent_form', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->foreign('appointment_id') // Define the foreign key column
                ->references('id')
                ->on('appointments')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('gender');
            $table->string('user_type');
            $table->integer('age');
            $table->string('guardian');
            $table->string('guardian_relation');
            $table->string('phone');
            $table->text('consent_agreement');
            $table->date('appointment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consent_form');
    }
};
