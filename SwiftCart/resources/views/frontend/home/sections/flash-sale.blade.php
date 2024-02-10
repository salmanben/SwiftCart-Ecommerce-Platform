@php
    $flash_sale = App\models\FlashSale::first();

@endphp
@if (@$flash_sale->end_date > date('Y-m-d'))

    <section class="flash-sale my-4">

        <div class="banner py-4 px-2 px-md-4 rounded"
            style="background-image:url('{{ @$flash_sale->background ? asset('storage/upload/' . @$flash_sale->background) : asset('site_image/flash_sale.jpg') }}')">
            <div class="d-flex flex-column flex-lg-row  justify-content-between align-items-center">
                <div class="">
                    <h1 class="text-white">Flash Sale</h1>
                </div>
                <div class="counter d-flex  my-3">
                    <div class="text-center">
                        <p class="text-white fs-1 day"></p>
                        <span class="text-white">Days</span>
                    </div>
                    <div class="text-center">
                        <p class="text-white fs-1  hour"></p>
                        <span class="text-white">Hours</span>
                    </div>
                    <div class="text-center">
                        <p class="text-white fs-1  minute"></p>
                        <span class="text-white">Minutes</span>
                    </div>
                    <div class="text-center">
                        <p class="text-white fs-1  second"></p>
                        <span class="text-white">Seconds</span>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('flash_sale') }}" class="btn btn-primary rounded">See More <i
                            class="fa-solid fa-caret-right ms-2"></i></a>
                </div>
            </div>
        </div>
        <div class="products mt-3">
            <div class="swiper swiper-flash-sale">
                <div class="swiper-wrapper">
                    @php
                        $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')
                        ->where('status',1)
                        ->where('quantity', '>', 0)
                        ->with(['category','product_variants', 'category', 'product_images_gallery', 'product_variants.product_variant_items'])->whereIn('id', $flash_sale_items)->get();
                    @endphp
                    @foreach ($products as $product)
                        <div class="swiper-slide ">
                            <x-product-card :product="$product"/>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>
    @push('scripts')
        <!-- counter -->
        <script>
            /**  Start Counter  **/
            var endDate = new Date("{{@$flash_sale->end_date }}").getTime();
            var d = new Date()
            var curDate = d.getTime();
            var timeDifference = endDate - curDate;
            var leftDays = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            var day = document.querySelector(".counter .day")
            var hour = document.querySelector(".counter .hour")
            var minute = document.querySelector(".counter .minute")
            var second = document.querySelector(".counter .second")
            day.innerHTML = leftDays
            hour.innerHTML = 24 - d.getUTCHours() - 1
            minute.innerHTML = 60 - d.getUTCMinutes()
            second.innerHTML = 60 - d.getUTCSeconds()

            setInterval(() => {
                if (second.innerHTML == 0) {
                    second.innerHTML = 59;
                    if (minute.innerHTML == 0) {
                        minute.innerHTML = 59
                        if (hour.innerHTML == 0) {
                            hour.innerHTML = 23
                            day.innerHTML = parseInt(day.innerHTML) - 1
                        } else {
                            hour.innerHTML = Number(hour.innerHTML) - 1
                        }
                    } else {
                        minute.innerHTML = Number(minute.innerHTML) - 1
                    }
                } else {
                    second.innerHTML = Number(second.innerHTML) - 1
                }
            }, 1000)
            /**  End Counter  */
        </script>
    @endpush
@endif
