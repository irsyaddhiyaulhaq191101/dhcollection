<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use App\Models\Pesanan;
use App\Models\Peserta;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pesanan = Pesanan::where('peserta_id', $request->pesertas_id)->get();
        return view('dashboard.pesanan.index', [
            'pesanans' => $pesanan,
            'peserta' => Peserta::where('id', $request['pesertas_id'])->get(),
            'total' => Pesanan::where('peserta_id', $request['pesertas_id'])->sum('total')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIDCategory(Request $request)
    {
        $idCategory = $request->categoryId;
        $isi = Barang::where('category_id', $idCategory)->get();
        return $isi;
    }

    public function create(Request $request)
    {
        return view('dashboard.pesanan.create', [
            'peserta' => Peserta::where('id', $request->pesertas_id)->get(),
            'barangs' => Barang::all(),
            'categories' => Category::orderBy('name')->get()
        ]);
    }

    public function hitungHarga(Request $request)
    {
        $barang = Barang::where('id', $request->id)->get();
        $jml = $request->jml;
        $harga = $barang[0]->harga * $jml;

        return response()->json(['harga' => $harga]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!isset($request->jml)){
            $indexHarga = 0;
            foreach($request->barang_id as $idBarang){
                Pesanan::create([
                    'barang_id' => $idBarang,
                    'peserta_id' => $request->peserta_id,
                    'jml' => 1,
                    'total' => $request->harga[$indexHarga++]
                ]);
            }
        }else{
            // dd($request->barang_idSelect);
            $indexJml = 0;
            $indexHarga = 0;
            foreach($request->barang_idSelect as $idBarang){
                Pesanan::create([
                    'barang_id' => $idBarang,
                    'peserta_id' => $request->peserta_id,
                    'jml' => $request->jml[$indexJml++],
                    'total' => $request->hargaSelect[$indexHarga++]
                ]);
            }
        }

        return redirect('dashboard/pesanan?pesertas_id=' . $request['peserta_id'])->with('success', 'Berhasil menambah post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        //
    }

    public function editData(Request $request)
    {
        $query = Pesanan::where('id', $request->id)->get();
        $total = ($query[0]->barang->harga) * $request->jml;

        $rules = [
            'jml' => $request->jml,
            'total' => $total
        ];

        Pesanan::where('id', $request->id)
                 ->update($rules);

        return $total;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesanan $pesanan)
    {
        $kondisi = ['id' => $pesanan->id, 'peserta_id' => $pesanan->peserta_id];
        Pesanan::destroy($kondisi);
        return redirect('dashboard/pesanan?pesertas_id=' . $pesanan->peserta_id)->with('success', 'Berhasil menghapus data');
    }

    public function cekHarga(Request $request)
    {
        if(isset($request->idCategory)){
            $query = Category::where('id', $request->idCategory)->get();
            $harga = $query[0]->harga_paket->harga;
            return $harga;
        }
    }
}
