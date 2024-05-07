<?php

namespace App\Http\Controllers\Master;

use App\Models\Billing;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CustomersDataTable;

class CustomersController extends Controller
{
    public function index(CustomersDataTable $dataTable)
    {
        $title = 'Manage Customers';
        return $dataTable->render('master.customers.index', compact('title'));
    }

    public function create()
    {
        $title = 'Add Customer';

        return view('master.customers.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required|numeric',            
            'alamat' => 'required',
        ]);
        
        //create product
        $cust = new Customer;
        $cust->nama = $request->nama;
        $cust->email = $request->email;
        $cust->telp = $request->no_telp;
        $cust->alamat = $request->alamat;
        // dd($cust);
        $cust->save();

        return redirect()->route('customers.index')->with(['success' => 'Customer Added!']);
    }

    public function edit($id)
    {
        $title = 'Edit Customer';
        $cust = Customer::where('id', $id)->firstOrFail();
        return view('master.customers.edit', compact('title', 'cust'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required|numeric',            
            'alamat' => 'required',
        ]);
        
    
        $cust = Customer::where('id', $id)->firstOrFail();
        $cust->nama = $request->nama;
        $cust->email = $request->email;
        $cust->telp = $request->no_telp;
        $cust->alamat = $request->alamat;
        // dd($cust);

        $cust->save();
        return redirect()->route('customers.index')->with('success', 'Customer Edited!');
    }

    public function destroy(Request $request)
    {
        $checkBilling = Billing::where('id_customer', $request->id)->get();

        if($checkBilling->isEmpty()) {
            $com = Customer::where('id',$request->id)->delete();
            return redirect()->route('customers.index')->with(['success' => 'Customer Deleted!']);
        } else {
            return redirect()->route('customers.index')->with(['error' => 'This Customer is still associated with Billing Data. Please delete the associated Billing Data first before deleting this Customer Data!']);
        }
        
    }
}
