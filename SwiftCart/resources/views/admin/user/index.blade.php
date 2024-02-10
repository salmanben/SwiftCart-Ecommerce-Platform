@extends('admin.layout.master')
@section('title', 'user')
@section('content')
    <section class="section">
        <h1 class="fw-normal bg-white ps-4 py-3 mb-4">User</h1>
        <div class="section-body py-4 px-2 px-md-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        @if (str_ends_with(request()->url(), 'customer'))
                            <h5>All Customers</h5>
                        @elseif (str_ends_with(request()->url(), 'vendor'))
                            <h5>All Approved Vendors</h5>
                        @else
                            <h5>All Admins</h5>
                        @endif
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
                var element = event.currentTarget
                var status = element.checked == true ? 'active' : 'inactive';
                var url = "{{ route('admin.user.switch_status') }}";
                fetch(url, {
                        method: 'PUT',
                        body: JSON.stringify({
                            id: id,
                            status: status
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
                            );
                        } else if (data.status == 'error') {
                            element.checked ? element.checked = false : element.checked = true;
                            Swal.fire(
                                'Error',
                                data.message
                            );
                        }
                    })
                    .catch(function(error) {
                        Swal.fire(
                            'Error',
                            "Can't be changed!"
                        );
                    });


            }
        </script>
    @endpush




@endsection
