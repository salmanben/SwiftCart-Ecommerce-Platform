@extends('frontend.dashboard.layout.master')
@section('title', 'address')
@section('content')
    <section>
        <h3 class="shadow-sm bg-white ps-4 py-3"><i class="fa-solid fa-address-book me-2"></i>Address</h3>

        <div class="section-body my-4 container-fluid">
            <div class="col-12">
                <a href="{{ route('user.address.create') }}" class="btn btn-primary"><i class="far fa-plus"></i>
                    add new address
                </a>
            </div>
            <div class="row mt-3">
                @foreach ($addresses as $address)
                    <div class=" col-12 col-lg-6 mb-3">
                        <div class="card" style="min-height: 400px">
                            <div class="card-header">
                                <h6>Billing Address <span>office</span></h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2 "><span class="text-info fs-5">name :</span> {{ $address->name }}</li>
                                    <li class="mb-2 "><span class="text-info fs-5"> Phone :</span> {{ $address->phone }}
                                    </li>
                                    <li class="mb-2 "><span class="text-info fs-5">email :</span> {{ $address->email }}
                                    </li>
                                    <li class="mb-2 "><span class="text-info fs-5">country :</span> {{ $address->country }}
                                    </li>
                                    <li class="mb-2 "><span class="text-info fs-5">city :</span> {{ $address->city }}</li>
                                    <li class="mb-2 "><span class="text-info fs-5">zip code :</span> {{ $address->zip }}
                                    </li>
                                    <li class="mb-2 "><span class="text-info fs-5">address :</span> {{ $address->address }}
                                    </li>
                                </ul>
                                <div class="">
                                    <a href="{{ route('user.address.edit', $address->id) }}" class="btn btn-primary"><i
                                            class="fa-solid fa-pen-to-square me-1"></i> edit</a>
                                    <a href="{{ route('user.address.destroy', $address->id) }}"
                                        class="delete-item btn btn-danger ms-3"><i class="fa-solid fa-trashme-1"></i>
                                        delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('scripts')
        <!-- Delete -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(() => {
                    var deleteButtons = document.querySelectorAll('.delete-item');

                    deleteButtons.forEach(function(button) {
                        button.addEventListener('click', function(event) {
                            event.preventDefault();
                            var url = this.getAttribute('href');
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    fetch(url, {
                                            method: 'DELETE',
                                            headers: {
                                                'X-CSRF-TOKEN': $(
                                                        'meta[name="csrf-token"]')
                                                    .attr('content')
                                            }

                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            if (data.status == 'success') {
                                                button.parentNode.parentNode
                                                    .parentNode.parentNode.remove()

                                                Swal.fire(
                                                    'Deleted!',
                                                    data.message

                                                )


                                            } else if (data.status == 'error') {
                                                Swal.fire(
                                                    'Error',
                                                    data.message

                                                )
                                            }

                                        })
                                        .catch(function(error) {
                                            Swal.fire(
                                                'Error',
                                                "Can't be deleted!"
                                            )
                                        });
                                }
                            });
                        });
                    });
                }, 2000);
            });
        </script>
    @endpush
@endsection
