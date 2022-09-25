@extends('dashboard.layouts.main')

@section('container')
@section('container')
<input type="hidden" id="category_id" value="{{ $category->id }}">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Ubah Data Paket</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif

<form action="/dashboard/category/{{ $category->id }}" method="post">
  @csrf
  @method('put')
  <div class="mb-3">
    <label for="name" class="form-label">Nama Paket</label>
    <div class="input-group mb-3">
      <div class="input-group-text">
        <p class="mt-3">Edit Nama</p>&nbsp;
        <input class="form-check-input mt-0" type="checkbox" id="click">
      </div>
      <input type="text" class="form-control " name="name" id="name" onchange="cekName()" value="{{ old('name', $category->name) }}" readonly required>
    </div>
    <div class="text-danger" id="errorName">
      
    </div>
  </div>
  <hr>
  <div class="mb-3">
    @if (session()->has('alert'))
    <div class="alert alert-danger" role="alert">
      {{ session('alert') }}
    </div>
    @endif
    <div class="d-flex">
      <div class="py-2 flex-fill">
        <label for="barang" class="form-label @error('harga') is-invalid @enderror">Daftar Barang</label>
      </div>
      <div class="p-2 flex-fill"></div>
      <div class="p-2 flex-fill text-end">
        <a class="btn btn-primary py-1" onclick="action()"><span data-feather="plus"></span></a>
      </div>
    </div>
  
    <input type="hidden" id="input" value="{{ $index+1 }}">
    <div id="rows">
      <?php $i = 1; $ih = 1; $ij = 1; ?>
      @foreach ($barangs as $item)
      <div class='row mb-3' id='row{{ $i++ }}'>
          <div class='col-md-5'>
              <div class='input-group'>
                  <label class='input-group-text' for='barang'>Nama Barang</label>
                  <select class='form-select form-select-sm fs-6 py-0' id='barang' name='barang_id[]' disabled>
                      @foreach ($baseItem as $barang)
                          @if (old('barang_id', $barang->nama == explode(" ", $item->nama,3)[2]))
                              <option selected value='{{ $barang->id }}'>{{ $barang->nama }}</option>
                          @else
                              <option value='{{ $barang->id }}'>{{ $barang->nama }}</option>
                          @endif
                      @endforeach
                  </select>
                  <input type="hidden" name="idBarangLama[]" id="idBarangLama" value="{{ $item->id }}">
              </div>
          </div>
          <div class='col-md-3'>
              <div class='input-group'>
                  <label class='input-group-text' for='jml'>Jumlah</label>
                  <input type='text' class='form-control @error('jml') is-invalid @enderror' onchange="hitung('#row{{ $ij++ }}')" name='jml[]' id='jumlah' value='{{ old('jumlah', explode(' ',trim($item->nama))[0]) }}' readonly>
              </div>
          </div>
          <div class='col-md-3'>
              <div class='input-group'> <label class='input-group-text' for='harga'>Harga</label>
                  <input type='text' class='form-control @error('harga') is-invalid @enderror' name='harga[]'
                      id='harga' value='{{ old('harga', $item->harga) }}' readonly>
              </div>
          </div>
          <div class='col-md-1 text-center'>
              <div class='input-group'>
                  <a class='btn btn-danger form-control btn-sm pt-0 fs-2' onclick="hapus('#row{{ $ih++ }}')">-</a>
              </div>
          </div>
      </div>
      @endforeach
    </div>
    
  </div>
  <hr>
  <div class="mb-3">
    <label for="total" class="form-label">Total Harga</label>
    <div class="input-group mb-3">
      <div class="input-group-text">
        <p class="mt-3">Hitung Harga Otomatis</p>&nbsp;
        <input class="form-check-input mt-0" type="checkbox" id="checkHarga">
      </div>
      <input type="text" class="form-control @error('total') is-invalid @enderror" name="total" id="total" value="{{ old('total', $category->harga_paket->harga) }}" @error('total') placeholder="{{ $message }}" @enderror>
      <input type="hidden" id="totalHidden" value="{{ old('total', $category->barang->sum('harga')) }}">
    </div>
  </div>
  <button type="submit" class="btn btn-primary" id="insert">Simpan</button>
