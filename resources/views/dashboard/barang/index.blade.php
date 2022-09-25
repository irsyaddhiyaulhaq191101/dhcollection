@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Data Barang</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/barang/create" class="btn btn-primary mb-3">Tambah Barang</a>
     <table class="table table-bordered table-sm">
       <thead>
         <tr class="text-center">
           <th scope="col">No</th>
           <th scope="col">Nama Barang</th>
           <th scope="col">Harga (/Minggu)</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
       <tbody>
          @foreach ($barangs as $barang)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $barang->nama }}</td>
            <td class="text-end">
               <div class="d-flex">
                    <div class="me-auto">Rp.</div>
                    <div>{{ number_format($barang->harga,0,',','.') }}</div>
               </div>
            </td>
            <td class="text-center">
               <a href="/dashboard/barang/{{ $barang->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
               <form action="/dashboard/barang/{{ $barang->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Data akan dihapus ??')"><span data-feather="x-circle"></span></button>
               </form>
            </td>
          </tr>
          @endforeach
       </tbody>
     </table>
</div>
{{ $barangs->links() }}

@endsection