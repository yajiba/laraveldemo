<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function list () {
        $customers = DB::select('SELECT * from customers');

        return response()->json([
            'status' => 'success',
            'rows' => count($customers),
            'data' => $customers
        ]);
    }
    public function get_customer_by_id($id) {
        $customer = DB::select('SELECT * from customers where id = ?', [$id]);

        if (empty($customer)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $customer[0]
        ]);
    }

    public function create_customer(Request $request) {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|numeric'
        ]);

        $customerId = DB::table('customers')->insertGetId([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'created_at' => now()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Customer created successfully',
            'customer_id' => $customerId
        ]);
    }

    public function update_customer(Request $request, $id) {
        $request->validate([
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'email' => 'email|unique:customers,email,' . $id,
            'phone' => 'string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|numeric'
        ]);

        $updated = DB::table('customers')->where('id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code

        ]);

        if ($updated) {
            return response()->json([
                'status' => 'success',
                'message' => 'Customer updated successfully'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Customer not found or no changes made'
        ], 404);
    }
}
