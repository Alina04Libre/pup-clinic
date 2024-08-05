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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            // If the user is student/faculty/employee
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id') // Define the foreign key column
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->unsignedBigInteger('consent_id');
            // $table->foreign('consent_id') // Define the foreign key column
            //     ->references('id')
            //     ->on('consent_form')
            //     ->onDelete('cascade');

            $table->string('name');
            $table->string('email');
            $table->string('phone_number');

            $table->text('concern');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('unique_id')->unique();
            $table->date('new_appointment_date')->nullable();
            $table->time('new_appointment_time')->nullable();
            $table->string('status')->default('Pending');
            // $table->text('remark')->nullable();
            $table->string('reason_for_declining')->nullable();
            $table->string('reason_for_resched')->nullable();

            $table->unsignedBigInteger('nurse_id')->nullable();
            $table->foreign('nurse_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id') // Define the foreign key column
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->timestamps();
            $table->softDeletes();
            //$table->date('created_at_new')->nullable();
            //$table->date('updated_at_new')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

