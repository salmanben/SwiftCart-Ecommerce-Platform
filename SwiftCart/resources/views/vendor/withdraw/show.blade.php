@extends('vendor.layout.master')
@section('title', 'withdraw | show request')
@section('content')


<section class="section">
    <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-money-bill-transfer me-2"></i>Withdraw Request</h3>
    <div class="section-body container-fluid my-4">
        <div class="col-12 col-md-6">
            <table class="table border rounded table-striped ">
                <tbody>
                    <tr>
                        <td>
                            <p class="mb-0"><span>Withdraw Method: </span><span class="fw-bold">{{$withdraw_request->method}}</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="mb-0"><span>Total Amount: </span><span class="fw-bold">{{$currency_icon}}{{round($withdraw_request->amount + $withdraw_request->amount * $withdraw_request->charge / 100, 2)}}</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="mb-0"><span>Withdraw Amount: </span><span class="fw-bold">{{$currency_icon}}{{$withdraw_request->amount}}</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="mb-0"><span>Withdraw Charge: </span><span class="fw-bold">{{$currency_icon}}{{round($withdraw_request->amount * $withdraw_request->charge / 100, 2)}}</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="mb-0"><span>Charge: </span><span class="fw-bold">%{{$withdraw_request->charge}}</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="mb-0"><span>Status: </span><span class="fw-bold">{{$withdraw_request->status}}</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="mb-0"><span>Account Informations: </span><span class="fw-bold">{!! $withdraw_request->account_informations !!}</span></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="mb-0"><span>Date: </span><span class="fw-bold">{{$withdraw_request->created_at}}</span></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</section>

@endsection
