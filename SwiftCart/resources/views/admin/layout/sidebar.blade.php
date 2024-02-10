@php
    $general_setting = \App\Models\GeneralSetting::first();
@endphp

<aside class="py-4 position-fixed top-0 left-0 shadow-sm ">
    <div class="sidebar-header d-flex align-items-center justify-content-center">
        @if ($general_setting)
            <img src="{{ asset('storage/upload/' . $general_setting->logo) }}" class="me-2 img-fluid" s alt="logo">
        @else
            <img src="{{ asset('site_image/site_logo.png') }}" class="img-fluid me-2" alt="logo">
        @endif
        <h5 class="fw-normal me-4" style = "position: relative;top:6px">
            <span>
                @if ($general_setting)
                    {{ $general_setting->site_name }}
                @else
                    SwiftCart
                @endif
            </span>
        </h5>
    </div>
    <div class="sidebar-body mt-4">
        <ul class="nav flex-column">
            <li class=" nav-item  ps-2 disabled mb-3 text-muted" style="font-size:14px "><span>Dashboard</span></li>
            <li class="{{ setActive(['admin.dashboard']) }} nav-item  position-relative menu mb-3">
                <a href="{{ route('admin.dashboard') }}" class="nav-link  position-relative" data-title="Dashboard"
                    data-bs-placement="right"><i class="fas fa-fire me-3"></i><span>Dashboard</span></a>
            </li>
            <li class=" nav-item  ps-2 disabled mb-3 text-muted" style="font-size:14px"><span>Starter</span></li>
            <li
                class="menu  position-relative {{ setActive([
                    'admin.vendor_profile.*',
                    'admin.flash_sale.index',
                    'admin.coupon.*',
                    'admin.setting.index',
                    'admin.home_setting.index',
                    'admin.shipping_rule.*',
                    'admin.payment_setting',
                ]) }} menu nav-item   mb-3">
                <a href="#ecommerce-menu" class="nav-link  position-relative  shadow-none collapsed"
                    data-bs-toggle="collapse" data-title="Shop" data-bs-placement="right"><i
                        class="fa-solid fa-shop me-3"></i><span>Shop</span></a>
                <div class="collapse" id="ecommerce-menu">
                    <ul class="nav flex-column">
                        <li class="{{ setActive(['admin.vendor_profile.*']) }} nav-item"><a class="nav-link "
                                href="{{ route('admin.vendor_profile.index') }}"><span>Vendor Profile</span></a></li>
                        <li class="{{ setActive(['admin.flash_sale.index']) }} nav-item"><a class="nav-link "
                                href="{{ route('admin.flash_sale.index') }}"><span>Flash Sale</span></a></li>
                        <li class="{{ setActive(['admin.coupon.*']) }} nav-item"><a class="nav-link "
                                href="{{ route('admin.coupon.index') }}"><span>Coupon</span></a></li>
                        <li class="{{ setActive(['admin.setting.index']) }} nav-item"><a class="nav-link "
                                href="{{ route('admin.setting.index') }}"><span>Settings</span></a></li>
                        <li class="{{ setActive(['admin.shipping_rule.*']) }} nav-item"><a class="nav-link "
                                href="{{ route('admin.shipping_rule.index') }}"><span>Shipping Rule</span></a></li>
                        <li class="{{ setActive(['admin.payment_setting']) }} nav-item"><a class="nav-link "
                                href="{{ route('admin.payment_setting') }}"><span>Payment Settings</span></a></li>
                        <li class="{{ setActive(['admin.home_setting.index']) }} nav-item"><a class="nav-link "
                                href="{{ route('admin.home_setting.index') }}"><span>Home Settings</span></a></li>

                    </ul>
                </div>
            </li>
            <li
                class="menu position-relative {{ setActive(['admin.slider.*', 'admin.banner.index', 'admin.terms.index', 'admin.about.index']) }} nav-item    mb-3">
                <a href="#website-menu" class="nav-link position-relative shadow-none collapsed"
                    data-bs-toggle="collapse" data-title="Manage Website" data-bs-placement="right"><i
                        class="fa-solid fa-list-check me-3"></i><span class="">Manage Website</span></a>
                <div class="collapse " id="website-menu">
                    <ul class="nav flex-column">
                        <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                                href="{{ route('admin.slider.index') }}"><span>Slider</span></a></li>
                        <li class="{{ setActive(['admin.banner.index']) }}"><a class="nav-link"
                                href="{{ route('admin.banner.index') }}"><span>Banner</span></a></li>
                        <li class="{{ setActive(['admin.about.index']) }}"><a class="nav-link"
                                href="{{ route('admin.about.index') }}"><span>About</span></a></li>
                        <li class="{{ setActive(['admin.terms.index']) }}"><a class="nav-link"
                                href="{{ route('admin.terms.index') }}"><span>Terms And Conditions</span></a></li>

                    </ul>
                </div>
            </li>
            <li
                class="menu position-relative {{ setActive(['admin.category.*', 'admin.sub_category.*', 'admin.child_category.*']) }} nav-item menu  mb-3">
                <a href="#category-menu" class="nav-link  position-relative shadow-none collapsed"
                    data-title="Manage Categories" data-bs-placement="right" data-bs-toggle="collapse"><i
                        class="fa-solid fa-layer-group me-3"></i><span class="">Manage Categories</span></a>
                <div class="collapse " id="category-menu">
                    <ul class="nav flex-column">
                        <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link"
                                href="{{ route('admin.category.index') }}"><span>Category</span></a></li>
                        <li class="{{ setActive(['admin.sub_category.*']) }}"><a class="nav-link"
                                href="{{ route('admin.sub_category.index') }}"><span>Sub Category</span></a></li>
                        <li class="{{ setActive(['admin.child_category.*']) }}"><a class="nav-link"
                                href="{{ route('admin.child_category.index') }}"><span>Child Category</span></a></li>
                    </ul>
                </div>
            </li>


            <li
                class="menu {{ setActive([
                    'admin.brand.*',
                    'admin.product.*',
                    'admin.product_image_gallery.*',
                    'admin.product_variant.*',
                    'admin.product_variant_item.*',
                    'admin.seller_products',
                    'admin.seller_pending_products',
                ]) }} nav-item  position-relative  mb-3">
                <a href="#products-menu" class="nav-link   shadow-none collapsed" data-title="Manage Products"
                    data-bs-placement="right" data-bs-toggle="collapse"><i
                        class="fa-brands fa-product-hunt me-3"></i><span class="">Manage Products</span></a>
                <div class="collapse " id="products-menu">
                    <ul class="nav flex-column">
                        <li
                            class="{{ setActive(['admin.product.*', 'admin.product_image_gallery.*', 'admin.product_variant.*', 'admin.product_variant_item.*']) }}">
                            <a class="nav-link" href="{{ route('admin.product.index') }}"><span>Products</span></a>
                        </li>
                        <li class="{{ setActive(['admin.seller_products']) }}"><a class="nav-link"
                                href="{{ route('admin.seller_products') }}"><span>Seller Products</span></a></li>
                        <li class="{{ setActive(['admin.seller_pending_products']) }}"><a class="nav-link"
                                href="{{ route('admin.seller_pending_products') }}"><span>Seller Pending
                                    Products</span></a></li>
                        <li class="{{ setActive(['admin.brand.*']) }}"><a class="nav-link"
                                href="{{ route('admin.brand.index') }}"><span>Brands</span></a></li>
                    </ul>
                </div>
            </li>
            <li
                class="menu {{ setActive(['admin.order.*', 'admin.transaction.*']) }} nav-item position-relative mb-3">
                <a href="#order-menu" class="nav-link shadow-none collapsed" data-title="Manage Orders"
                    data-bs-placement="right" data-bs-toggle="collapse"><i
                        class="fa-solid fa-money-bill me-3"></i><span class="">Manage Orders</span></a>
                <div class="collapse" id="order-menu">
                    <ul class="nav flex-column">
                        <li class="{{ setActive(['admin.order.index']) }}"><a class="nav-link"
                                href="{{ route('admin.order.index') }}"><span>All Orders</span></a></li>
                        <li class="{{ setActive(['admin.order.pending']) }}"><a class="nav-link"
                                href="{{ route('admin.order.pending') }}"><span>Pending Orders</span></a></li>
                        <li class="{{ setActive(['admin.order.processed']) }}"><a class="nav-link"
                                href="{{ route('admin.order.processed') }}"><span>Processed Orders</span></a></li>
                        <li class="{{ setActive(['admin.order.dropped_off']) }}"><a class="nav-link"
                                href="{{ route('admin.order.dropped_off') }}"><span>Dropped Off Orders</span></a></li>
                        <li class="{{ setActive(['admin.order.shipped']) }}"><a class="nav-link"
                                href="{{ route('admin.order.shipped') }}"><span>Shipped Orders</span></a></li>
                        <li class="{{ setActive(['admin.order.out_for_delivery']) }}"><a class="nav-link"
                                href="{{ route('admin.order.out_for_delivery') }}"><span>Out for Delivery
                                    Orders</span></a></li>
                        <li class="{{ setActive(['admin.order.delivered']) }}"><a class="nav-link"
                                href="{{ route('admin.order.delivered') }}"><span>Delivered Orders</span></a></li>
                        <li class="{{ setActive(['admin.order.canceled']) }}"><a class="nav-link"
                                href="{{ route('admin.order.canceled') }}"><span>Canceled Orders</span></a></li>
                        <li class="{{ setActive(['admin.transaction.index']) }}"><a class="nav-link"
                                href="{{ route('admin.transaction.index') }}"><span>Transaction</span></a></li>
                    </ul>
                </div>
            </li>
            <li
                class="menu {{ setActive(['admin.index_customer', 'admin.index_vendor', 'admin.index_admin']) }} nav-item position-relative mb-3">
                <a href="#users" class="nav-link shadow-none collapsed" data-title="Users"
                    data-bs-placement="right" data-bs-toggle="collapse"><i class="fa-solid fa-user me-3"></i><span
                        class="">Users</span></a>
                <div class="collapse" id="users">
                    <ul class="nav flex-column">
                        <li class="{{ setActive(['admin.index_customer']) }}">
                            <a class="nav-link" href="{{ route('admin.index_customer') }}">
                                <span>Customers</span>
                            </a>
                        </li>

                        <li class="{{ setActive(['admin.index_vendor']) }}">
                            <a class="nav-link" href="{{ route('admin.index_vendor') }}">
                                <span>Vendors</span>
                            </a>
                        </li>

                        <li class="{{ setActive(['admin.index_admin']) }}">
                            <a class="nav-link" href="{{ route('admin.index_admin') }}">
                                <span>Admins</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu position-relative {{ setActive(['admin.vendor_request.*']) }} nav-item menu  mb-3">
                <a href="{{ route('admin.vendor_request.index') }}" class="nav-link" data-title="Vendor Requests"
                    data-bs-placement="right"><i class="fa-solid fa-repeat me-3"></i><span class="">Vendor
                        Requests</span></a>

            </li>
            <li
                class="menu position-relative {{ setActive(['admin.newsletter_subscribers.index']) }} nav-item menu  mb-3">
                <a href="{{ route('admin.newsletter_subscribers.index') }}" class="nav-link"
                    data-title="Newsletter Subscribers" data-bs-placement="right"><i
                        class="fa-solid fa-user-plus me-3"></i><span class="">Newsletter Subscribers</span></a>

            </li>
            <li class="menu position-relative {{ setActive(['admin.review.index']) }} nav-item menu  mb-3">
                <a href="{{ route('admin.review.index') }}" class="nav-link" data-title="Reviews"
                    data-bs-placement="right"><i class="fa-solid fa-star me-3"></i><span
                        class="">Reviews</span></a>

            </li>
            <li class="menu position-relative {{ setActive(['admin.contact.index']) }} nav-item menu  mb-3">
                <a href="{{ route('admin.contact.index') }}" class="nav-link" data-title="Contacts"
                    data-bs-placement="right"><i class="fa-solid fa-address-book me-3"></i><span
                        class="">Contacts</span></a>

            </li>
            <li
            class="menu  position-relative {{ setActive([
                'admin.withdraw_method.*',
                'admin.withdraw_request.*',
            ]) }} menu nav-item   mb-3">
            <a href="#withdraw-menu" class="nav-link  position-relative  shadow-none collapsed"
                data-bs-toggle="collapse" data-title="Withdraw" data-bs-placement="right"><i class="fa-solid fa-money-bill-transfer me-3"></i><span>Withdraw</span></a>
            <div class="collapse" id="withdraw-menu">
                <ul class="nav flex-column">
                    <li class="{{ setActive(['admin.withdraw_method.*']) }} nav-item"><a class="nav-link "
                            href="{{ route('admin.withdraw_method.index') }}"><span>Withdraw Methods</span></a></li>
                    <li class="{{ setActive(['admin.withdraw_request.*']) }} nav-item"><a class="nav-link "
                            href="{{ route('admin.withdraw_request.index') }}"><span>Withdraw Requests</span></a></li>
                </ul>
            </div>
        </li>

        </ul>

    </div>

</aside>
