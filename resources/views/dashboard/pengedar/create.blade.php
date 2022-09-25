@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Tambah Personil</h1>
</div>

<form action="/dashboard/pengedar" method="post">
  @csrf
  <div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}">
    @error('nama')
    <div class="invalid-feedback">
      {{ $message }}
    </div>        
    @enderror
  </div>
  <div class="mb-3">
    <label for="alamat" class="form-label">Alamat Lengkap</label>
    <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
    @error('alamat')
    <div class="invalid-feedback">
      {{ $message }}
    </div>        
    @enderror
  </div>
  <div class="mb-3">
    <label for="whatsapp" class="form-label">No Whatsapp</label>
    <input type="number" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}">
    @error('whatsapp')
    <div class="invalid-feedback">
      {{ $message }}
    </div>        
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">Tambah Data</button>
</form>
@endsection