@extends('layouts.app')
 
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3"><strong>{{ $title }}</strong></h4>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form action="{{ route('billing.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="customer" class="form-label">
                                        <strong>
                                            Customer
                                        </strong>
                                    </label>
                                    <select class="form-select" name="customer" id="customer" aria-label="Default select example" required>
                                        <option selected>Pilih Customer</option>
                                        @foreach ($cust as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="paket" class="form-label">
                                        <strong>
                                            Paket
                                        </strong>
                                    </label>
                                    <select class="form-select" name="paket" id="paket" aria-label="paket" required>
                                        <option selected>Pilih Paket</option>
                                        @foreach ($paket as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_paket }}</option>
                                        @endforeach
                                    </select>
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