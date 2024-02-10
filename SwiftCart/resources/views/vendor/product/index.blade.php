@extends('vendor.layout.master')
@section('title', 'product')
@section('content')
    <section class="section">
        <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-cart-shopping me-2"></i>Product</h3>
        <div class="section-body my-4 container-fluid">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="fw-normal">All products</h5>
                        <a href = "{{ route('vendor.product.create') }}" class="btn btn-primary"><i
                                class="fa-solid fa-plus me-1"></i>Add Product</a>
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
        <!-- Switch Status -->
        <script>
            function switch_status(event) {
                var id = event.currentTarget.getAttribute('id');
                var checked = event.currentTarget.checked == true ? 1 : 0

                var url = "{{ route('vendor.product.switch_status') }}"
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
