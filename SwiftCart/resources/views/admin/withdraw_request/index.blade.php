@extends('admin.layout.master')
@section('title', 'withdraw request')
@section('content')
    <section class="section">
        <h1 class="fw-normal bg-white ps-4 py-3">Withdraw Request</h1>
        <div class="section-body container-fluid my-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-normal">All Withdraw Requests</h5>
                    </div>
                    <div class="card-body overflow-auto">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    @endpush
@endsection
