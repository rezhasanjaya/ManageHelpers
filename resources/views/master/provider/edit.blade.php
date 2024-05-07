@extends('layouts.app')
 
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3"><strong>{{ $title }}</strong></h4>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <form action="{{ route('provider.update', $provider->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                <label for="nama_provider" class="form-label">
                                    <strong>
                                        Nama Provider
                                    </strong>
                                </label>
                                <input type="text" class="form-control" id="nama_provider" name="nama_provider" aria-describedby="nama_provider" required value="{{ $provider->nama_provider }}">
                                </div>
                                <div class="row">
                                    <div class="col"> 
                                        <a href="{{ route('provider.index') }}" data-toggle="tooltip" data-original-title="Edit" class="btn float-end btn-sm btn-secondary">Kembali</a>
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

@endpush