<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterSubscriberMail;
use App\Models\EmailSetting;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {

        $subscriber = NewsletterSubscriber::where('email', $request->email)->first();

        if ($subscriber) {
            if ($subscriber->is_verified)
            {
                return response(['status' => 'error', 'message' => 'Email already used!']);
            }
            else
            {
                $email_setting = EmailSetting::first();
                $token = Str::random(20);
                $subscriber->update(['token'=> $token]);
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


                try {
                    Mail::to($subscriber->email)->send(new NewsletterSubscriberMail($token));
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
                return response(['status' => 'success', 'message' => 'Check your email for verification link!']);
            }
        } else {
            $new_subscriber = NewsletterSubscriber::create([
                'email' => $request->email,
                'token' => Str::random(20),
            ]);
            $email_setting = EmailSetting::first();
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


            try {
                Mail::to($new_subscriber->email)->send(new NewsletterSubscriberMail($new_subscriber->token));
            } catch (\Exception $e) {
                dd($e->getMessage());
            }

            return response(['status' => 'success', 'message' => 'Check your email for verification link!']);
        }
    }

    function verify_email($token)
    {
        $subscriber = NewsletterSubscriber::where('token', $token)->first();
        if ($subscriber == null || now()->diffInMinutes(Carbon::parse($subscriber->updated_at)) > 15)
        {
            toastr()->error('Invalid Token!');
        }
        else
        {
            $subscriber->update([
                'token'=>'verified',
                'is_verified'=>1
            ]);
            toastr()->success('Email verified successfully');
        }
        return redirect('/');

    }
}
