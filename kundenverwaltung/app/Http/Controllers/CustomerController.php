<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companies;
use App\Models\Customers;

class CustomerController extends Controller {
    
    public function index() {
        return view('customer.index')->with([
            'companies' => Companies::get()
        ]);
    }

}
