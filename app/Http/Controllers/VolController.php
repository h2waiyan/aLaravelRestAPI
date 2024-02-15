<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Validator;
class VolController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::all();
        if ($volunteers->count() > 0) {
            $data = [
                'status' => 'success',
                'volunteers' => $volunteers
            ];
        } else {
            $data = [
                'status' => 'error',
                'message' => 'No volunteers found.',
                'volunteers' => []
            ];
        }
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'township' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $volunteer = Volunteer::create(
                [
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => $request['password'],
                    'township' => $request['township']
                ]
            );

            if ($volunteer) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Volunteer added successfully.'
                ], 201);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to add volunteer.'
                ], 500);
            }
        }
    }

    public function show($id) 
    {
        $volunteer = Volunteer::find($id);
        if ($volunteer) {
            $data = [
                'status' => 'success',
                'volunteer' => $volunteer
            ];
        } else {
            $data = [
                'status' => 'error',
                'message' => 'Volunteer not found.'
            ];
        }
        return response()->json($data, 200);
    }

    public function edit(Request $request, int $id)
    {
        $volunteer = Volunteer::find($id);
        if ($volunteer) {
            $volunteer->name = $request['name'];
            $volunteer->email = $request['email'];
            $volunteer->password = $request['password'];
            $volunteer->township = $request['township'];
            $volunteer->save();
            $data = [
                'status' => 'success',
                'message' => 'Volunteer updated successfully.'
            ];
        } else {
            $data = [
                'status' => 'error',
                'message' => 'Volunteer not found.'
            ];
        }
        return response()->json($data, 200);
    }

    public function destroy(int $id)
    {
        $volunteer = Volunteer::find($id);
        if ($volunteer) {
            $volunteer->delete();
            $data = [
                'status' => 'success',
                'message' => 'Volunteer deleted successfully.'
            ];
        } else {
            $data = [
                'status' => 'error',
                'message' => 'Volunteer not found.'
            ];
        }
        return response()->json($data, 200);
    }
}
