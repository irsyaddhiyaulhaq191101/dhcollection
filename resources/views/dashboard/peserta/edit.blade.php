@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Ubah Data Peserta</h1>
</div>

<form action="/dashboard/pelanggan/{{ $peserta->id }}" method="post">
  @csrf
  @method('put')
  <div class="mb-3">
    <label for="nama" class="form-label">Nama Peserta</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama', $peserta->nama) }}">
    @error('nama')
    <div class="invalid-feedback">
      {{ $message }}
    </div>        
    @enderror
  </div>
  <div class="mb-3">
    <label for="pengedar" class="form-label">Pengedar</label>
    <select class="form-select" aria-label="Default select example" name="pengedar_id" id="pengedar">
     @foreach ($pengedars as $pengedar)
     @if (old('pengedar_id', $peserta->pengedar_id) == $pengedar->id)
     <option selected value="{{ $pengedar->id }}">{{ $pengedar->nama }}</option>
     @else
     <option value="{{ $pengedar->id }}">{{ $pengedar->nama }}</option>
     @endif
     @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label for="alamat" class="form-label">Alamat Lengkap</label>
    <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $peserta->alamat) }}</textarea>
    @error('alamat')
    <div class="invalid-feedback">
      {{ $message }}
    </div>        
    @enderror
  </div>
  <div class="mb-3">
    <label for="whatsapp" class="form-label">No Whatsapp</label>
    <input type="number" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $peserta->whatsapp) }}">
    @error('whatsapp')
    <div class="invalid-feedback">
      {{ $message }}
    </div>        
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">Update Peserta</button>
</form>
@endsection