<form action="{{ route('admin.banner.update_home_banner_section_three') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <p class="mb-1">banner 1</p>
        @if (@$home_banner_section_three->banner1->image)
             <div class="col-4 col-md-3 mb-3" >
                <img src="{{asset('storage/upload/'.$home_banner_section_three->banner1->image)}}" class="img-fluid rounded" alt="">
             </div>
        @endif
        <div class="d-lg-flex gap-4">
            <input type="hidden" name="old_image_banner_1" value="{{@$home_banner_section_three->banner1->image}}">
            <input type="file"  name="banner_1" class="form-control shadow-none mb-2 mb-lg-0" id="">
            <input type="url" placeholder="url" name="url_1" value="{{@$home_banner_section_three->banner1->url}}" required class="form-control shadow-none mb-2 mb-lg-0" id="">
            <select name="status_1" id="" class="form-control shadow-none">
                <option @selected(@$home_banner_section_three->banner1->status == 1) value="1">Active</option>
                <option @selected(@$home_banner_section_three->banner1->status == 0) value="0">Inactive</option>
            </select>
        </div>
    </div>
    <div class="mb-3">
        <p class="mb-1">banner 2</p>
        @if (@$home_banner_section_three->banner2->image)
             <div class="col-4 col-md-3 mb-3" >
                <img src="{{asset('storage/upload/'.$home_banner_section_three->banner2->image)}}" class="img-fluid rounded" alt="">
             </div>
        @endif
        <div class="d-lg-flex gap-4">
            <input type="hidden" name="old_image_banner_2" value="{{@$home_banner_section_three->banner2->image}}">
            <input type="file"  name="banner_2" class="form-control shadow-none mb-2 mb-lg-0" id="">
            <input type="url" placeholder="url" name="url_2" value="{{@$home_banner_section_three->banner2->url}}" required class="form-control shadow-none mb-2 mb-lg-0" id="">
            <select name="status_2" id="" class="form-control shadow-none">
                <option @selected(@$home_banner_section_three->banner2->status == 1) value="1">Active</option>
                <option @selected(@$home_banner_section_three->banner2->status == 0) value="0">Inactive</option>
            </select>
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
</form>
