@extends('admin.layout.master')
@section('title', 'review')
@section('content')
<section>
    <h1 class="fw-normal bg-white ps-4 py-3 mb-4">Review</h1>
    <div class="section-body my-4 container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="">All Reviews</h5>
        </div>
        <div class="card-body overflow-auto">
          {{ $dataTable->table() }}
        </div>
      </div>
    </div>
</section>

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
@endsection

