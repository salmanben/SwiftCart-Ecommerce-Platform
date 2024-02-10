    @php
        $footer_info = \App\Models\FooterInfo::first();
    @endphp
    <footer class="">
        <div class="container text-white">
            <div class="row justify-content-between py-3">
                <div class="col-12 col-md-6 mb-2 mb-lg-0 col-lg-4 ">
                    <div class="">
                        <a class="text-white d-block mb-2" href="callto:+8896254857456"><i
                                class="fas fa-phone-alt text-warning me-2"></i>
                            {{ @$footer_info->phone }}
                            <a class="text-white d-block mb-2" href="mailto:example@gmail.com"><i
                                    class="far fa-envelope text-warning me-2"></i>
                                {{ @$footer_info->email }}</a>
                            @if (@$footer_info->address)
                                <p><i class="fa-solid fa-location-dot text-warning me-2"></i>
                                    {{ $footer_info->address }}</p>
                            @endif
                            <ul class="footer_social list-unstyled d-flex">
                                @if (@$footer_info->facebook)
                                    <li><a class="facebook" href="{{ @$footer_info->facebook }}"><i
                                                class="fab fa-facebook-f bg-warning text-white"></i></a></li>
                                @endif
                                @if (@$footer_info->twitter)
                                    <li><a class="twitter" href="{{ @$footer_info->twitter }}"><i
                                                class="fab fa-twitter bg-warning text-white"></i></a></li>
                                @endif
                                @if (@$footer_info->whatsapp)
                                    <li><a class="whatsapp" href="{{ @$footer_info->whatsapp }}"><i
                                                class="fab fa-whatsapp bg-warning text-white"></i></a></li>
                                @endif
                                @if (@$footer_info->instagram)
                                    <li><a class="instagram" href="{{ @$footer_info->instagram }}"><i
                                                class="fa-brands fa-instagram bg-warning text-white"></i></a></li>
                                @endif
                            </ul>
                    </div>
                </div>
                <div class="col-12 mb-2 mb-md-0 col-md-6 col-lg-4 ">
                    <div class="company">
                        <h5>Company</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3"><a href="{{ route('about.index') }}" class="text-white"><i
                                        class="fas fa-caret-right"></i> About Us</a></li>
                            <li><a href="{{ route('contact.create') }}" class="text-white"><i
                                        class="fas fa-caret-right"></i> Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="">
                        <h3>Subscribe To Our Newsletter</h3>
                        <p>Stay updated on the latest Events, Sales, and Offers.
                            Stay informed about the latest Events.
                        </p>
                        <form class="subscribe-form">
                            <div class="input-group">
                                <input type="email" class="form-control shadow-none" name='email'
                                    placeholder="Email">
                                <button type="submit" class="btn btn-warning shadow-sm">subscribe</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="text-white copyright text-center bg-warning py-2 mb-0">
            {{ @$footer_info->copyright }}
        </div>
    </footer>
    @push('scripts')
        <script>
            var siteName = "{{ optional($general_setting)->site_name }}"
            var copyright = document.querySelector('.copyright')
            if (siteName.length == 0) {
                siteName = 'SwiftCart';
            }
            if (copyright.innerText.includes(siteName)) {
                var arr = copyright.innerText.split(siteName)
                copyright.innerHTML = `${arr[0]} <span class="text-body">${siteName}</span>  ${arr[1]}`;
            }
        </script>
    @endpush
