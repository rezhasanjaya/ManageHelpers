<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Billing;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\DataTables\PembayaranDataTable;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PembayaranDataTable $dataTable)
    {
        $title = 'Payment History';
        return $dataTable->render('pembayaran.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payment = new Pembayaran;
        $payment->id_billing = $request->id_billing;
        $payment->tanggal_pembayaran = $request->tanggal_pembayaran;
        $payment->save();

        // Mengambil objek Billing yang sesuai dengan id_billing dari request
        $billing = Billing::find($request->id_billing);

        // Menambahkan 30 hari ke tanggal_pembayaran untuk mendapatkan tanggal jatuh tempo
        $tanggal_jatuh_tempo = Carbon::parse($payment->tanggal_pembayaran)->addDays(30);
        
        // Menyimpan tanggal jatuh tempo ke dalam kolom jatuh_tempo pada objek Billing
        $billing->jatuh_tempo = $tanggal_jatuh_tempo;
        $billing->save();
        
        return redirect()->route('pembayaran.index')->with(['success' => 'Payment Success!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $com = Pembayaran::where('id',$request->id)->delete();
        return redirect()->route('pembayaran.index')->with(['success' => 'Payement Canceled!']);
    }
}
