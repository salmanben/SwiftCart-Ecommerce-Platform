@extends('admin.layout.master')
@section('title', 'contact')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3">Contact</h1>
    <div class="section-body my-4 container-fluid">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5 class="fw-normal">All Contacts</h5>
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

