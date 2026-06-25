@extends('backend.layouts.main')
@section('title', 'Admin - Feedback - index')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0 fw-bold text-secondary">User Feedback</h5>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="feedbackTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name<br>(Email)</th>
                            <th>Phone<br>Number</th>
                            <th>subject</th>
                            <th>message</th>
                            <th>Created At</th>
                            <th width="220">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name<br>(Email)</th>
                            <th>Phone<br>Number</th>
                            <th>subject</th>
                            <th>message</th>
                            <th>Created At</th>
                            <th width="220">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- JQuery Validation -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <!-- SweetAlert Cdn file -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap DataTabale Cdn file -->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <!-- Global Variable -->
    <script type="text/javascript">
        var listUrl = "{{ route('admin.feedback.index') }}";
        var globalCsrf = "{{ csrf_token() }}";
    </script>

    <script type="text/javascript" src="{{ asset('backend/js/admin/feedback/feedback.js') }}"></script>
@endpush
