<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Pelanggan::paginate(5);
    
        return view('pelanggan.index', [
            'pelanggan' => $customer
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelanggan.create');
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nomor_hp' => 'required',
            'alamat' => 'required'
        ]);
    
        $array = $request->only([
            'nama', 'nomor_hp', 'alamat'
        ]);
    
        $customer = Pelanggan::create($array);
        return redirect()->route('pelanggan.index')
            ->with('success_message', 'Berhasil menambah pelanggan baru');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $customer = Pelanggan::find($id);
        if (!$customer) return redirect()->route('pelanggan.index')
            ->with('error_message', 'pelanggan dengan id'.$id.' tidak ditemukan');
    
        return view('pelanggan.edit', [
            'pelanggan' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nomor_hp' => 'required',
            'alamat' => 'required'
        ]);
    
        $customer = Pelanggan::find($id);
        $customer->nama = $request->nama;
        $customer->nomor_hp = $request->nomor_hp;
        $customer->alamat = $request->alamat;
        $customer->save();
    
        return redirect()->route('pelanggan.index')
            ->with('success_message', 'Berhasil mengubah Data Pelanggan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Pelanggan::find($id);
        if ($customer) $customer->delete();
    
        return redirect()->route('pelanggan.index')
            ->with('success_message', 'Berhasil menghapus user');
    
    }
    public function search(Request $request)
    {
        $keyword = $request->search;
        $pelanggan = Pelanggan::where('nama', 'like', "%" . $keyword . "%")->paginate(5);
        return view('pelanggan.index', compact('pelanggan'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}