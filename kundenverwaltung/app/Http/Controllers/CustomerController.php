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

    public function addCompany(Request $request) {
        $request->validate([
            'inputCompanyname' => 'required|string|max:150',
            'inputAddress' => 'sometimes|nullable|string|max:255',
            'inputNote' => 'sometimes|nullable|string'
        ]);

        $newCompany = new Companies();
        $newCompany->companyname = $request->inputCompanyname;
        $newCompany->address = $request->inputAddress;
        $newCompany->note = $request->inputNote;
        $newCompany->save();
        return back()->with('success', 'Abgespeichert');
    }

    public function addCustomer(Request $request) {
        $request->validate([
            'inputForename' => 'required|string|max:150',
            'inputLastname' => 'required|string|max:150',
            'inputEmail' => 'required|string|max:150',
            'inputFunction' => 'sometimes|nullable|string|max:150',
            'inputCustomerNote' => 'sometimes|nullable|string',
            'inputCompany' => 'required'
        ]);

        $company = Companies::findOrFail($request->inputCompany);

        $newCustomer = new Customers();
        $newCustomer->forename = $request->inputForename;
        $newCustomer->lastname = $request->inputLastname;
        $newCustomer->email = $request->inputEmail;
        $newCustomer->function = $request->inputFunction;
        $newCustomer->note = $request->inputCustomerNote;
        $newCustomer->company_id = $company->id;
        $newCustomer->save();
        
        return back()->with('success', 'Abgespeichert');
    }

}
