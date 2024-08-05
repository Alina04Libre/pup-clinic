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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id') // Define the foreign key column
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->string('name');
            $table->string('course')->nullable();
            $table->string('strand')->nullable();
            $table->string('year_level')->nullable();
            $table->string('department')->nullable();
            $table->string('address');
            $table->string('contact_number');
            $table->string('age');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('contact_person');
            $table->string('contactPerson_number');
            $table->string('blood_type')->nullable();
            $table->boolean('is_pwd')->nullable();
            $table->string('patient_photo', 2048)->nullable();
            
            $table->json('childhood_illness')->nullable();
            $table->string('childhood_illness_specify')->nullable();
            $table->string('previous_hospitalization')->nullable();
            $table->string('operation_surgery')->nullable();
            $table->string('current_medications')->nullable();
            $table->string('allergies')->nullable();
            $table->json('family_history')->nullable();
            $table->string('family_history_specify')->nullable();
            $table->string('history_cigarette')->nullable();
            $table->string('history_alcohol')->nullable();
            $table->string('history_travel')->nullable();
            $table->string('vital_signs')->nullable();
            $table->string('height')->nullable();
            $table->string('hr')->nullable();
            $table->string('weight')->nullable();
            $table->string('rr')->nullable();
            $table->string('temp')->nullable();
            $table->string('bmi')->nullable();
            $table->string('bp')->nullable();
            $table->json('head')->nullable();
            $table->json('ears')->nullable();
            $table->json('eyes')->nullable();
            $table->json('throat')->nullable();
            $table->json('chest')->nullable();
            $table->string('x_ray')->nullable();
            $table->string('breast')->nullable();
            $table->string('murmur')->nullable();
            $table->string('rhythm')->nullable();
            $table->string('abdomen')->nullable();
            $table->string('geneto_urinary')->nullable();
            $table->string('extremities')->nullable();
            $table->json('vertebral_column')->nullable();
            $table->json('skin')->nullable();
            $table->string('scars')->nullable();
            $table->string('working_impression')->nullable();
            $table->string('fit')->nullable();
            $table->string('work_up')->nullable();
            $table->json('referred_to')->nullable();
            $table->string('referred_to_others')->nullable();
            $table->string('physician_name')->nullable();
            $table->string('nurse_name')->nullable();
            $table->string('remarks')->nullable();
            $table->string('signature_photo_path', 2048)->nullable();
            // $table->string('nurse_signature_photo_path', 2048)->nullable();
            $table->date('followUp')->nullable();
            $table->boolean('is_medical_record_complete')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
