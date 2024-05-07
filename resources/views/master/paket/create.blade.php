@extends('layouts.app')
 
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3"><strong>{{ $title }}</strong></h4>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form action="{{ route('paket.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                <label for="nama_paket" class="form-label">
                                    <strong>
                                        Nama Paket
                                    </strong>
                                </label>
                                <input type="text" class="form-control" id="nama_paket" name="nama_paket" aria-describedby="nama_paket" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_provider" class="form-label">
                                        <strong>
                                            Provider
                                        </strong>
                                    </label>
                                    <select class="form-select" name="provider" id="provider" aria-label="Default select example" required>
                                        <option selected>Pilih Provider</option>
                                        @foreach ($provider as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_provider }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">
                                        <strong>
                                            Harga
                                        </strong>
                                    </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="harga" name="harga" aria-describedby="harga" value="Rp. 0" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="kecepatan" class="form-label">
                                        <strong>
                                            Kecepatan Internet
                                        </strong>
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="kecepatan" name="kecepatan" aria-label="kecepatan" aria-describedby="kecepatan2" required>
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
    // Ambil elemen input harga
    const inputHarga = document.getElementById('harga');

    // Tambahkan event listener untuk event input
    inputHarga.addEventListener('input', function() {
        // Ambil nilai yang dimasukkan oleh pengguna
        let nilai = this.value.replace(/\D/g, ''); // Hapus semua karakter non-digit dari nilai

        // Ubah nilai menjadi format mata uang yang sesuai
        nilai = formatRupiah(nilai);

        // Set nilai baru pada input harga
        this.value = nilai;
    });

    // Fungsi untuk mengubah nilai menjadi format mata uang Rupiah
    function formatRupiah(nilai) {
        return 'Rp. ' + new Intl.NumberFormat('id-ID').format(nilai);
    }
</script>
@endpush