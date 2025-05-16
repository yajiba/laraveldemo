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
}
