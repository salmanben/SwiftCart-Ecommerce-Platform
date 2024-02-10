<?php

namespace App\Providers;

use App\Models\EmailSetting;
use App\Models\GeneralSetting;
use App\Models\HomeSetting;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        /*
        $general_setting = GeneralSetting::first();
        if ($general_setting)
        {
            config()->set('app.name', $general_setting->site_name);
            View::composer('*', function($view) use ($general_setting) {
                $view->with('currency_icon', $general_setting->currency_icon);
             });
         }
        else
        {
            config()->set('app.name', 'SwiftCart');
            View::composer('*', function($view) {
                $view->with('currency_icon', '$');
             });

        }
        $email_setting = EmailSetting::first();
        if ($email_setting)
        {
            config()->set('mail.mailers.smtp', [
                'transport' => 'smtp',
                'host' => $email_setting->host,
                'port' => $email_setting->port,
                'encryption' => $email_setting->encryption,
                'username' => $email_setting->username,
                'password' => $email_setting->password,
            ]);

            config()->set('mail.from', [
                'address' => $email_setting->from_address,
                'name' => $email_setting->name,
            ]);
        }
        $box_background = HomeSetting::where('key', 'box_background')->first();
        if ($box_background)
            $box_background = $box_background->value;
        else
            $box_background = '';
        View::composer('*', function($view)use ($box_background) {
                $view->with('box_background', $box_background);
             });
        */


    }




}
