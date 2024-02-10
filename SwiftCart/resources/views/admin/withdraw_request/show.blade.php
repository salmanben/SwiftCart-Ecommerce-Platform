@extends('admin.layout.master')
@section('title', 'withdraw request | details')
@section('content')
    <section class="section">
        <h1 class="fw-normal bg-white ps-4 py-3">Withdraw Request</h1>
        <div class="section-body my-4 container-fluid">
            <div class="col-12 col-md-6 content">
                <table class="table border table-striped ">
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
                                <p class="mb-0"><span>Vendor: </span><span class="fw-bold">{{$withdraw_request->vendor->user->name}}</span></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="mb-0"><span>Shop Name: </span><span class="fw-bold">{{ $withdraw_request->vendor->shop_name }}</span></p>
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
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-3">
                <div class="me-2">
                    <label for="" class="fw-bold fs-6">Request Status</label>
                    <select name="" id="" class="select form-control">
                            <option @selected($withdraw_request->status == 'pending') value="pending">pending</option>
                            <option @selected($withdraw_request->status == 'paid') value="paid">paid</option>
                            <option @selected($withdraw_request->status == 'decline') value="decline">decline</option>
                    </select>
                </div>
                <button class="btn btn-warning text-white print" style="position:relative;top:10px"><i
                        class="fa-solid fa-print me-2 text-white"></i>print</button>
            </div>
        </div>

    </section>

    @push('scripts')
        <!-- Switch Status -->
        <script>
            var select = document.querySelector('select');
            select.addEventListener('change', function(event) {
                var value = select.value
                var url = "{{ route('admin.withdraw_request.switch_status') }}";
                var id = "{{ $withdraw_request->id }}"
                fetch(url, {
                        method: 'PUT',
                        body: JSON.stringify({
                            value: value,
                            id: id
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }

                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status == 'success') {

                            Swal.fire(
                                'Changed',
                                data.message

                            )

                        }

                    })
                    .catch(function(error) {
                        Swal.fire(
                            'Error',
                            "Can't be changed!"
                        )
                        console.log(error)
                    });

            });
        </script>
        <!-- print -->
        <script>
            var printBtn = document.querySelector(".print");
            var content = document.querySelector(".content");

            printBtn.onclick = () => {
                var originalContent = document.body.innerHTML;
                document.body.innerHTML = content.innerHTML;
                window.print();
                document.body.innerHTML = originalContent;
            };
        </script>
    @endpush


@endsection
