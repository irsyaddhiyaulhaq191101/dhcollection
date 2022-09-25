@extends('dashboard.layouts.main')

@section('container')
<div class="row align-items-center">
     <div class="col-md-7">
          <h1 class="h2 mt-3">{{ $pengedar->nama }}</h1>
          <small>{{ $pengedar->alamat }}</small><br>
          <small>{{ $pengedar->whatsapp }}</small>
     </div>
     <div class="col-md-5">
          <h3>
               Setoran /Minggu Rp. 
               <?php
               $grandTotal = 0; 
               foreach($pesertas as $peserta){
                    $grandTotal += $peserta->pesanan->sum('total');
               };
               echo number_format($grandTotal,2,',','.');
               ?>
          </h3>
     </div>
</div>
<hr>

<div class="row">
     @foreach ($pesertas as $peserta)
     <div class="col-md-3 mb-3">
          <div class="card">
               <div class="card-body">
                    <h5 class="card-title"><span data-feather="user" class="mb-1"></span> {{ $peserta->nama }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Rp. {{ number_format($peserta->pesanan->sum('total'),2,',','.') }}/Minggu</h6>
                    <p class="card-text">
                         <h6>Daftar Barang :</h6>
                         @foreach ($peserta->pesanan->slice(0, 3) as $pesanan)
                         <div class="row">
                              <div class="col-sm">
                                   - {{ $pesanan->barang->nama }}
                              </div>
                         </div>
                         @endforeach
                    </p>
                    <a href="/dashboard/pesanan?pesertas_id={{ $peserta->id }}" class="card-link badge bg-info text-decoration-none"><span data-feather="eye"></span> View</a>
               </div>
          </div>
     </div>
     @endforeach
</div>

{{ $pesertas->links() }}
@endsection