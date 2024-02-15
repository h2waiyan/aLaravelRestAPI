<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'name',
        'reg_year',
        'dob',
        'age',
        'drtb_code',
        'password',
        'township',
        'referred_by_volunteer',
        'patient_code',
        'address',
        'treatment_start_date',
        'treatment_regimen',
        'is_vot_patient',
        'volunteer_id',
        'vot_start_date',
    ];
}


// ○ Name (up to text 16 Characters)
// ○ Registration Year (Drop Down list ➔ (2023,2024,2025,2026)
// ○ DOB (Date Field)
// ○ Age (auto generate with DOB)
// ○ DRTB Code (Unique Key integer )
// ○ Password (autogenerate with 6 digit integer)

// ○ Township (Drop Down List ➔(CAT,CMT,PTG,PGT,AMT,MHA,AMP))
// ○ Referred by Volunteer (Drop Down (relationship with volunteer table for
// related township)
// ○ Patient code (auto generate with DRTB Code/Township /Registration
// Year/) eg. 134/CAT/2024
// ○ Address (text field 30 characters)
// ○ Treatment StartDate (Date Field)
// ○ Treatment Regimen (Drop Down List