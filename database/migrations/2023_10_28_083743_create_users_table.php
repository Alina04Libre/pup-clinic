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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('extension')->nullable();
            $table->string('student_id')->unique()->nullable();

            $table->unsignedBigInteger('user_category_id');
            $table->foreign('user_category_id') // Define the foreign key column
                ->references('id')
                ->on('user_category')
                ->onDelete('restrict');

            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id') // Define the foreign key column
                ->references('id')
                ->on('department')
                ->onDelete('restrict');

            $table->unsignedSmallInteger('age');
            $table->unsignedTinyInteger('birth_month');
            $table->unsignedTinyInteger('birth_day');
            $table->unsignedSmallInteger('birth_year');

            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id') // Define the foreign key column
                ->references('id')
                ->on('course')
                ->onDelete('restrict');

            $table->unsignedBigInteger('strand_id')->nullable();
            $table->foreign('strand_id') // Define the foreign key column
                ->references('id')
                ->on('strand')
                ->onDelete('restrict');

            $table->unsignedBigInteger('year_level')->nullable();
            $table->foreign('year_level') // Define the foreign key column
                ->references('id')
                ->on('year_level')
                ->onDelete('restrict');

            $table->string('sex');
            $table->string('civil_tatus');
            $table->string('email');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_person');
            $table->string('contact_person_number');

            $table->boolean('is_medical_record_complete')->default(false);
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
