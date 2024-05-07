@extends('layouts.app')
 
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3"><strong>{{ $title }}</strong></h4>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form action="{{ route('customers.update', $cust->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="nama" class="form-label">
                                        <strong>Nama Customer</strong>
                                    </label>
                                    <input type="text" class="form-control" id="nama" name="nama" aria-describedby="nama" value="{{ $cust->nama }}" required>
                                    @error('nama')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        <strong>Email</strong>
                                    </label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="{{ $cust->email }}" required>
                                    </div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="no_telp" class="form-label">
                                        <strong>Nomor Telepon</strong>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="no_telp" name="no_telp" value="{{ $cust->telp }}" aria-describedby="no_telp" required>
                                    </div>
                                    @error('no_telp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">
                                        <strong>Alamat</strong>
                                    </label>
                                    <textarea class="form-control" name="alamat" id="alamat" rows="4">{{ $cust->alamat }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col"> 
                                        <a href="{{ route('customers.index') }}" data-toggle="tooltip" data-original-title="Edit" class="btn float-end btn-sm btn-secondary">Kembali</a>
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

</script>
@endpush