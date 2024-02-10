@extends('admin.layout.master')
@section('title', 'vendor request | details')
@section('content')
    <section class="section">
        <h1 class="fw-normal bg-white ps-4 py-3">Vendor Request</h1>
        <div class="section-body my-4 container-fluid">
            <div class="px-sm-3 py-3 px-2 shadow-sm rounded border">
                <div class="content">
                    <div>
                        <h5 class=""><span class="me-2 mb-1">Id: <span>{{ $vendor_request->id }}</span></span>

                        </h5>
                    </div>
                    <div  class="col-4">
                        <img src="{{asset('storage/upload/'.$vendor_request->banner)}}" class="img-fluid rounded" alt="banner">
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 col-md-6">
                            <p class="text-body">Name: <span class="text-muted">{{$vendor_request->user->name}}</span></p>
                            <p class="text-body">Description: <span class="text-muted">{!! $vendor_request->description !!}</span></p>

                        </div>
                        <div class="col-12 col-md-6 text-start text-md-end">
                            <p class="text-body">Shop: <span class="text-muted">{{$vendor_request->shop_name}}</span></p>
                            <p class="text-body">Email: <span class="text-muted">{{$vendor_request->email}}</span></p>
                            <p class="text-body">Phone: <span class="text-muted">{{$vendor_request->phone}}</span></p>
                            <p class="text-body">Address: <span class="text-muted">{{$vendor_request->address}}</span></p>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center mt-3">
                    <div class="me-2 d-flex gap-3">
                        <form action="{{route('admin.vendor_request.update', $vendor_request->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary">Approve</button>
                        </form>
                        <form action="{{route('admin.vendor_request.destroy', $vendor_request->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                    <button class="btn btn-warning text-white print" style=""><i
                            class="fa-solid fa-print me-2 text-white"></i>print</button>
                </div>
            </div>
        </div>
    </section>
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


@endsection
