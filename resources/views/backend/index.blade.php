@extends('backend.layouts.main')

@section('title', 'Dashboard')

@section('content')

<div class="row g-3">

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Total Users</h6>
                <h3>#</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Total Companies</h6>
                <h3>#</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">My Companies</h6>
                <h3>#</h3>
            </div>
        </div>
    </div>

</div>

@endsection
