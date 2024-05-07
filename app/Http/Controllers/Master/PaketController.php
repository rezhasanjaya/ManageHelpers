<?php

namespace App\Http\Controllers\Master;

use App\Models\Paket;
use App\Models\Billing;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\DataTables\PaketDataTable;
use App\Http\Controllers\Controller;

class PaketController extends Controller
{
    public function index(PaketDataTable $dataTable)
    {
        $title = 'Manage Paket';
        return $dataTable->render('master.paket.index', compact('title'));
    }

    public function create()
    {
        $title = 'Add Paket';
        $provider = Provider::get();

        return view('master.paket.create', compact('title', 'provider'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required',
            'provider' => 'required',
            'harga' => 'required',
            'kecepatan' => 'required',
        ]);
        
        $harga = filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);
        //create product
        $paket = new Paket;
        $paket->nama_paket = $request->nama_paket;
        $paket->id_provider = $request->provider;
        $paket->harga = $harga;
        $paket->kecepatan = $request->kecepatan.' Mbps';
        // dd($paket);
        $paket->save();

        return redirect()->route('paket.index')->with(['success' => 'Paket Added!']);
    }

    public function edit($id)
    {
        $title = 'Edit Paket';
        $paket = Paket::where('id', $id)->firstOrFail();
        $provider = Provider::get();
        return view('master.paket.edit', compact('title', 'provider', 'paket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_paket' => 'required',
            'provider' => 'required',
            'harga' => 'required',
            'kecepatan' => 'required',
        ]);
        
        $harga = filter_var($request->harga, FILTER_SANITIZE_NUMBER_INT);
    
        $paket = Paket::where('id', $id)->firstOrFail();
        $paket->nama_paket = $request->nama_paket;
        $paket->id_provider = $request->provider;
        $paket->harga = $harga;
        $paket->kecepatan = $request->kecepatan.' Mbps';
        // dd($paket);

        $paket->save();
        return redirect()->route('paket.index')->with('success', 'Paket Edited!');
    }

    public function destroy(Request $request)
    {
        $checkBilling = Billing::where('id_paket', $request->id)->get();
        // dd($checkBilling);
        if($checkBilling->isEmpty()) {
            $com = Paket::where('id',$request->id)->delete();
            return redirect()->route('paket.index')->with(['success' => 'Paket Deleted!']);
        } else {
            return redirect()->route('paket.index')->with(['error' => 'This Paket is still associated with Billing Data. Please delete the associated Billing Data first before deleting this Paket!']);
        }
       
    }
}
