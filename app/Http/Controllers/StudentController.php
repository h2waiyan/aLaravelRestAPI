<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        if ($students->count() > 0) {
            $data = [
                'status' => 'success',
                'students' => $students
            ];
        } else {
            $data = [
                'status' => 'error',
                'message' => 'No students found'
            ];
        }
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'course' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|digits:10'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $student = Student::create(
                [
                    'name' => $request['name'],
                    'course' => $request['course'],
                    'email' => $request['email'],
                    'phone' => $request['phone']
                ]
            );

            if ($student) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Student added successfully'
                ], 201);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to add student'
                ], 500);
            }
            
        }
    }

    public function show($id) 
    {
        $student = Student::find($id);
        if ($student) {
            return response()->json([
                'status' => 'success',
                'student' => $student
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found'
            ], 404);
        }
    }

    public function edit(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'course' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|digits:10'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $student = Student::find($id);
            if ($student) {
                $student->update([
                    'name' => $request['name'],
                    'course' => $request['course'],
                    'email' => $request['email'],
                    'phone' => $request['phone']
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Student updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Student not found'
                ], 404);
            }
        }
        
    }

    public function destroy(int $id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Student deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Student not found'
            ], 404);
        }
    }
}
