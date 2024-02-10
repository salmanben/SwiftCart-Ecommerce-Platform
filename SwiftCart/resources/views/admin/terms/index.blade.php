@extends('admin.layout.master')
@section('title', 'terms and conditions')
@section('content')
<section>
    <h1 class="fw-normal bg-white ps-4 py-3">Terms And Conditions</h1>
    <div class="section-body my-4 container-fluid">
        <div class="card">
           <div class="card-body">
            <form method="post" action="{{route('admin.terms.update')}}">
                @csrf
                @method('put')
                <textarea name="content" class='summernote' id="" cols="30" rows="10" placeholder = 'terms and conditions...'>
                    {{@$terms->content}}
                </textarea>
                @error('content')
                     <p class="text-danger">{{$message}}</p>
                @enderror
                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
            </form>
           </div>
        </div>
    </div>
  </section>
  <style>
    .note-editable{

        height: 200px !important;
    }
 </style>
@endsection
