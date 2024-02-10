<?php

namespace App\Http\Controllers\backend;

use App\DataTables\NewsletterSubscriberDataTable;
use App\Http\Controllers\Controller;
use App\Mail\AllNewsletterSubscribers;
use App\Models\EmailSetting;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Newsletter extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NewsletterSubscriberDataTable $datatable)
    {
        return $datatable->render('admin.newsletter.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->delete();
        return response(['status' => 'success', 'message' => 'Subscriber Deleted Successfully!']);
    }

    /**
     * Send email to all subscribers.
     */

    public function send_email(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'message' => 'required|string'
        ]);
        $subscribers = NewsletterSubscriber::where('is_verified', 1)->pluck('email')->toArray();
        if (count($subscribers) == 0) {
            toastr()->error('You don\'t have any subscriber');
            return redirect()->back();
        }
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

            Mail::to($subscribers)->send(new AllNewsletterSubscribers($request->subject, $request->message));
            toastr()->success('Email has been sent successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            toastr()->error('Error sending email');
        }

        return redirect()->back();
    }
}
