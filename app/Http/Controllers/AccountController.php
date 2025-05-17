<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function accounts () {
        return view('accounts.list');
    }
    public function account_datatables () {
        $accounts = DB::select('SELECT a.account_id, c.first_name, c.last_name, b.branch_name, a.account_type, format(a.balance,2) as balance from accounts a
                                JOIN customers c ON a.customer_id = c.customer_id
                                JOIN branches b ON a.branch_id = b.branch_id ');
        return DataTables::of($accounts)->make(true);
    }

    public function update_account(Request $request) {
        $updated = DB::update(
            'UPDATE accounts SET account_type = ? WHERE account_id = ?',
            [$request->input('account_type'), $request->input('id')]
        );

        if ($updated) {
            return response()->json([
                'status' => 'success',
                'message' => 'Account updated successfully',
                'account_id' => $request->input('id')
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Account not found or no change made',
            ], 404);
        }
    }
}
