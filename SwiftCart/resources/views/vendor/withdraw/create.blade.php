@extends('vendor.layout.master')
@section('title', 'withdraw request | create')
@section('content')
    <section class="section">
        <h3 class="shadow-sm bg-white  ps-4 py-3"><i class="fa-solid fa-money-bill-transfer me-2"></i>Withdraw</h3>
        <div class="section-body my-4 container-fluid">
            <div class="card col-12 col-md-7">
                <div class="card-header">
                    <h5 class="fw-normal">Create withdraw Request</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('vendor.withdraw.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="">Method</label>
                            <select name="method" class="form-control shadow-none" id="">
                                <option value="">Select</option>
                                @foreach ($withdraw_methods as $method)
                                    <option value="{{$method->name}}">{{$method->name}}(min amount: {{$currency_icon}}{{$method->min_amount}} | max amount: {{$currency_icon}}{{$method->max_amount}} | charge: %{{$method->charge}})</option>
                                @endforeach
                            </select>
                            @error('method')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Amount({{$currency_icon}})</label>
                            <input type="text" min=0 class="form-control shadow-none shadow-none" name="amount"
                                value="{{old('amount')}}" placeholder="amount">
                            @error('amount')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="">Account Informations</label>
                            <textarea class="form-control shadow-none summernote" placeholder="account informations" name="account_informations"id="">
                                   {{old('account_informations')}}
                            </textarea>
                            @error('account_informations')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </form>

                </div>
            </div>
        </div>

    </section>


@endsection
