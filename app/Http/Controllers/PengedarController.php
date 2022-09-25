<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengedar;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Peserta;
use Illuminate\Auth\Events\Validated;

class PengedarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pengedar.index', [
            'pengedars' => Pengedar::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pengedar.create');
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
            'whatsapp' => 'required|min:12|max:15|unique:pengedars'
        ]);

        Pengedar::create($validatedData);
        return redirect('/dashboard/pengedar')->with('success', 'Data pengedar berhasil ditambahkan !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pengedar $pengedar)
    {
        return view('dashboard.pengedar.show', [
            'pengedar' => $pengedar,
            // 'pesertas' => $pengedar->peserta,
            'pesertas' => Peserta::where('pengedar_id', $pengedar->id)->paginate(12)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengedar $pengedar)
    {
        return view('dashboard.pengedar.edit', [
            'pengedar' => $pengedar
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengedar $pengedar)
    {
        $rules = [
            'nama' => 'required|max:255',
            'alamat' => 'required|max:255'
        ];

        if($request->whatsapp != $pengedar->whatsapp){
            $rules['whatsapp'] = 'required|min:12|max:15|unique:pengedars';
        };

        $validatedData = $request->validate($rules);

        Pengedar::where('id', $pengedar->id)->update($validatedData);
        return redirect('/dashboard/pengedar')->with('success', 'Data pengedar berhasil ditambahkan !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengedar $pengedar)
    {
        Peserta::where('pengedar_id', $pengedar->id)->update(['pengedar_id' => '6']);
        Pengedar::destroy('id', $pengedar->id);
        return redirect('/dashboard/pengedar')->with('success', 'Data pengedar berhasil dihapus !!');
    }
}
