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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->integer('reg_year');
            $table->date('dob');
            $table->integer('age');
            $table->integer('drtb_code');
            $table->string('password');
            $table->string('township');
            $table->integer('referred_by_volunteer');
            $table->integer('patient_code');
            $table->string('address');
            $table->date('treatment_start_date');
            $table->string('treatment_regimen');
            $table->boolean('is_vot_patient');
            $table->integer('volunteer_id');
            $table->date('vot_start_date');
            $table->integer('vot_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};

//'name',
//'reg_year',
//'dob',
//'age',
//'drtb_code',
//'password',
//'township',
//'referred_by_volunteer',
//'patient_code',
//'address',
//'treatment_start_date',
//'treatment_regimen'
// 'is_vot_patient',
// 'volunteer_id',
// 'vot_start_date',