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

    public function modalEditCustomer(Request $request) {
        $customer = Customers::findOrFail($request->customer_id);
        return view('customer.modal.editCustomer')->with([
            'customer' => $customer,
            'companies' => Companies::get()
        ]);
    }

    public function editCustomer(Request $request) {
        $request->validate([
            'editForename' => 'required|string|max:150',
            'editLastname' => 'required|string|max:150',
            'editEmail' => 'required|string|max:150',
            'editFunction' => 'sometimes|nullable|string|max:150',
            'editCustomerNote' => 'sometimes|nullable|string',
            'editCompany' => 'required'
        ]);

        $company = Companies::findOrFail($request->editCompany);

        $customer = Customers::findOrFail($request->customer_id);
        $customer->forename = $request->editForename;
        $customer->lastname = $request->editLastname;
        $customer->email = $request->editEmail;
        $customer->function = $request->editFunction;
        $customer->note = $request->editCustomerNote;
        $customer->company_id = $company->id;
        $customer->save();
        return back()->with('success', 'Geändert');
    }

    public function modalEditCompany(Request $request) {
        $company = Companies::findOrFail($request->company_id);
        return view('customer.modal.editCompany')->with([
            'company' => $company
        ]);
    }

    public function editCompany(Request $request) {
        $request->validate([
            'inputCompanyname' => 'required|string|max:150',
            'inputAddress' => 'sometimes|nullable|string',
            'inputNote' => 'sometimes|nullable|string',
        ]);
        $company = Companies::findOrFail($request->companyID);
        $company->companyname = $request->inputCompanyname;
        $company->address = $request->inputAddress;
        $company->note = $request->inputNote;
        $company->save();
        return back()->with('success', 'update');
    }

    public function modalDeleteCustomer(Request $request) {
        $customer = Customers::findOrFail($request->customer_id);
        return view('customer.modal.deleteCustomer')->with([
            'customer' => $customer
        ]);
    }

    public function deleteCustomer(Request $request) {
        $customer = Customers::findOrFail($request->customer_id);
        $customer->delete();
        return back()->with('success', 'delete');
    }

    public function modalDeleteCompany(Request $request) {
        $company = Companies::findOrFail($request->company_id);
        return view('customer.modal.deleteCompany')->with([
            'company' => $company
        ]);
    }

    public function deleteCompany(Request $request) {
        $company = Companies::findOrFail($request->company_id);
        $company->delete();
        return back()->with('success', 'delete');
    }
}
