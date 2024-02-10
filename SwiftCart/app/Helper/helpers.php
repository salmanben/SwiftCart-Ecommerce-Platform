<?php

use  Gloudemans\Shoppingcart\Facades\Cart;

/* Set SideBar Link Active */

function setActive(array $routes)
{
    foreach ($routes as $route) {
        if (request()->routeIs($route))
            return "active";
    }
    return "";
}

/* Set Product Type */

function set_product_type($type)
{
    switch ($type) {
        case 'New Arrival':
            return "<span class='badge bg-success text-white'>New</span>";
        case 'Featured':
            return "<span class='badge bg-info text-white'>Featured</span>";
        case 'Top Product':
            return "<span class='badge bg-primary text-white'>Top</span>";
        case 'Best Product':
            return "<span class='badge bg-warning text-white'>Best</span>";
        default:
            return '';
    }
}

/* Check if product has discount */
function has_discount($product)
{
    $offer_price = $product->offer_price;

    if ($offer_price != null) {
        $start_date = $product->offer_start_date;
        $end_date = $product->offer_end_date;
        if (empty($start_date) && empty($end_date))
           return 1;
        else if (empty($start_date) || empty($end_date))
           return 0;
        else
        {
            $currentDate = date('Y-m-d');
            if ($currentDate >= $start_date && $currentDate < $end_date) {
               return 1;
            }
        }
    }

    return 0;
}

/* Get the discount percentage*/
function set_discount_percentage($product)
{
    if (has_discount($product)) {
        return '<span class="badge bg-danger fs-6 rounded-pill">-' .  floor((100 - ($product->offer_price * 100) / $product->price)) . '%</span>';
    }
}

/* Get  Discount coupon */
function get_discount_coupon()
{
    $discount_value = 0;
    $sub_total = calc_sub_total();
    if (session()->has('coupon')) {
        $coupon = session()->get('coupon');
        if ($coupon['discount_type'] == 'percentage')
            $discount_value = ($sub_total * $coupon['discount']) / 100;
        else
        $discount_value = $coupon['discount'];
    }

    return round($discount_value, 2);
}
/* Get Sub Total */
function calc_sub_total()
{
    $sub_total = 0;
    foreach (Cart::content() as $item) {

        $sub_total += ($item->price + $item->options->total_variants) * $item->qty;
    }
    return round($sub_total, 2);
}
