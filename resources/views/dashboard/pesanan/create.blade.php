@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Tambah Pesanan {{ $peserta[0]->nama }}</h1>
</div>

<input type="hidden" id="index" value="1">
<form action="/dashboard/pesanan" method="post">
     @csrf
     <input type="hidden" value="{{ $peserta[0]->id }}" name="peserta_id" id="pesertaId">
     <div id="row">
          <div id="col1">
               <div class="mb-3">
                    <label for="barang_id" class="form-label">Pilih Barang</label>
                    <div class="input-group">
                    <span class="input-group-text">Category</span>
                    <select class="form-select form-select-sm fs-6 py-0" name="category" id="category" onchange="select('#col1')">
                         @foreach ($categories as $category)
                         @if (old('category') == $category->id)
                         <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                         @else
                         <option value="{{ $category->id }}">{{ $category->name }}</option>
                         @endif
                         @endforeach
                    </select>
                    </div>
               </div>
               <div class="mb-3" id="isiBarang">
                    
               </div>
          </div>
     </div>
     <button type="submit" class="btn btn-primary">Tambah Barang</button>
</form>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
     const barang_id = document.querySelector('#barang_id');
     const harga = document.querySelector('#harga');
     const viewHarga = document.querySelector('#viewHarga');
     const jml = document.querySelector('#jml');
     const total = document.querySelector('#total');
     const viewTotal = document.querySelector('#viewTotal');

     function select(baris)
     {
          var input = document.querySelector('#index').value;
          var id = document.querySelector(baris+' #category');
          var isiBarang;
          isiBarang = "<div class='row align-items-center mb-3 baris' id='baris"+ input +"'> <div class='col-md-10'> <div class='input-group'> <span class='input-group-text'>Nama Barang</span> <select name='barang_idSelect[]' id='barang_id' onchange='hitungHarga(\"#baris"+input+"\")'> </select> <span class='input-group-text'>Jml</span> <input type='text' class='form-control' name='jml[]' onkeyup='hitungHarga(\"#baris"+input+"\")' id='jml' value='{{ old('jml') }}' required> <span class='input-group-text'>Harga</span> <input type='text' class='form-control harga' name='hargaSelect[]' id='harga' value='{{ old('harga') }}' required readonly onchange='hitungHarga(\"#baris"+input+"\")'> </div> </div> <div class='col-md-2 text-center'> <a class='btn btn-danger py-0 fs-5' onclick='hapusBaris(\"#baris"+input+"\")'>-</a> <a class='btn btn-primary py-0 fs-5' onclick='tambahBaris(\"#col"+1+"\")'>+</a> </div> </div> <div id='daftar'></div>";

          var daftarBarang;
          daftarBarang = "<div class='card'> <div class='card-body'> <h5 class='card-title'>Daftar Barang</h5> <div class='row' id='daftar'> </div> </div> </div> <div id='barang_id' hidden></div>";

          $.ajax({
               type : 'get',
               url : '/dashboard/pesanan/getId?categoryId='+id.value,
               success : function(data){
                    const isi = JSON.stringify(data);
                    let text = "";
                    let daftar = "";
                    data.forEach(element => {
                         text +="<option value='"+element['id']+"'>"+element['nama']+"</option>";
                         daftar +="<div class='col-md-3'> <input type='text' class='form-control mb-3' value='"+element['nama']+"' readonly> <input type='hidden' name='barang_id[]' id='daftarInput' value='"+element['id']+"'> <input type='hidden' name='harga[]' value='"+element['harga']+"'> </div>";
                    });
                    document.getElementById("barang_id").innerHTML = text;
                    document.getElementById("daftar").innerHTML = daftar;
               }
          });
          $.ajax({
               type : 'get',
               url : '/dashboard/pesanan/cekHarga?idCategory='+id.value,
               success : function(data){
                    if(data == 0){
                         $('#isiBarang').prepend(isiBarang);
                         input = (input-1)+2;
                         $('#index').val(input);
                         $(baris+" #category").prop("disabled",true);
                    }else{
                         $('#isiBarang').prepend(daftarBarang);
                         $(baris+" #category").prop("disabled",true);
                    }
               }
          });
     }

     function tambahBaris(baris)
     {
          var input = document.querySelector('#index').value;
          var id = document.querySelector(baris+' #category');
          var isiBarang;
          isiBarang = "<div class='row align-items-center mb-3 baris' id='baris"+ input +"'> <div class='col-md-10'> <div class='input-group'> <span class='input-group-text'>Nama Barang</span> <select name='barang_idSelect[]' id='barang_id' onchange='hitungHarga(\"#baris"+input+"\")'> </select> <span class='input-group-text'>Jml</span> <input type='text' class='form-control' name='jml[]' onkeyup='hitungHarga(\"#baris"+input+"\")' id='jml' value='{{ old('jml') }}' required> <span class='input-group-text'>Harga</span> <input type='text' class='form-control harga' name='hargaSelect[]' id='harga' value='{{ old('harga') }}' required readonly onchange='hitungHarga(\"#baris"+input+"\")'> </div> </div> <div class='col-md-2 text-center'> <a class='btn btn-danger py-0 fs-5' onclick='hapusBaris(\"#baris"+input+"\")'>-</a> <a class='btn btn-primary py-0 fs-5' onclick='tambahBaris(\"#col"+1+"\")'>+</a> </div> </div>";
          $('#isiBarang').prepend(isiBarang);
          input = (input-1)+2;
          $('#index').val(input);

          $.ajax({
               type : 'get',
               url : '/dashboard/pesanan/getId?categoryId='+id.value,
               success : function(data){
                    const isi = JSON.stringify(data);
                    let text = "";
                    data.forEach(element => {
                         text +="<option value='"+element['id']+"'>"+element['nama']+"</option>"
                    });
                    document.getElementById("barang_id").innerHTML = text;
               }
          });
     }

     function hapusBaris(baris)
     {
         $(baris).remove()
         console.log($('.baris').length)
         if($('.baris').length == 0){
          $("#category").prop("disabled",false);
         }
     }

     function hitungHarga(bariske)
     {
          const harga = document.querySelector(bariske+' #harga');
          const id = document.querySelector(bariske+' #barang_id');
          const jml = document.querySelector(bariske+' #jml');

          const data = {
               id : $(bariske+' #barang_id').val(),
               jml : $(bariske+' #jml').val(),
               // total : $('#totalHidden').val()
               };

          fetch('/hitungharga/pesanan', {
               method : 'post',
               credentials: 'same-origin',
               headers : {
               'Content-Type' : 'application/json',
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               body : JSON.stringify(data),
          })
               .then(response => response.json())
               .then(data => [harga.value = data.harga]);
     }

     function hitungTotal()
     {
          var harga = document.getElementsByClassName('harga');
          let data = [].map.call(harga, elem => elem.value);
          let tot = data.reduce((val, nilaiSekarang)=>{
          return Number(val) + Number(nilaiSekarang)
          },0);
          $('#viewTotal').val(tot)
     }
</script>

@endsection
