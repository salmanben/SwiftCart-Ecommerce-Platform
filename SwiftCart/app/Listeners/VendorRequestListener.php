<?php

namespace App\Listeners;

use App\Models\EmailSetting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\VendorRequest;
class VendorRequestListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {

     try {

         Mail::to($event->data['email'])->send(new VendorRequest($event->data['subject'], $event->data['message']));
     } catch (\Exception $e) {
         dd($e->getMessage());
     }
    }
}
