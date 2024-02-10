@extends('admin.layout.master')
@section('title', 'about')
@section('content')
    <section>
        <h1 class="fw-normal bg-white ps-4 py-3">About</h1>
        <div class="section-body my-4 container-fluid">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.about.update') }}">
                        @csrf
                        @method('put')
                        <textarea name="content" class='summernote' id="" placeholder = 'About...'>
                        {{ @$about->content }}
                    </textarea>
                        @error('content')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @push('styles')
        <style>
            .note-editable {}
        </style>
    @endpush
@endsection
