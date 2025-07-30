<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('work_place');
            $table->string('salary_range');
            $table->text('description');
            $table->date('from_date');
            $table->date('to_date');
            $table->enum('gender_preference', ['male', 'female', 'all']);
            $table->integer('education_level_id');
            $table->integer('work_experience');
            $table->integer('work_field_id');
            $table->integer('country_of_graduation_id');
            $table->integer('country_of_residence_id');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->integer('business_man_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
