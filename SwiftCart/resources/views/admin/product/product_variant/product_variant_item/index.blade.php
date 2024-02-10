@extends('admin.layout.master')
@section('title', 'product variant item')
@section('content')
    <section class="section">
        <h1 class="fw-normal bg-white ps-4 py-3">Product Variant Item</h1>
        <div class="section-body my-4 container-fluid">
            <a href="{{ route('admin.product_variant.index', ['id' => $product_variant->product->id]) }}"
                class="btn btn-info ml-3 mb-3"><i class="fa-solid fa-left-long"></i></a>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="fw-normal">Product: {{ $product_variant->product->name }}</h5>
                    <a href = "{{ route('admin.product_variant_item.create', ['variant_id' => $product_variant->id]) }}"
                        class="btn btn-primary me-1"><i class="fa-solid fa-plus me-1"></i>Add Variant Item</a>
                </div>
                <div class="card-body overflow-auto">
                    {{ $dataTable->table() }}
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

                var url = "{{ route('admin.product_variant_item.switch_status') }}"
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
