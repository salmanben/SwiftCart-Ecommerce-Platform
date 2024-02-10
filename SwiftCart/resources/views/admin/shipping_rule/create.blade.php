@extends('admin.layout.master')
@section('title', 'shipping rule | create')
@section('content')
    <section class="section">
        <h1 class="fw-normal bg-white ps-4 py-3">Shipping Rule</h1>
        <div class="section-body my-4 container-fluid">
            <div class="col-12  col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-normal">Create Shipping Rule</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.shipping_rule.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="">Name</label>
                                <input type="text" class="form-control shadow-none" name="name"
                                    value = "{{ old('name') }}" placeholder="name" id="">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Type</label>
                                <select class="form-select form-control shadow-none shipping-type" name="type"
                                    aria-label="Default select example">
                                    <option @selected(old('type') == 'flat_cost') value="flat_cost">Flat Cost</option>
                                    <option @selected(old('type') == 'min_cost') value="min_cost">Minimum Order Amount</option>
                                </select>
                                @error('type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 d-none min-cost-field">
                                <label class="">Min Cost({{ $currency_icon }})</label>
                                <input type="text" class="form-control shadow-none" name="min_cost"
                                    value = "{{ old('min_cost') }}" placeholder="min cost" id="">
                                @error('min_cost')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="">Cost({{ $currency_icon }})</label>
                                <input type="text" class="form-control shadow-none" name="cost"
                                    value = "{{ old('cost') }}" placeholder="cost" id="">
                                @error('cost')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Status</label>
                                <select class="form-select form-control shadow-none" name="status"
                                    aria-label="Default select example">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">Create</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            var shippingType = document.querySelector('.shipping-type')
            var minCostField = document.querySelector(".min-cost-field")
            @if ($errors->any('type'))
               minCostField.classList.remove("d-none")
            @endif
            shippingType.onchange = () => {
                if (shippingType.value == 'min_cost')
                    minCostField.classList.remove('d-none')
                else {
                    minCostField.classList.add('d-none')
                    minCostField.querySelector('input').value = null
                }

            }
        </script>
    @endpush

@endsection
