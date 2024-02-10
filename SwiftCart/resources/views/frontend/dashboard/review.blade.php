@extends('frontend.dashboard.layout.master')
@section('title', 'review')
@section('content')

    <section>
        <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-bag-shopping me-2"></i>Review</h3>
        <div class="section-body my-4 container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="fw-normal">All reviews</h5>
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
