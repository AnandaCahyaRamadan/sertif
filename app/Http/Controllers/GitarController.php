<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gitar;


class GitarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guitar = Gitar::paginate(5);
    
        return view('gitar.index', [
            'gitar' => $guitar
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gitar.create');
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
            'merk' => 'required',
            'seri' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);
    
        $array = $request->only([
            'merk','seri', 'jenis','harga'
        ]);
    
        $guitar = Gitar::create($array);
        return redirect()->route('gitar.index')
            ->with('success_message', 'Berhasil menambah gitar baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $guitar = Gitar::find($id);
        if (!$guitar) return redirect()->route('gitar.index')
            ->with('error_message', 'gitar dengan id'.$id.' tidak ditemukan');
    
        return view('gitar.edit', [
            'gitar' => $guitar
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'merk' => 'required',
            'seri' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);
    
        $guitar = Gitar::find($id);
        $guitar->merk = $request->merk;
        $guitar->seri = $request->seri;
        $guitar->jenis = $request->jenis;
        $guitar->harga = $request->harga;
        
        $guitar->save();
    
        return redirect()->route('gitar.index')
            ->with('success_message', 'Berhasil mengubah Data Gitar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guitar = Gitar::find($id);
    
        // if ($id == $request->user()->id) return redirect()->route('gitar.index')
        //     ->with('error_message', 'Anda tidak dapat menghapus.');
    
        if ($guitar) $guitar->delete();
    
        return redirect()->route('gitar.index')
            ->with('success_message', 'Berhasil menghapus');
    }
    public function search(Request $request)
    {
        $keyword = $request->search;
        $gitar = Gitar::where('merk', 'like', "%" . $keyword . "%")->paginate(5);
        return view('gitar.index', compact('gitar'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
