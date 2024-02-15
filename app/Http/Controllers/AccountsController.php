<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountsController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        if ($accounts->count() > 0) {
            $data = [
                'status' => 'success',
                'accounts' => $accounts
            ];
        } else {
            $data = [
                'status' => 'error',
                'message' => 'No accounts found.'
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
            'role' => 'required|digits:1'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $account = Account::create(
                [
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => $request['password'],
                    'role' => $request['role']
                ]
            );

            if ($account) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Account added successfully.'
                ], 201);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to add account.'
                ], 500);
            }
            
        }
    }

    public function show($id) 
    {
        $account = Account::find($id);
        if ($account) {
            return response()->json([
                'status' => 'success',
                'account' => $account
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Account not found.'
            ], 404);
        }
    }

    public function edit(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'role' => 'required|digits:1'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $account = Account::find($id);
            if ($account) {
                $account->update([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => $request['password'],
                    'role' => $request['role']
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Account updated successfully.'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Account not found.'
                ], 404);
            }
        }
        
    }

    public function destroy(int $id)
    {
        $account = Account::find($id);
        if ($account) {
            $account->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Account deleted successfully.'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Account not found.'
            ], 404);
        }
    }
}
