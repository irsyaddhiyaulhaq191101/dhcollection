@extends('dashboard.layouts.main')

@section('container')
<style>
  input[type=text]:focus {
  outline: none;
  text-align: center;
}
</style>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
     <h1 class="h2">Daftar Pesanan {{ $peserta[0]->nama }}</h1>
</div>
<input type="text" style="border: none;">

<div class="table-responsive">
    <a href="/dashboard/pesanan/create?pesertas_id={{ $peserta[0]->id }}" class="btn btn-primary mb-3">Tambah Pesanan</a>
     <table class="table table-bordered table-sm">
       <thead>
         <tr class="text-center">
           <th scope="col">No</th>
           <th scope="col">Daftar Barang</th>
           <th scope="col">Jenis Paket</th>
           <th scope="col">Harga</th>
           <th scope="col">Jumlah/Qty</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
       <tbody>
          @foreach ($pesanans as $pesanan)
          <tr id="row{{ $loop->iteration }}">
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $pesanan->barang->nama }} <input type="hidden" id="idPesanan" value="{{ $pesanan->id }}"> </td>
            <td>{{ $pesanan->barang->category->name }}</td>
            <td class="text-center"><input type="text" name="jml" id="jml" ondblclick="myFunction('#row{{ $loop->iteration }}')" onchange="ubah('#row{{ $loop->iteration }}')" style="border: none; text-align: center;" value="{{ $pesanan->jml }}" readonly></td>
            <td class="text-end">
               <div class="d-flex">
                    <div class="me-auto">Rp.</div>
                    <div>
                      <input type="text" style="border: none; text-align: right;" value="{{ number_format($pesanan->total) }}" readonly>
                    </div>
               </div>
            </td>
            <td class="text-center">
               <form action="/dashboard/pesanan/{{ $pesanan->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Data akan dihapus ??')"><span data-feather="x-circle"></span></button>
               </form>
            </td>
          </tr>
          @endforeach
          <tr class="text-center fw-bold fst-italic">
            <td>#</td>
            <td colspan="2">Total Bayar /Minggu</td>
            <td class="text-end" colspan="2">
               <div class="d-flex">
                    <div class="me-auto">Rp.</div>
                    <div>{{ number_format($total,2,',','.') }}</div>
               </div>
            </td>
          </tr>
       </tbody>
     </table>
</div>

<script>
  function myFunction(row)
  {
    var textBox = document.querySelector(row+' #jml');
    $(row+' #jml').prop('readonly',false);
    textBox.style.backgroundColor = 'aliceblue';
  }

  function ubah(row)
  {
    var textBox = document.querySelector(row+' #jml');
    $(row+' #jml').prop('readonly',true);
    const id = document.querySelector(row+' #idPesanan');
    textBox.style.backgroundColor = 'white';

    $.ajax({
       type : 'get',
       url : '/dashboard/pesanan/editData?id='+id.value+'&jml='+textBox.value,
       success : function(data){
            window.location.reload(true);
       }
    });
  }
</script>
@endsection