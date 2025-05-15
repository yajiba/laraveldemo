<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{

    public function list () {
        $customers = DB::select('SELECT * from customers');

        return view('customers.list',[
            'customers' => $customers
        ]);
    }

    public function customer_datatables () {
        $customers = DB::select('SELECT * from customers');
        return DataTables::of($customers)->make(true);
    }

    public function update_customer(Request $request) {
        $customerId = $request->input('id');
        $firstName = $request->input('fname');
        $lastName = $request->input('lname');

        $updated = DB::update(
            'UPDATE customers SET first_name = ?, last_name = ? WHERE customer_id = ?',
            [$firstName, $lastName, $customerId]
        );

        if ($updated) {
            return response()->json([
                'status' => 'success',
                'message' => 'Customer updated successfully',
                'customer_id' => $customerId
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer not found or no change made',
            ], 404);
        }
    }
}
