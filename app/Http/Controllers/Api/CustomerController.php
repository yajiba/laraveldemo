<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends BaseController
{
    public function customers() {
        $customers = DB::select('SELECT * from customers');
        if($customers) {
             return $this->sendResponse($customers, 'All user displayed');
        }

    }
}
