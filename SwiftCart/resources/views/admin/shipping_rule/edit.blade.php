@extends('admin.layout.master')
@section('title', 'shipping rule | edit')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3">Shipping Rule</h1>
    <div class="section-body my-4 container-fluid">
      <div class="col-12  col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="fw-normal">Update Shipping Rule</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.shipping_rule.update', $shipping_rule->id) }}" method="post" >
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="">Name</label>
                    <input type="text" class="form-control shadow-none"  name="name" value = "{{$shipping_rule->name}}"
                    placeholder="name" id="">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Type</label>
                    <select class="form-select form-control shadow-none shipping-type" name="type" aria-label="Default select example">
                        <option @selected($shipping_rule->type == 'flat_cost') value="flat_cost">Flat Cost</option>
                        <option  @selected($shipping_rule->type == 'min_cost') value="min_cost">Minimum Order Amount</option>
                    </select>
                    @error('type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3  d-none min-cost-field">
                    <label class="">Min Cost({{$currency_icon}})</label>
                    <input type="text" class="form-control shadow-none"  name="min_cost" value = "{{$shipping_rule->min_cost}}"
                    placeholder="min cost" id="">
                    @error('min_cost')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Cost({{$currency_icon}})</label>
                    <input type="text" class="form-control shadow-none"  name="cost" value = "{{$shipping_rule->cost}}"
                    placeholder="cost" id="">
                    @error('cost')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Status</label>
                    <select class="form-select form-control shadow-none" name="status" aria-label="Default select example">
                        <option @selected($shipping_rule->status == 1) value="1">Active</option>
                        <option @selected($shipping_rule->status == 0) value="0">Inactive</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>

          </div>
        </div>
      </div>
    </div>

  </section>


  <script>
    var shippingType = document.querySelector('.shipping-type')
    var minCostField = document.querySelector(".min-cost-field")
    if (shippingType.value == 'min_cost')
            minCostField.classList.remove('d-none')
    shippingType.onchange = ()=>{
        if (shippingType.value == 'min_cost')
            minCostField.classList.remove('d-none')
        else
        {
            minCostField.classList.add('d-none')
            minCostField.querySelector('input').value = null
        }

    }
</script>

@endsection
