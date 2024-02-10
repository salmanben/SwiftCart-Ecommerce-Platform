<form action="{{ route('admin.home_setting.update_footer_info') }}" method="post"  class="col-12 col-lg-8">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label >Email</label>
        <input type="email" class="form-control shadow-none"  name="email" value = "{{@$footer_info->email}}"
        placeholder="contact email" id="">
        @error('email')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label >Phone</label>
        <input type="text" class="form-control shadow-none"  name="phone" value = "{{@$footer_info->phone}}"
        placeholder="phone" id="">
        @error('phone')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label >Address</label>
        <input type="text" class="form-control shadow-none"  name="address" value = "{{@$footer_info->address}}"
        placeholder="address" id="">
        @error('address')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label >CopyRight</label>
        <input type="text" class="form-control shadow-none"  name="copyright" value = "{{@$footer_info->copyright}}"
        placeholder="copyright" id="">
        @error('copyright')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="facebook">Facebook</label>
        <input type="url" class="form-control shadow-none" name="facebook" value="{{ @$footer_info->facebook }}" placeholder="Facebook" id="facebook">
        @error('facebook')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="twitter">Twitter</label>
        <input type="url" class="form-control shadow-none" name="twitter" value="{{ @$footer_info->twitter }}" placeholder="Twitter" id="twitter">
        @error('twitter')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="whatsapp">WhatsApp</label>
        <input type="url" class="form-control shadow-none" name="whatsapp" value="{{ @$footer_info->whatsapp }}" placeholder="WhatsApp" id="whatsapp">
        @error('whatsapp')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="instagram">Instagram</label>
        <input type="url" class="form-control shadow-none" name="instagram" value="{{ @$footer_info->instagram }}" placeholder="Instagram" id="instagram">
        @error('instagram')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
</form>
