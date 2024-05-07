@extends('layouts.app')
 
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3"><strong>{{ $title }}</strong></h4>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form action="{{ route('paket.update', $paket->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                <label for="nama_paket" class="form-label">
                                    <strong>
                                        Nama Paket
                                    </strong>
                                </label>
                                <input type="text" class="form-control" id="nama_paket" name="nama_paket" aria-describedby="nama_paket" required value="{{ $paket->nama_paket }}">
                                </div>
                                <div class="mb-3">
                                    <label for="provider" class="form-label">
                                        <strong>Provider</strong>
                                    </label>
                                    <select class="form-select" name="provider" id="provider" aria-label="Default select example" required>
                                        <option value="" disabled selected>Pilih Provider</option>
                                        @foreach ($provider as $item)
                                            <option value="{{ $item->id }}" @if($paket->id_provider == $item->id) selected @endif>{{ $item->nama_provider }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">
                                        <strong>Harga</strong>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="harga" name="harga" aria-describedby="harga" value="Rp. {{ number_format($paket->harga, 0, ',', '.') }}" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="kecepatan" class="form-label">
                                        <strong>
                                            Kecepatan Internet
                                        </strong>
                                    </label>
                                    <div class="input-group mb-3">
                                        {{-- <input type="text" class="form-control" id="kecepatan" name="kecepatan" value="{{ $paket->kecepatan }}" aria-label="kecepatan" aria-describedby="kecepatan2" required> --}}
                                        <input type="text" class="form-control" id="kecepatan" name="kecepatan" value="{{ preg_replace('/\D/', '', $paket->kecepatan) }}" aria-label="kecepatan" aria-describedby="kecepatan2" required>
                                        <span class="input-group-text" id="kecepatan2">Mbps</span>
                                    </div>                            
                                </div>
                                
                              
                                <div class="row">
                                    <div class="col"> 
                                        <a href="{{ route('paket.index') }}" data-toggle="tooltip" data-original-title="Edit" class="btn float-end btn-sm btn-secondary">Kembali</a>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-sm btn-success mb-3 float-end">Simpan</button>
                                    </div>
                                </div>
                               
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 
@push('scripts')
<script>
    const inputHarga = document.getElementById('harga');

    // Jalankan fungsi saat halaman dimuat
    window.addEventListener('load', function() {
        // Format nilai input harga saat halaman dimuat
        formatHarga();
    });

    // Tambahkan event listener untuk event input
    inputHarga.addEventListener('input', function() {
        // Format nilai input harga saat pengguna mengetik
        formatHarga();
    });

    // Fungsi untuk mengubah nilai menjadi format mata uang Rupiah
    function formatHarga() {
        // Ambil nilai yang dimasukkan oleh pengguna
        let nilai = inputHarga.value.replace(/\D/g, ''); // Hapus semua karakter non-digit dari nilai

        // Ubah nilai menjadi format mata uang yang sesuai
        nilai = 'Rp. ' + new Intl.NumberFormat('id-ID').format(nilai);

        // Set nilai baru pada input harga
        inputHarga.value = nilai;
    }
</script>
@endpush