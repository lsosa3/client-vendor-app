<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\ClientsController;

class SendRequestMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $vendorId;
    private $description;
    private $clientId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->vendorId = $request->vendor;
        $this->clientId = $request->client;
        $this->description = $request->description;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $vendor = new VendorsController();
        $client = new ClientsController();
        $recipient = $vendor->getVendorEmail((int)$this->vendorId);
        $vendorName = $vendor->getVendorName((int)$this->vendorId);
        $clientName = $client->getClientName((int)$this->clientId);
        $clientEmail = $client->getClientEmail((int)$this->clientId);

        $data = array(
            'vendorName' => $vendorName,
            'message' => $this->description,
            'clientName' => $clientName,
            'clientEmail' => $clientEmail,
        );

        Mail::to($recipient)->send(new SendEmail($data));
    }
}
