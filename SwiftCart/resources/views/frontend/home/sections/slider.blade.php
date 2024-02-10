@if ($sliders->count())
    <section class="slider">
        <div class="row">
            <div class="col-12 col-lg-8 ">
                <div class="swiper swiper-slider">
                    <div class="swiper-wrapper">
                        @foreach ($sliders as $slider)
                            <div class="swiper-slide rounded"
                                style=" background-image: url('{{ asset('storage/upload/' . $slider->banner) }}');
                                    background-size: cover;
                                    background-position:center;
                                    background-repeat: no-repeat">
                                <div class="swiper-text  mt-5 ms-3 ms-md-4">
                                    <h4 class="text-warning p-1">{!! $slider->type !!}</h4>
                                    <h3 class="text-white">{!! $slider->title !!}</h3>
                                    @if ($slider->starting_price)
                                        <h4 class="text-white">start at <span
                                                class="fw-bold  text-warning">{{ $currency_icon }}{{ $slider->starting_price }}</span>
                                        </h4>
                                    @endif

                                    <a class="btn  btn-dark text-white" href="{{ $slider->btn_url }}"><i
                                            class="fa-solid fa-cart-shopping me-2"></i>shop now
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-prev bg-primary"></div>
                    <div class="swiper-button-next bg-primary"></div>
                </div>
            </div>
            @if ($home_banner_section_one && $home_banner_section_one->banner1->status)
                <div class="col-4 d-none d-lg-inline-block">
                    <div class="rounded slider-banner position-relative"
                        style=" background-image: url('{{ asset('storage/upload/' . $home_banner_section_one->banner1->image) }}');
                                background-size: cover;
                                background-position:center;
                                background-repeat: no-repeat">
                        <a class="btn  btn-warning text-white mt-4"
                            href="{{ $home_banner_section_one->banner1->url }}"><i
                                class="fa-solid fa-cart-shopping me-2"></i>shop now
                        </a>

                    </div>
                </div>
            @endif
        </div>
    </section>
@endif
