@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3"><strong>{{ $title }}</strong></h4>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form action="{{ route('pembayaran.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_billing" id="id_billing" value="{{ $bill->id }}"></input>
                                <div class="mb-3">
                                    <label for="customer" class="form-label">
                                        <strong>
                                            Customer
                                        </strong>
                                    </label>
                                    <select class="form-select" name="customer" id="customer" aria-label="Default select example" disabled>
                                        <option selected disabled>Pilih Customer</option>
                                        @foreach ($cust as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $bill->id_customer ? 'selected' : '' }}>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="paket" class="form-label">
                                        <strong>
                                            Paket
                                        </strong>
                                    </label>
                                    <select class="form-select" name="paket" id="paket" aria-label="paket" disabled required>
                                        <option selected disabled>Pilih Paket</option>
                                        @foreach ($paket as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $bill->id_paket ? 'selected' : '' }}>
                                                {{ $item->nama_paket }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_pembayaran" class="form-label">
                                        <strong>
                                            Tanggal Pembayaran
                                        </strong>
                                    </label>
                                    <input type="date" class="form-control" id="tanggal_pembayaran" name="tanggal_pembayaran" aria-describedby="tanggal_pembayaran" required>
                                </div>

                                <div class="row">
                                    <div class="col"> 
                                        <a href="{{ route('billing.index') }}" data-toggle="tooltip" data-original-title="Edit" class="btn float-end btn-sm btn-secondary">Kembali</a>
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
    <!-- Tambahkan script di sini jika diperlukan -->
@endpush
