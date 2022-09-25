@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Edit Barang</h1>
</div>

<form action="/dashboard/barang/{{ $barang->id }}" method="post">
  @csrf
  @method('put')
  <div class="mb-3">
    <label for="nama" class="form-label">Nama Barang</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama', $barang->nama) }}">
    @error('nama')
    <div class="invalid-feedback">
      {{ $message }}
    </div>        
    @enderror
  </div>
  <div class="mb-3">
    <label for="harga" class="form-label @error('harga') is-invalid @enderror">Harga Barang (/Pcs/Kg/Liter)</label>
    <div class="input-group mb-3">
          <input type="text" class="form-control" name="harga" id="harga" value="{{ old('harga', 'Rp. ' . number_format($barang->harga,0,',','.')) }}">
          @error('harga')
          <div class="invalid-feedback">
               {{ $message }}
          </div>        
          @enderror
          <label class="input-group-text" for="satuan">/</label>
          <select class="form-select form-select-sm fs-6 py-0" id="satuan" name="satuan">
               @foreach ($satuans as $satuan)
               @if (old('satuan', $barang->satuan) == $satuan)
                   <option selected value='{{ $satuan }}'>{{ $satuan }}</option>
               @else
                   <option value="{{ $satuan }}">{{ $satuan }}</option>
               @endif
               @endforeach
          </select>
     </div>
  </div>
  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>

<script>
     const harga = document.querySelector('#harga');
     harga.addEventListener('keyup', function(e) {
          harga.value = formatRupiah(this.value, 'Rp. ');
     });

     harga.addEventListener('onloadeddata', function(e) {
          harga.value = formatRupiah(this.value, 'Rp. ');
     });

     function formatRupiah(angka, prefix)
     {
          var number_string = angka.replace(/[^,\d]/g, '').toString(),
               split    = number_string.split(','),
               sisa     = split[0].length % 3,
               rupiah     = split[0].substr(0, sisa),
               ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
               
          if (ribuan) {
               separator = sisa ? '.' : '';
               rupiah += separator + ribuan.join('.');
          }
          
          rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
          return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
     }
</script>
@endsection