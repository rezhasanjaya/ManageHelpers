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
                                <div class="mb-3">
                                <label for="tanggal_langganan" class="form-label">
                                    <strong>
                                        Tanggal Langganan
                                    </strong>
                                </label>
                                <input type="date" class="form-control" id="tanggal_langganan" name="tanggal_langganan" aria-describedby="tanggal_langganan" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input class="form-check-input" type="checkbox" id="pembayaran_check" name="pembayaran_check">
                                    <label class="form-check-label" for="pembayaran_check">
                                        Pembayaran sudah dilakukan
                                    </label>
                                </div>
                
                                <!-- Input tanggal pembayaran (default: hidden) -->
                                <div class="mb-3" id="tanggal_pembayaran_wrapper" style="display: none;">
                                    <label for="tanggal_pembayaran" class="form-label">
                                        <strong>
                                            Tanggal Pembayaran
                                        </strong>
                                    </label>
                                    <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran" aria-describedby="tanggal_pembayaran">
                                </div>
                                <div class="row mt-3">
                                    <div class="col mt-3"> 
                                        <a href="{{ route('paket.index') }}" data-toggle="tooltip" data-original-title="Edit" class="btn float-end btn-sm btn-secondary">Kembali</a>
                                    </div>
                                    <div class="col-md-2 mt-3">
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
    // Ambil elemen checkbox
    const pembayaranCheck = document.getElementById('pembayaran_check');
    // Ambil wrapper input tanggal pembayaran
    const tanggalPembayaranWrapper = document.getElementById('tanggal_pembayaran_wrapper');
    // Ambil input tanggal pembayaran
    const tanggalPembayaranInput = document.getElementById('tanggal_pembayaran');

    // Tambahkan event listener untuk event click pada checkbox
    pembayaranCheck.addEventListener('click', function() {
        // Jika checkbox dicentang, tampilkan input tanggal pembayaran; jika tidak, sembunyikan
        if (this.checked) {
            tanggalPembayaranWrapper.style.display = 'block';
            tanggalPembayaranInput.required = true; // Tambahkan atribute required
        } else {
            tanggalPembayaranWrapper.style.display = 'none';
            tanggalPembayaranInput.required = false; // Hapus atribute required
        }
    });
</script>
@endpush