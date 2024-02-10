@extends('admin.layout.master')
@section('title', 'coupon | edit')
@section('content')
<section class="section">
    <h1 class="fw-normal bg-white ps-4 py-3">Coupon</h1>
    <div class="section-body my-4 container-fluid">
        <div class="card col-12 col-md-6">
          <div class="card-header">
            <h5 class="fw-normal">Update Coupon</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label >Name</label>
                    <input type="text" class="form-control shadow-none"  name="name" value = "{{$coupon->name}}"
                    placeholder="name" id="">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Code</label>
                    <input type="text" class="form-control shadow-none"  name="code" value = "{{$coupon->code}}"
                    placeholder="code" id="">
                    @error('code')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Quantity</label>
                    <input type="number" class="form-control shadow-none"  name="quantity" value = "{{$coupon->quantity}}"
                    placeholder="quantity" id="">
                    @error('quantity')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Max use per person</label>
                    <input type="number" class="form-control shadow-none"  name="max_use" value = "{{$coupon->max_use}}"
                    placeholder="max use" id="">
                    @error('max_use')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="">Discount Type</label>
                            <select class="form-select form-control shadow-none" name="discount_type" aria-label="Default select example">
                                <option value="">Select</option>
                                <option @selected($coupon->discount_type == 'amount') value="amount">Amount({{$currency_icon}})</option>
                                <option @selected($coupon->discount_type == 'percentage') value="percentage">Percentage(%)</option>
                            </select>
                            @error('discount_type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label >Discount Value</label>
                            <input type="number" class="form-control shadow-none" min=0  name="discount" value = "{{$coupon->discount}}"
                            placeholder="discount value" id="">
                            @error('discount')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label >Start Date</label>
                            <input type="date" class="form-control shadow-none" name="start_date" value="{{ $coupon->start_date }}" placeholder="start date">
                            @error('start_date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label >End Date</label>
                            <input type="date" class="form-control shadow-none" name="end_date" value="{{ $coupon->end_date }}" placeholder="end date">
                            @error('end_date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="">Status</label>
                    <select class="form-select form-control shadow-none" name="status" aria-label="Default select example">
                        <option @selected($coupon->status == 1) value="1">Active</option>
                        <option @selected($coupon->status == 0) value="0">Inactive</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>

          </div>
        </div>
    </div>

  </section>
@endsection
