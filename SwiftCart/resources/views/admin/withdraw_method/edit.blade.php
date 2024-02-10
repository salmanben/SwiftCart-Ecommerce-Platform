@extends('admin.layout.master')
@section('title', 'withdraw method | edit')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3">Withdraw Method</h1>
    <div class="section-body my-4 container-fluid">
      <div class="col-12 col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="fw-normal">Update withdraw method</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.withdraw_method.update', $withdraw_method->id) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label class="">Name</label>
                    <input type="text" class="form-control shadow-none"  name="name" value = "{{$withdraw_method->name}}"
                    placeholder="name" id="">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Min amount({{$currency_icon}})</label>
                    <input type="text" min=0 class="form-control shadow-none"  name="min_amount" value = "{{$withdraw_method->min_amount}}"
                    placeholder="minimum amount" id="">
                    @error('min_amount')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Max amount({{$currency_icon}})</label>
                    <input type="text" min=0 class="form-control shadow-none"  name="max_amount" value = "{{$withdraw_method->max_amount}}"
                    placeholder="maximum amount" id="">
                    @error('max_amount')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="">Charge(%)</label>
                    <input type="text" min=0 class="form-control shadow-none"  name="charge" value = "{{$withdraw_method->charge}}"
                    placeholder="charge %" id="">
                    @error('charge')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Status</label>
                    <select class="form-select form-control shadow-none" name="status" aria-label="Default select example">
                        <option @selected($withdraw_method->status == 1) value="1">Active</option>
                        <option @selected($withdraw_method->status == 0)  value="0">Inactive</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>

          </div>
        </div>
      </div>
    </div>

  </section>




@endsection
