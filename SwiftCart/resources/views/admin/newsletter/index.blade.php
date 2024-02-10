@extends('admin.layout.master')
@section('title', 'newsletter')
@section('content')
    <section>
        <h1 class="fw-normal bg-white ps-4 py-3">Newsletter</h1>
        <div class="section-body my-4 container-fluid">
            <div class="card mb-3 col-12 col-sm-6">
                <div class="card-header">
                    <h5 class="">Send Email To All Subscribers</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.newsletter_subscribers.send_email') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control shadow-none" value="{{ old('subject') }}" name="subject" id="subject">
                            @error('subject')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="message">Message</label>
                            <textarea class="form-control shadow-none" name="message" id="message" cols="30" rows="10" style="resize:none; height:100px">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Send</button>
                    </form>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="">All Subscribers</h5>
                </div>
                <div class="card-body overflow-auto">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
@endsection
