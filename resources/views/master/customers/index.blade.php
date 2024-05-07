@extends('layouts.app')
 
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3"><strong>{{ $title }}</strong></h4>
                @if (session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <div>
                        {{ session('success') }}
                    </div>
                </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection
 
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush