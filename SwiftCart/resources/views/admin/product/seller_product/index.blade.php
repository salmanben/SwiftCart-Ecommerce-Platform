@extends('admin.layout.master')
@section('title', 'seller product')
@section('content')
    <section class="section">
        <h1 class="fw-normal bg-white ps-4 py-3">Seller Product</h1>
        <div class="section-body my-4 container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="fw-normal">Products</h5>
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

        <!-- Switch approve -->
        <script>
            function switch_approve(event) {
                var id = event.currentTarget.getAttribute('id');
                var selected = event.currentTarget.value
                var url = "{{ route('admin.seller_products.switch_approve') }}"
                var tr = event.currentTarget.parentNode.parentNode
                fetch(url, {
                        method: 'PUT',
                        body: JSON.stringify({
                            id: id,
                            selected: selected
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        }

                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status == 'success') {

                            Swal.fire(
                                'Changed',
                                data.message

                            )
                            var route = "{{ Route::currentRouteName() }}"
                            if (route.includes('pending_products'))
                                tr.remove()

                        }

                    })
                    .catch(function(error) {
                        Swal.fire(
                            'Error',
                            "Can't be changed!"
                        )
                    });


            }
        </script>

        <!-- Switch Status -->
        <script>
            function switch_status(event) {
                var id = event.currentTarget.getAttribute('id');
                var checked = event.currentTarget.checked == true ? 1 : 0

                var url = "{{ route('admin.seller_products.switch_status') }}"
                fetch(url, {
                        method: 'PUT',
                        body: JSON.stringify({
                            id: id,
                            checked: checked
                        }),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
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
                    });


            }
        </script>
    @endpush

@endsection
