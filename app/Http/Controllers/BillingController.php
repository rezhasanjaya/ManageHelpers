<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Paket;
use App\Models\Billing;
use App\Models\Customer;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\DataTables\BillingDataTable;
use App\Http\Requests\StoreBillingRequest;
use App\Http\Requests\UpdateBillingRequest;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BillingDataTable $dataTable)
    {
        $title = 'Manage Billing';
        return $dataTable->render('billing.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Billing';
        $cust = Customer::get();
        $paket = Paket::get();
        return view('billing.create', compact('title', 'cust', 'paket'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillingRequest $request)
    {
        //create product
        $billing = new Billing;
        $billing->id_customer = $request->customer;
        $billing->id_paket = $request->paket;
        $billing->tanggal_langganan = $request->tanggal_langganan;

        // $tanggal_jatuh_tempo = Carbon::parse($billing->tanggal_langganan)->addDays(30);
        // $billing->jatuh_tempo = $tanggal_jatuh_tempo;
        // dd($billing);
        $billing->save();

        if($request->tanggal_pembayaran !== null){
            $pembayaran = new Pembayaran;
            $pembayaran->id_billing = $billing->id;
            $pembayaran->tanggal_pembayaran = $request->tanggal_pembayaran;
            // dd($pembayaran);
            $pembayaran->save(); 

            $billing = Billing::find($billing->id);
            $tanggal_jatuh_tempo = Carbon::parse($pembayaran->tanggal_pembayaran)->addDays(30);
        
            // Menyimpan tanggal jatuh tempo ke dalam kolom jatuh_tempo pada objek Billing
            $billing->jatuh_tempo = $tanggal_jatuh_tempo;
            $billing->save();
        }

        return redirect()->route('billing.index')->with(['success' => 'Billing Added!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Billing $billing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Edit Billing';
        $bill = Billing::where('id', $id)->firstOrFail();
        $cust = Customer::get();
        $paket = Paket::get();
        return view('billing.edit', compact('title', 'cust', 'paket', 'bill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillingRequest $request, $id)
    {
        $billing = Billing::where('id', $id)->firstOrFail();
        $billing->id_customer = $request->customer;
        $billing->id_paket = $request->paket;
        $billing->tanggal_langganan = $request->tanggal_langganan;

        $billing->save();

        return redirect()->route('billing.index')->with(['success' => 'Billing Upated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $checkPayment = Pembayaran::where('id_billing', $request->id)->get();

        if($checkPayment->isEmpty()) {
            $pay = Pembayaran::where('id_billing',$request->id)->delete();
            $com = Billing::where('id',$request->id)->delete();
            return redirect()->route('billing.index')->with(['success' => 'Billing Deleted!']);
        } else {
            return redirect()->route('billing.index')->with(['error' => 'This Billing is still associated with Payment Data. Please delete the associated Payment Data first before deleting this Billing!']);
        }
       
    }

    public function payment($id){
        $title = 'Payment';
        $bill = Billing::where('id', $id)->firstOrFail();
        $cust = Customer::get();
        $paket = Paket::get();
        return view('billing.payment', compact('title', 'cust', 'paket', 'bill'));
    }
}
