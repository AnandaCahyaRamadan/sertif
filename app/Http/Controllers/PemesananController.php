<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Pelanggan;
use App\Models\Gitar;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Pemesanan::paginate(5);

        return view('pemesanan.index', [
            'pemesanan' => $order
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Pelanggan::all();
        $guitar = Gitar::all();
        return view('pemesanan.create', compact('customer','guitar'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pesan' => 'required',
            'keterangan' => 'required'

        ]);
    
        $array = $request->only([
            'tanggal_pesan','pelanggan_id', 'gitar_id','keterangan'
        ]);
    
        $order = Pemesanan::create($array);
        return redirect()->route('pemesanan.index')
            ->with('success_message', 'Berhasil menambah Data');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {        
      
        $order = Pemesanan::find($id);
        $customer = Pelanggan::all();
        $guitar = Gitar::all();
        if (!$order) return redirect()->route('pemesanan.index')
            ->with('error_message', 'pemesan dengan id'.$id.' tidak ditemukan');
            
        return view('pemesanan.edit',compact('order','customer','guitar'),[
            'pemesanan' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pesan' => 'required',
            'keterangan' => 'required'
        ]);
    
        $order = Pemesanan::find($id);
        $order->tanggal_pesan = $request->tanggal_pesan;
        $order->pelanggan_id = $request->pelanggan_id;
        $order->gitar_id = $request->gitar_id;
        $order->keterangan = $request->keterangan;
        $order->save();
    
        return redirect()->route('pemesanan.index')
            ->with('success_message', 'Berhasil mengubah Data Pemesanan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Pemesanan::find($id);
        if ($order) $order->delete();
        
        return redirect()->route('pemesanan.index')
            ->with('success_message', 'Berhasil menghapus');
    }
    public function search(Request $request)
    {
        $keyword = $request->search;
        $pemesanan = Pemesanan::where('tanggal_pesan', 'like', "%" . $keyword . "%")->paginate(5);
        return view('pemesanan.index', compact('pemesanan'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}

