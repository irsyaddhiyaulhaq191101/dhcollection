@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Data Peserta</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="table-responsive">
    <a href="/dashboard/pelanggan/create" class="btn btn-primary mb-3">Tambah Peserta</a>
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
          @foreach ($pesertas as $peserta)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $peserta->nama }}</td>
            <td>{{ $peserta->alamat }}</td>
            <td class="text-center">{{ $peserta->whatsapp }}</td>
            <td class="text-center">
               <a href="/dashboard/pesanan?pesertas_id={{ $peserta->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
               <a href="/dashboard/pelanggan/{{ $peserta->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
               <form action="/dashboard/pelanggan/{{ $peserta->id }}" method="post" class="d-inline">
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

{{ $pesertas->links() }}
@endsection