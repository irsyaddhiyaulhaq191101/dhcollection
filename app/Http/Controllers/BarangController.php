<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\baseItem;
use App\Models\Category;
use App\Models\Peserta;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.barang.index', [
            // 'barangs' => Barang::orderBy('nama')->paginate(10),
            'barangs' => baseItem::orderBy('nama')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.barang.create', [
            'satuans' => ['Kg', 'Liter', 'Botol', 'Pcs']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $indexHarga = 0;
        $indexSatuan = 0;
        foreach($request->nama as $nama){    
            $harga = preg_replace("/[^0-9]/", "", $request->harga);
            $satuan = $request->satuan;
    
            baseItem::create([
                'nama' => $nama,
                'harga' => $harga[$indexHarga++],
                'satuan' => $satuan[$indexSatuan++]
            ]);
        }
        return redirect('/dashboard/barang')->with('success', 'Berhasil menambah barang');
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
    public function edit(baseItem $barang)
    {
        return view('dashboard.barang.edit', [
            'barang' => $barang,
            'satuans' => ['Kg', 'Liter', 'Botol', 'Pcs']
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, baseItem $barang)
    {
        $rules = ([
            'nama' => 'required|max:255',
            'satuan' => 'required'
        ]);

        $validatedData = $request->validate($rules);

        $validatedData['harga'] = preg_replace("/[^0-9]/", "", $request['harga']);

        baseItem::where('id', $barang->id)
                ->update($validatedData);
        return redirect('/dashboard/barang')->with('success', 'Berhasil merubah data barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(baseItem $barang)
    {
        baseItem::destroy($barang->id);
        return redirect('/dashboard/barang')->with('success', 'Data barang berhasil dihapus');
    }

    public function cekNama(Request $request)
    {
        $cekData = baseItem::where('nama', $request->nama)->get();
        return count($cekData);
    }
}
