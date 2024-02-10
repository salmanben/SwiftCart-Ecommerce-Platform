@if (count($brands) > 0)
    <section class="brand my-4">
        <div class="">
            <div class="card rounded">
                <div class="card-body">
                    <div class="swiper swiper-brand">
                        <div class="swiper-wrapper">
                            @foreach ($brands as $brand)
                                <div class="swiper-slide d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('storage/upload/' . $brand->logo) }}" alt=""
                                        style="height:80px;width:180px; object-fit:contain">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endif
