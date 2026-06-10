@extends('frontend.layouts.main')
@section('title', 'Home')
@push('css')

@endpush
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body text-center py-5">
        <h1 class="fw-bold">Welcome to Company Rating System</h1>
        <p class="text-muted">Rate companies and view company ratings.</p>
        <a href="#"class="btn btn-primary">Browse Companies</a>
    </div>
</div>
@endsection
@push('js')

@endpush
