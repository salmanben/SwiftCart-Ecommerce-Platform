<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Traits\Image_Handle;
use PhpParser\Node\Stmt\Else_;

class BannerController extends Controller
{
    use Image_Handle;
    public function index()
    {
        $home_banner_section_one = Banner::where('key', 'home_banner_section_one')->first();
        $home_banner_section_one = json_decode(@$home_banner_section_one->value);
        $home_banner_section_two = Banner::where('key', 'home_banner_section_two')->first();
        $home_banner_section_two = json_decode(@$home_banner_section_two->value);
        $home_banner_section_three = Banner::where('key', 'home_banner_section_three')->first();
        $home_banner_section_three = json_decode(@$home_banner_section_three->value);
        $home_banner_section_four = Banner::where('key', 'home_banner_section_four')->first();
        $home_banner_section_four = json_decode(@$home_banner_section_four->value);
        $home_banner_section_five = Banner::where('key', 'home_banner_section_five')->first();
        $home_banner_section_five = json_decode(@$home_banner_section_five->value);
        $product_filter_banner = Banner::where('key', 'product_filter_banner')->first();
        $product_filter_banner = json_decode(@$product_filter_banner->value);
        $cart_view_banner = Banner::where('key', 'cart_view_banner')->first();
        $cart_view_banner = json_decode(@$cart_view_banner->value);
        return view('admin.banner.index', compact('home_banner_section_one', 'home_banner_section_two', 'home_banner_section_three', 'home_banner_section_four', 'home_banner_section_five', 'product_filter_banner', 'cart_view_banner'));
    }

    public function update_home_banner_section_one(Request $request)
    {
        session()->put('banner', 'home-banner-section-one');
        $request->validate(
            [
                'banner' => 'nullable|image',
                'url' => 'required|url'
            ]
        );

        if (!$request->has('banner')) {
            if (empty($request->old_image)) {
                toastr()->error('You must upload a banner!');
                return redirect()->back();
            } else
                $image = $request->old_image;
        } else {
            $image = $this->image_update($request, 'banner', 'upload', $request->old_image);
        }
        $value = [
            'banner1' => [
                'image' => $image,
                'url' => $request->url,
                'status' => $request->status
            ]
        ];
        $value = json_encode($value);
        Banner::updateOrCreate(
            ['key' => 'home_banner_section_one'],
            ['value' => $value]
        );
        toastr()->success('Banner saved successfully');
        return redirect()->back();
    }

    public function update_home_banner_section_two(Request $request)
    {
        session()->put('banner', 'home-banner-section-two');
        $request->validate(
            [
                'banner' => 'nullable|image',
                'url' => 'required|url'
            ]
        );

        if (!$request->has('banner')) {
            if (empty($request->old_image)) {
                toastr()->error('You must upload a banner!');
                return redirect()->back();
            } else
                $image = $request->old_image;
        } else {
            $image = $this->image_update($request, 'banner', 'upload', $request->old_image);
        }
        $value = [
            'banner1' => [
                'image' => $image,
                'url' => $request->url,
                'status' => $request->status
            ]
        ];
        $value = json_encode($value);
        Banner::updateOrCreate(
            ['key' => 'home_banner_section_two'],
            ['value' => $value]
        );
        toastr()->success('Banner saved successfully');
        return redirect()->back();
    }

    public function update_home_banner_section_three(Request $request)
    {
        session()->put('banner', 'home-banner-section-three');
        $request->validate(
            [
                'banner_1' => 'nullable|image',
                'url_1' => 'required|url',
                'banner_2' => 'nullable|image',
                'url_2' => 'required|url'
            ]
        );

        if (!$request->has('banner_1')) {
            if (empty($request->old_image_banner_1)) {
                toastr()->error('You must upload  the banner 1!');
                return redirect()->back();
            }
        }
        if (!$request->has('banner_2')) {
            if (empty($request->old_image_banner_2)) {
                toastr()->error('You must upload  the banner 2!');
                return redirect()->back();
            }
        }

        if ($request->has('banner_1')) {
            $image1 = $this->image_update($request, 'banner_1', 'upload', $request->old_image_banner_1);
        } else {
            $image1 = $request->old_image_banner_1;
        }

        if ($request->has('banner_2')) {
            $image2 = $this->image_update($request, 'banner_2', 'upload', $request->old_image_banner_2);
        } else {
            $image2 = $request->old_image_banner_2;
        }
        $value = [
            'banner1' => [
                'image' => $image1,
                'url' => $request->url_1,
                'status' => $request->status_1
            ],
            'banner2' => [
                'image' => $image2,
                'url' => $request->url_2,
                'status' => $request->status_2
            ],

        ];
        $value = json_encode($value);
        Banner::updateOrCreate(
            ['key' => 'home_banner_section_three'],
            ['value' => $value]
        );
        toastr()->success('Banners saved successfully');
        return redirect()->back();
    }