</form>

<meta name="csrf-token" content="{{ csrf_token() }}">
<input type="hidden" id="index">

<script>

  $('#click').change(function(){
    if(this.checked){
      $('#name').prop("readonly",false);
    }else{
      $('#name').prop("readonly",true);
    }
  });

  $('#checkHarga').change(function(){
    const total = $('#totalHidden').val();
    if(this.checked){
      $('#total').val(total);
    }else{
      $('#total').val("0");
    }
  });

  function cekName()
  {
    const name = document.querySelector('#name');
      $.ajax({
        type : 'get',
        url : '/cekCategory?name='+name.value,
        success : function(data){
          if(data == 0){
            $('#errorName').html("");
            $('#insert').removeClass("disabled");
            $('#name').removeClass("is-invalid");
            $('#name').addClass("is-valid");
          }else{
            $('#errorName').html("<p class='text-danger'>Categori sudah ada</p>");
            $('#name').removeClass("is-valid");
            $('#name').addClass("is-invalid");
            $('#insert').addClass("disabled");
          }
        }
      })
  }

  counter=0;

  function action(){
    var input = document.getElementById("input").value;
    var stre;
    stre = "<div class='row mb-3' id='row" + input + "'> <div class='col-md-5'> <div class='input-group'> <label class='input-group-text' for='barang'>Nama Barang</label> <select class='form-select form-select-sm fs-6 py-0' id='barang' name='barang_id[]'> @foreach ($baseItem as $barang) @if (old('barang_id') == $barang->id) <option selected value='{{ $barang->id }}'>{{ $barang->nama }}</option> @else <option value='{{ $barang->id }}'>{{ $barang->nama }}</option> @endif @endforeach</select></div></div> <div class='col-md-3'> <div class='input-group'> <label class='input-group-text' for='jml'>Jumlah</label> <input type='text' class='form-control @error('jml') is-invalid @enderror' onchange='hitung(\"#row"+input+"\")' name='jml[]' id='jumlah' value='{{ old('jumlah') }}' autofocus> </div> </div> <div class='col-md-3'> <div class='input-group'> <label class='input-group-text' for='harga'>Harga</label> <input type='text' class='form-control @error('harga') is-invalid @enderror' name='harga[]' id='harga' value='{{ old('harga', 0) }}' readonly> </div> </div> <div class='col-md-1 text-center'> <div class='input-group'> <a class='btn btn-danger form-control btn-sm pt-0 fs-2' onclick='hapus(\"#row"+input+"\")'>-</a> </div> </div> </div>";
    $("#rows").append(stre);
    input = (input-1) + 2;
    document.getElementById("input").value = input;
    document.getElementById("index").value = input-1;
  }

  function hapus(row)
  {
    // var isi = $('#row1 #idBarangLama').val();
    if(typeof $(row+' #idBarangLama').val() == 'string'){
      var id = $(row+' #idBarangLama').val();
    }else{
      var id = "0";
    }

    const total = document.querySelector('#totalHidden');
    const hargaBarang = document.querySelector(row+' #harga');
    $.ajax({
        type : 'get',
        url : '/cekCategory?hargaBarang='+hargaBarang.value+'&total='+total.value+'&id='+id,
        success : function(data){
          total.value = data
        }
      })

    $(row).remove();
  }

  function hitung(row) {

    const harga = document.querySelector(row+' #harga');
    const id = document.querySelector(row+' #barang');
    const total = document.querySelector('#totalHidden');

    const data = {
        id : $(row+' #barang').val(),
        jml : $(row+' #jumlah').val(),
        total : $('#totalHidden').val(),
        category_id : $('#category_id').val()
      };

    fetch('/operasi/hitung', {
      method : 'post',
      credentials: 'same-origin',
      headers : {
        'Content-Type' : 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      body : JSON.stringify(data),
    })
       .then(response => response.json())
       .then(data => [total.value = data.total, harga.value = data.harga]);
    
    $(row+" #jumlah").prop("readonly",true);
    $(row+" #barang").prop("disabled",true);
  }


</script>

@endsection