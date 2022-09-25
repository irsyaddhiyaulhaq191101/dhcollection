@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Data Pengedar</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/pengedar/create" class="btn btn-primary mb-3">Tambah Personil</a>
     <table class="table table-bordered table-sm">
       <thead>
         <tr class="text-center">
           <th scope="col">No</th>
           <th scope="col">Nama</th>
           <th scope="col">Alamat</th>
           <th scope="col">Whatsapp</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
       <tbody>
          @foreach ($pengedars as $pengedar)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $pengedar->nama }}</td>
            <td>{{ $pengedar->alamat }}</td>
            <td class="text-center">{{ $pengedar->whatsapp }}</td>
            <td class="text-center">
               <a href="/dashboard/pengedar/{{ $pengedar->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
               <a href="/dashboard/pengedar/{{ $pengedar->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
               <form action="/dashboard/pengedar/{{ $pengedar->id }}" method="post" class="d-inline">
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

{{ $pengedars->links() }}
@endsection