@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Daftar Paket</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/category/create" class="btn btn-primary mb-3">Tambah Daftar Paket</a>
     <table class="table table-bordered table-sm">
       <thead>
         <tr class="text-center">
           <th scope="col">No</th>
           <th scope="col">Nama Paket</th>
           <th scope="col">Harga /Minggu</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
       <tbody>
          @foreach ($categories as $category)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $category->name }}</td>
            <td class="text-end">
               <div class="d-flex">
                    <div class="me-auto">Rp.</div>
                    <div>{{ number_format($category->harga_paket->harga,0,',','.') }}</div>
               </div>
            </td>
            <td class="text-center">
               <a href="/dashboard/category/{{ $category->id }}/edit" class="badge bg-info"><span data-feather="eye"></span></a>
               <form action="/dashboard/category/{{ $category->id }}" method="post" class="d-inline">
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
{{ $categories->links() }}
@endsection