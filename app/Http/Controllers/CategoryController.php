<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\baseItem;
use App\Models\Category;
use App\Models\HargaPaket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.category.index', [
            'categories' => Category::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.create', [
            'barangs' => baseItem::all()
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
        if(!isset($request->barang_id)){
            return Redirect::back()->withInput()->with('alert', 'Tambahkan barang terlebih dahulu !!');
        }

        if(isset($request->total)){
            HargaPaket::create([
            'harga' => preg_replace("/[^0-9]/", "", $request->total)
            ]);
            $idHarga = HargaPaket::orderBy('id', 'desc')->take(1)->get('id');
        }else{
            $idHarga = HargaPaket::where('id', 1)->get('id');
        }

        $validData = $request->validate([
            'name' => 'required|max:255|unique:categories',
        ]);
        
        $validData['slug'] = strtr(strtolower($request->name), ' ', '-');
        $validData['harga_paket_id'] = $idHarga[0]->id;

        Category::create($validData);

        $idCategory = Category::orderBy('id', 'desc')->take(1)->get('id');

        $index = 0;

        foreach($request->barang_id as $id){
            $data = baseItem::where('id', $id)->get();
            $jml = $request->jml[$index++];
            $harga = $jml * $data[0]->harga;

            Barang::create([
                'category_id' => $idCategory[0]->id,
                'nama' => $jml . ' ' . $data[0]->satuan . ' ' . $data[0]->nama,
                'harga' => $harga
            ]);
        };

        return redirect('/dashboard/category')->with('success', 'Berhasil menambahkan data baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit', [
            'baseItem' => baseItem::orderBy('nama', 'asc')->get(),
            'barangs' => $category->barang,
            'category' => $category,
            'index' => count($category->barang)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // dd($request->barang_id);

        if($request->total != 0){
            HargaPaket::where('id', $category->harga_paket->id)
                        ->update(['harga' => $request->total]);
        }else{
            HargaPaket::where('id', $category->harga_paket->id)
                        ->update(['harga' => 0]);
        }

        $validData = $request->validate([
            'name' => 'required|max:255',
        ]);
        
        $validData['slug'] = strtr(strtolower($request->name), ' ', '-');
        $validData['harga_paket_id'] = $category->harga_paket->id;

        Category::where('id', $category->id)
                  ->update($validData);

        return redirect('/dashboard/category')->with('success', 'Berhasil merubah data !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        HargaPaket::where('id', $category->harga_paket_id)->delete();
        Category::destroy('id', $category->id);
        Barang::where('category_id', $category->id)->delete();
        return redirect('/dashboard/category')->with('success', 'Data paket berhasil dihapus !!');
    }

    public function hitungHarga(Request $request)
    {
        if(isset($request->jml)){
            $jml = $request->jml;
        }else{
            $jml = 0;
        }

        $d = baseItem::where('id', $request->id)->get();
        $totalAsal = $request->total;
        $harga = ($jml * $d[0]->harga)/40;
        $total = $jml * $d[0]->harga / 40 + $totalAsal;

        if(isset($request->category_id)){
            Barang::create([
                'nama' => $jml . ' ' . $d[0]->satuan . ' ' . $d[0]->nama,
                'harga' => $harga,
                'category_id' => $request->category_id
            ]);
        }

        return response()->json(['harga' => $harga, 'total' => $total]);
    }

    public function cekName(Request $request)
    {
        if(isset($request->hargaBarang)){
            if($request->id == 0){
                $total = $request->total - $request->hargaBarang;
                return $total;
            }else{
                $total = $request->total - $request->hargaBarang;
                Barang::destroy('id', $request->id);
                return $total;
            }
        }

        $cekData = Category::where('name', $request->name)->get();
        return count($cekData);
    }
}

