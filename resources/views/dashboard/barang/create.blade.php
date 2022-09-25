@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Tambah Barang</h1>
</div>

<form action="/dashboard/barang" method="post">
  @csrf
  <input type="hidden" value="2" id="index">
  <div class="d-flex flex-row-reverse">
     <a class="btn btn-primary py-0 ms-auto fs-5" onclick="tambahBaris()">+</a>
  </div>

  <div id="rumah">
       <div class="row align-items-center mb-3" id="baris1">
          <div class="col-md-11">
               <div class="input-group">
                    <span class="input-group-text">Nama Barang</span>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" onkeyup="cekNama('#baris1')" name="nama[]" id="nama" value="{{ old('nama') }}" autofocus required>
                    <span class="input-group-text">Harga</span>
                    <input type="text" class="form-control" name="harga[]" onkeyup="format('#baris1')" id="harga" value="{{ old('harga') }}" required>
                    <span class="input-group-text">/</span>
                    <select class="form-select form-select-sm fs-6 py-0" id="satuan" name="satuan[]">
                         @foreach ($satuans as $satuan)
                         @if (old('satuan') == $satuan)
                             <option selected value='{{ $satuan }}'>{{ $satuan }}</option>
                         @else
                             <option value="{{ $satuan }}">{{ $satuan }}</option>
                         @endif
                         @endforeach
                    </select>
               </div>
          </div>
          <div class="col-md-1 text-end">
               <a class="btn btn-danger py-0 fs-5 form-control" onclick="hapusBaris('#baris1')">-</a>
          </div>
       </div>
  </div>

  <button type="submit" class="btn btn-primary" id="insert">Tambah</button>
</form>

<script>
     function format(row)
     {
          const harga = document.querySelector(row+' #harga');
          harga.addEventListener('keyup', function(e) {
               harga.value = formatRupiah(this.value, 'Rp. ');
          });
     }

     function tambahBaris()
     {
          var isian;
          var input = $('#index').val();

          isian = "<div class='row align-items-center mb-3' id='baris"+ input +"'> <div class='col-md-11'> <div class='input-group'> <span class='input-group-text'>Nama Barang</span> <input type='text' class='form-control @error('nama') is-invalid @enderror' name='nama[]' onkeyup='cekNama(\"#baris"+input+"\")' id='nama' value='{{ old('nama') }}' autofocus required> @error('nama') <div class='invalid-feedback'> {{ $message }} </div> @enderror <span class='input-group-text'>Harga</span> <input type='text' class='form-control' name='harga[]' onkeyup='format(\"#baris"+input+"\")' id='harga' value='{{ old('harga') }}' required> @error('harga') <div class='invalid-feedback'> {{ $message }} </div> @enderror <span class='input-group-text'>/</span> <select class='form-select form-select-sm fs-6 py-0' id='satuan' name='satuan[]'> @foreach ($satuans as $satuan) @if (old('satuan') == $satuan)<option selected value='{{ $satuan }}'>{{ $satuan }}</option>@else <option value='{{ $satuan }}'>{{ $satuan }}</option> @endif @endforeach </select> </div> </div> <div class='col-md-1 text-center'> <a class='btn btn-danger py-0 form-control fs-5' onclick='hapusBaris(\"#baris"+input+"\")'>-</a> </div> </div>";

          $('#rumah').prepend(isian);
          input = (input-1)+2;
          $('#index').val(input);
     }

     function hapusBaris(baris)
     {
          $(baris).remove()
     }

     function cekNama(baris)
     {
          const nama = document.querySelector(baris+' #nama');
          const alert = document.querySelector(baris+' #errorName');

          $.ajax({
               type : 'get',
               url : '/cekNamaBarang?nama='+nama.value,
               success : function(data){
                    if(data == 0){
                    $(alert).html("");
                    $(nama).removeClass("is-invalid");
                    $(nama).addClass("is-valid");
                    $('#insert').removeClass("disabled");
                    }else{
                    $(alert).html("<p class='text-danger'>Categori sudah ada</p>");
                    $(nama).removeClass("is-valid");
                    $('#insert').addClass("disabled");
                    $(nama).addClass("is-invalid");
                    }
               }
          });
     }

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