    public function update_home_banner_section_four(Request $request)
    {
        session()->put('banner', 'home-banner-section-four');
        $request->validate([
            'banner_1' => 'nullable|image',
            'url_1' => 'required|url',
            'banner_2' => 'nullable|image',
            'url_2' => 'required|url',
            'banner_3' => 'nullable|image',
            'url_3' => 'required|url',
        ]);

        if (!$request->has('banner_1')) {
            if (empty($request->old_image_banner_1)) {
                toastr()->error('You must upload  the banner 1!');
                return redirect()->back();
            }
        }
        if (!$request->has('banner_2')) {
            if (empty($request->old_image_banner_2)) {
                toastr()->error('You must upload  the banner 2!');
                return redirect()->back();
            }
        }
        if (!$request->has('banner_3')) {
            if (empty($request->old_image_banner_3)) {
                toastr()->error('You must upload  the banner 3!');
                return redirect()->back();
            }
        }

        if ($request->has('banner_1')) {
            $image1 = $this->image_update($request, 'banner_1', 'upload', $request->old_image_banner_1);
        } else {
            $image1 = $request->old_image_banner_1;
        }

        if ($request->has('banner_2')) {
            $image2 = $this->image_update($request, 'banner_2', 'upload', $request->old_image_banner_2);
        } else {
            $image2 = $request->old_image_banner_2;
        }

        if ($request->has('banner_3')) {
            $image3 = $this->image_update($request, 'banner_3', 'upload', $request->old_image_banner_3);
        } else {
            $image3 = $request->old_image_banner_3;
        }
        $value = [
            'banner1' => [
                'image' => $image1,
                'url' => $request->url_1,
                'status' => $request->status_1
            ],
            'banner2' => [
                'image' => $image2,
                'url' => $request->url_2,
                'status' => $request->status_2
            ],
            'banner3' => [
                'image' => $image3,
                'url' => $request->url_3,
                'status' => $request->status_3
            ],

        ];
        $value = json_encode($value);
        Banner::updateOrCreate(
            ['key' => 'home_banner_section_four'],
            ['value' => $value]
        );
        toastr()->success('Banners saved successfully');
        return redirect()->back();
    }


    public function update_home_banner_section_five(Request $request)
    {
        session()->put('banner', 'home-banner-section-five');
        $request->validate(
            [
                'banner' => 'nullable|image',
                'url' => 'required|url'
            ]
        );

        if (!$request->has('banner')) {
            if (empty($request->old_image)) {
                toastr()->error('You must upload a banner!');
                return redirect()->back();
            } else
                $image = $request->old_image;
        } else {
            $image = $this->image_update($request, 'banner', 'upload', $request->old_image);
        }
        $value = [
            'banner1' => [
                'image' => $image,
                'url' => $request->url,
                'status' => $request->status
            ]
        ];
        $value = json_encode($value);
        Banner::updateOrCreate(
            ['key' => 'home_banner_section_five'],
            ['value' => $value]
        );
        toastr()->success('Banners saved successfully');
        return redirect()->back();
    }

    public function update_product_filter_banner(Request $request)
    {
        session()->put('banner', 'product-filter-banner');
        $request->validate(
            [
                'banner' => 'nullable|image',
                'url' => 'required|url'
            ]
        );
        if (!$request->has('banner')) {
            if (empty($request->old_image)) {
                toastr()->error('You must upload a banner!');
                return redirect()->back();
            } else
                $image = $request->old_image;
        } else {
            $image = $this->image_update($request, 'banner', 'upload', $request->old_image);
        }
        $value = [
            'banner1' => [
                'image' => $image,
                'url' => $request->url,
                'status' => $request->status
            ]
        ];
        $value = json_encode($value);
        Banner::updateOrCreate(
            ['key' => 'product_filter_banner'],
            ['value' => $value]
        );
        toastr()->success('Banner saved successfully');
        return redirect()->back();
    }

    public function update_cart_view_banner(Request $request)
    {
        session()->put('banner', 'cart-view-banner');
        $request->validate(
            [
                'banner_1' => 'nullable|image',
                'url_1' => 'required|url',
                'banner_2' => 'nullable|image',
                'url_2' => 'required|url'
            ]
        );

        if (!$request->has('banner_1')) {
            if (empty($request->old_image_banner_1)) {
                toastr()->error('You must upload  the banner 1!');
                return redirect()->back();
            }
        }
        if (!$request->has('banner_2')) {
            if (empty($request->old_image_banner_2)) {
                toastr()->error('You must upload  the banner 2!');
                return redirect()->back();
            }
        }

        if ($request->has('banner_1')) {
            $image1 = $this->image_update($request, 'banner_1', 'upload', $request->old_image_banner_1);
        } else {
            $image1 = $request->old_image_banner_1;
        }

        if ($request->has('banner_2')) {
            $image2 = $this->image_update($request, 'banner_2', 'upload', $request->old_image_banner_2);
        } else {
            $image2 = $request->old_image_banner_2;
        }
        $value = [
            'banner1' => [
                'image' => $image1,
                'url' => $request->url_1,
                'status' => $request->status_1
            ],
            'banner2' => [
                'image' => $image2,
                'url' => $request->url_2,
                'status' => $request->status_2
            ],

        ];
        $value = json_encode($value);
        Banner::updateOrCreate(
            ['key' => 'cart_view_banner'],
            ['value' => $value]
        );
        toastr()->success('Banners saved successfully');
        return redirect()->back();
    }
}
