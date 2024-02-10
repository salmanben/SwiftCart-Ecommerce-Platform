@extends('vendor.layout.master')
@section('title', 'withdraw')
@section('content')

    <section class="section">
        <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-money-bill-transfer me-2"></i>Withdraw</h3>
        <div class="section-body container-fluid my-4">
            <div class="row mb-3 gy-3">
                <div class="col-12 col-md-6">
                    <div class="card-body rounded border bg-white d-flex">
                          <div style="background:#E24D4C" class="d-flex align-items-center justify-content-center rounded px-4 me-3">
                            <i class="fa-solid fa-money-bill-trend-up text-white" style="transform:scale(2)"></i>
                          </div>
                          <div>
                            <h5 class="text-body mb-2">Current Balance</h5>
                            <span class="text-muted fs-4">{{$currency_icon}}{{$current_balance}}</span>
                          </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card-body rounded border bg-white d-flex">
                        <div style="background:#E24D4C" class="d-flex align-items-center justify-content-center rounded px-4 me-3">
                          <i class="fa-solid fa-money-bill-trend-up text-white" style="transform:scale(2)"></i>
                        </div>
                        <div>
                          <h5 class="text-body mb-2">Total Withdraw + Charges</h5>
                          <span class="text-muted fs-4">{{$currency_icon}}{{$total_withdraw_with_charges}}</span>
                        </div>
                  </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="fw-normal">All withdraw Requests</h5>
                        <a href="{{route('vendor.withdraw.create')}}" class='btn btn-info btn-sm text-white'>Create Request</a>
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
