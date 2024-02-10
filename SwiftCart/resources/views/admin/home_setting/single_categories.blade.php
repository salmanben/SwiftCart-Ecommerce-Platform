<form action="{{ route('admin.home_setting.update_single_categories') }}" class="update_single_categories_form"
    method="post" class="col-12 col-lg-8">
    @csrf
    @method('PUT')
    <div class="d-flex flex-wrap mb-4">
        @foreach ($categories as $category)
            <div class="my-2 mx-3 d-flex align-items-center">
                <input type="checkbox" @checked(in_array($category->id, $single_categories)) name="category[]" value="{{ $category->id }}"
                    id="{{ $category->name }}">
                <label for="{{ $category->name }}" class="form-label ms-2 fs-5"
                    style="position: relative; top:3px">{{ $category->name }}</label>
            </div>
        @endforeach
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
</form>
@push('scripts')
    <script>
        var update_single_categories_form = document.querySelector('.update_single_categories_form')
        var checkbox_single_categories = update_single_categories_form.querySelectorAll('input[type="checkbox"]');
        update_single_categories_form.onsubmit = (e) => {
            e.preventDefault()
            var count = 0;
            checkbox_single_categories.forEach(e => {
                if (e.checked == true)
                    count++;
            });
            if (count == 0)
                toastr.error("You must select at least one category")
            else if (count > 3)
                toastr.error("You can't select more than  3 categories")
            else
                update_single_categories_form.submit()
        }
    </script>
@endpush
