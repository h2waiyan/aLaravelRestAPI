<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientsController extends Controller
{
    public function index()
    {
        $patients = Patient::where('is_vot_patient', 0)->get();
        if ($patients->count() > 0) {
            $data = [
                'status' => 'success',
                'patients' => $patients
            ];
        } else {
            $data = [
                'status' => 'error',
                'message' => 'No patients found.',
                'patients' => []
            ];
        }
        return response()->json($data, 200);
    }

    public function vot_index() 
    {
        // filter patients with is_vot_patient = true
        $patients = Patient::where('is_vot_patient', 1)->get();
        if ($patients->count() > 0) {
            $data = [
                'status' => 'success',
                'patients' => $patients
            ];
        } else {
            $data = [
                'status' => 'error',
                'message' => 'No VOT patients found.',
                'patients' => []
            ];
        }
        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string',
        //     'reg_year' => 'required|digits',
        //     'dob' => 'required|date',
        //     'age' => 'required|digits',
        //     'drtb_code' => 'required|digits',
        //     'password' => 'required|string',
        //     'township' => 'required|string',
        //     'referred_by_volunteer' => 'required|digits',
        //     'patient_code' => 'required|string',
        //     'address' => 'required|string',
        //     'treatment_start_date' => 'required|date',
        //     'treatment_regimen' => 'required|string',
        //     'is_vot_patient' => 'required|boolean',
        //     'volunteer_id'=> 'string',
        //     'vot_start_date' => 'string',
        // ]);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Validation error',
        //         'errors' => $validator->errors()
        //     ], 422);
        // } else {
            $patient = Patient::create(
                [
                    'name' => $request['name'],
                    'reg_year' => $request['reg_year'],
                    'dob' => $request['dob'],
                    'age' => $request['age'],
                    'drtb_code' => $request['drtb_code'],
                    'password' => $request['password'],
                    'township' => $request['township'],
                    'referred_by_volunteer' => $request['referred_by_volunteer'],
                    'patient_code' => $request['patient_code'],
                    'address' => $request['address'],
                    'treatment_start_date' => $request['treatment_start_date'],
                    'treatment_regimen' => $request['treatment_regimen'],
                    'is_vot_patient' => $request['is_vot_patient'],
                    'vot_start_date' => $request['vot_start_date'],
                    'volunteer_id' => $request['volunteer_id'],
                    "vot_type" => $request['vot_type']
                ]
            );

            if ($patient) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Patient added successfully.'
                ], 201);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to add patient.'
                ], 500);
            }
        // }
    }

    public function show($id) 
    {
        $patient = Patient::find($id);
        if ($patient) {
            $data = [
                'status' => 'success',
                'patient' => $patient
            ];
        } else {
            $data = [
                'status' => 'error',
                'message' => 'Patient not found.',
                'patient' => []
            ];
        }
        return response()->json($data, 200);
    }

    public function edit(Request $request, int $id)
    {
        $patient = Patient::find($id);
        if ($patient) {
            $patient->name = $request['name'];
            $patient->reg_year = $request['reg_year'];
            $patient->dob = $request['dob'];
            $patient->age = $request['age'];
            $patient->drtb_code = $request['drtb_code'];
            $patient->password = $request['password'];
            $patient->township = $request['township'];
            $patient->referred_by_volunteer = $request['referred_by_volunteer'];
            $patient->patient_code = $request['patient_code'];
            $patient->address = $request['address'];
            $patient->treatment_start_date = $request['treatment_start_date'];
            $patient->treatment_regimen = $request['treatment_regimen'];
            $patient->is_vot_patient = $request['is_vot_patient'];
            $patient->volunteer_id = $request['volunteer_id'];
            $patient->vot_start_date = $request['vot_start_date'];
            $patient->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Patient updated successfully.'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient not found.'
            ], 404);
        }
    }

    public function destroy(int $id)
    {
        $patient = Patient::find($id);
        if ($patient) {
            $patient->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Patient deleted successfully.'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient not found.'
            ], 404);
        }
    
    }
}

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