
<div class="mb-3 col-4">
  <img src="{{!empty($box_background) ? asset('storage/upload/'.$box_background) : asset('site_image/box.jpg')}}" class="img-fluid" alt="image">
</div>
<form action="{{ route('admin.home_setting.update_box_background') }}" enctype="multipart/form-data" method="post"  class="col-12 col-lg-8">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="">Box Background</label>
        <input type="file" name="box_background" id="">
        @error('box_background')
            <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
</form>
