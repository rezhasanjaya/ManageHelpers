@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3"><strong>{{ $title }}</strong></h4>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form action="{{ route('billing.update', $bill->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="customer" class="form-label">
                                        <strong>
                                            Customer
                                        </strong>
                                    </label>
                                    <select class="form-select" name="customer" id="customer" aria-label="Default select example" required>
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
                                    <select class="form-select" name="paket" id="paket" aria-label="paket" required>
                                        <option selected disabled>Pilih Paket</option>
                                        @foreach ($paket as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $bill->id_paket ? 'selected' : '' }}>
                                                {{ $item->nama_paket }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_langganan" class="form-label">
                                        <strong>
                                            Tanggal Langganan
                                        </strong>
                                    </label>
                                    <input type="date" class="form-control" id="tanggal_langganan" name="tanggal_langganan" aria-describedby="tanggal_langganan" value="{{ $bill->tanggal_langganan }}" required>
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
