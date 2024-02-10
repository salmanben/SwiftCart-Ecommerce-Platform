@extends('admin.layout.master')
@section('title', 'flash sale')
@section('content')
    <section>
        <h1 class="fw-normal bg-white ps-4 py-3">Flash Sale</h1>
        <div class="section-body my-4 container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="">Flash Sale End Date</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.flash_sale.save_end_date') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('put')
                        <div class="col-6 col-md-3 mb-3">
                            <img class="img-fluid rounded" src="{{$flash_sale != null && empty(!$flash_sale->background)  ? asset('storage/upload/' . $flash_sale->background) : asset('site_image/flash_sale.jpg') }}"
                                alt="banner">
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control shadow-none" name="background" id="">
                            @error('background')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="date" class="form-control shadow-none"
                                value="{{ optional($flash_sale)->end_date }}" name="end_date" id="">
                            @error('end_date')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="text-body">Flash Sale Item</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.flash_sale.store') }}" method="post"> @csrf <div class="mb-3">
                            <label>Add Product</label>
                            <select class="form-control shadow-none selectric" tabindex="-1" name="product">
                                <option value="">Select</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select> @error('product')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Show At Home</label>
                            <select class="form-select form-control shadow-none " name="show_at_home"
                                aria-label="Default select example">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">Non</option>
                            </select> @error('show_at_home')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Status</label>
                            <select class="form-select form-control shadow-none" name="status"
                                aria-label="Default select example">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </form>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="">All Flash Sale Items</h5>
                </div>
                <div class="card-body overflow-auto">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>



    </section>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

        <!-- Switch show at home Status -->
        <script>
            function switch_show_home(event) {
                var id = event.currentTarget.getAttribute('id');
                var checked = event.currentTarget.checked == true ? 1 : 0

                var url =
                    "{{ route('admin.flash_sale.switch_show_at_home_status') }}"
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

            };
        </script>

        <!-- Switch Status -->
        <script>
            function switch_status(event) {
                var id = event.currentTarget.getAttribute('id');
                var checked = event.currentTarget.checked == true ? 1 : 0

                var url = "{{ route('admin.flash_sale.switch_status') }}"
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
