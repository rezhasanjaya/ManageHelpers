<?php

namespace App\Http\Controllers\Master;

use App\Models\Paket;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ProviderDataTable;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProviderDataTable $dataTable)
    {
        $title = 'Manage Provider';
        return $dataTable->render('master.provider.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Provider';
        return view('master.provider.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_provider' => 'required',
        ]);

        //create product
        $provider = new Provider;
        $provider->nama_provider = $request->nama_provider;
        // dd($provider);
        $provider->save();

        return redirect()->route('provider.index')->with(['success' => 'Provider Added!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Edit Provider';
        $provider = Provider::where('id', $id)->firstOrFail();

        return view('master.provider.edit', compact('title', 'provider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $provider = Provider::where('id', $id)->firstOrFail();
        $provider->nama_provider = $request->nama_provider;

        $provider->save();
        return redirect()->route('provider.index')->with('success', 'Provider Edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Provider $provider)
    // {
    //     //
    // }
    public function destroy(Request $request)
    {
        $checkPaket = Paket::where('id_provider', $request->id)->get();
        // dd($checkPaket);
        if($checkPaket->isEmpty()) {
            $com = Provider::where('id',$request->id)->delete();
            return redirect()->route('provider.index')->with(['success' => 'Provider Deleted!']);
        } else {
            return redirect()->route('provider.index')->with(['error' => 'This Provider is still associated with Paket Data. Please delete the associated Paket Data first before deleting this Provider!']);
        }
        
    }
}
