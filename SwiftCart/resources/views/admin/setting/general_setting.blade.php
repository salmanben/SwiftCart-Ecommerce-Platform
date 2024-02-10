<form action="{{ route('admin.general_setting.update') }}" method="post" enctype="multipart/form-data"  class="col-12 col-lg-8">
    @csrf
    @method('PUT')
    @if (@$general_setting->logo)
        <div class="mb-2 col-2">
            <img src="{{asset('storage/upload/'.$general_setting->logo)}}" class="img-fluid" alt="">
        </div>
    @endif
    <div class="mb-3">
        <label >Site Logo</label>
        <input type="file" class="form-control shadow-none" name="logo" id="">
        @error('logo')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label >Site Name</label>
        <input type="text" class="form-control shadow-none"  name="site_name" value = "{{@$general_setting->site_name}}"
        placeholder="site name" id="">
        @error('site_name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label >Contact Email</label>
        <input type="email" class="form-control shadow-none"  name="contact_email" value = "{{@$general_setting->contact_email}}"
        placeholder="contact email" id="">
        @error('contact_email')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label >Contact Phone</label>
        <input type="text" class="form-control shadow-none"  name="contact_phone" value = "{{@$general_setting->contact_phone}}"
        placeholder="contact phone" id="">
        @error('contact_phone')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label >Currency Icon</label>
        <input type="text" class="form-control shadow-none"  name="currency_icon" value = "{{@$general_setting->currency_icon}}"
        placeholder="currency icon" id="">
        @error('currency_icon')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>


    <button class="btn btn-primary" type="submit">Save</button>
</form>
