<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use App\Models\Pengedar;
use App\Models\Pesanan;
use App\Models\Peserta;
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
        return view('dashboard.peserta.index', [
            'pesertas' => Peserta::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.peserta.create', [
            'categories' => Category::all(),
            'pengedars' => Pengedar::all()
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
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'whatsapp' => 'required|min:12|max:15',
            'pengedar_id' => 'required'
        ]);

        Peserta::create($validatedData);
        return redirect('/dashboard/pelanggan')->with('success', 'Berhasil menambahkan peserta!');
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
    public function edit(Peserta $pelanggan)
    {
        return view('dashboard.peserta.edit', [
            'categories' => Category::all(),
            'pengedars' => Pengedar::all(),
            'peserta' => $pelanggan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peserta $pelanggan)
    {
        $rules = [
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255',
            'pengedar_id' => 'required'
        ];

        if($request->whatsapp != $pelanggan->whatsapp) {
            $rules['whatsapp'] = 'required|min:12|max:15|unique:pesertas';
        }

        $validatedData = $request->validate($rules);

        Peserta::where('id', $pelanggan->id)->update($validatedData);
        return redirect('dashboard/pelanggan')->with('success', 'Data peserta berhasil dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peserta $pelanggan)
    {
        Pesanan::where('peserta_id', $pelanggan->id)->delete();
        Peserta::destroy('id', $pelanggan->id);
        
        return redirect('/dashboard/pelanggan')->with('success', 'Data pelanggan berhasil dihapus!!');
        
    }
}
