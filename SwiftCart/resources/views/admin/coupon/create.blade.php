@extends('admin.layout.master')
@section('title', 'coupon | create')
@section('content')
<section>
    <h1 class="fw-normal bg-white ps-4 py-3">Coupon</h1>
    <div class="section-body my-4 container-fluid">
        <div class="card col-12 col-md-6">
          <div class="card-header">
            <h5 class="fw-normal">Create Coupon</h5>
          </div>
          <div class="card-body">
            <form action="{{ route('admin.coupon.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label >Name</label>
                    <input type="text" class="form-control shadow-none shadow-none"  name="name" value = "{{old('name')}}"
                    placeholder="name" id="">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Code</label>
                    <input type="text" class="form-control shadow-none"  name="code" value = "{{old('code')}}"
                    placeholder="code" id="">
                    @error('code')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Quantity</label>
                    <input type="number" class="form-control shadow-none"  name="quantity" value = "{{old('quantity')}}"
                    placeholder="quantity" id="">
                    @error('quantity')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label >Max use per person</label>
                    <input type="number" class="form-control shadow-none"  name="max_use" value = "{{old('max_use')}}"
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
                                <option value="amount">Amount({{$currency_icon}})</option>
                                <option value="percentage">Percentage(%)</option>
                            </select>
                            @error('discount_type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label >Discount Value</label>
                            <input type="number" value="{{old("discount")}}" class="form-control shadow-none" min=0  name="discount"
                            placeholder="discount" id="">
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
                            <input type="date" class="form-control shadow-none" name="start_date" value="{{ old('start_date') }}" placeholder="start date">
                            @error('start_date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label >End Date</label>
                            <input type="date" class="form-control shadow-none" name="end_date" value="{{ old('end_date') }}" placeholder="end date">
                            @error('end_date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="">Status</label>
                    <select class="form-select form-control shadow-none" name="status" aria-label="Default select example">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>

          </div>
        </div>
    </div>

  </section>




@endsection
