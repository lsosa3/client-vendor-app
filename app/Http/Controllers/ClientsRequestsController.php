<?php

namespace App\Http\Controllers;

use App\ClientsRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Throwable;
use App\Jobs\SendRequestMail;
use Carbon\Carbon;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\ClientsController;

class ClientsRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientRequests = ClientsRequests::where(DB::raw('TIMESTAMPDIFF(SECOND, clients_requests.created_at, NOW())'),'>=','5')
                        ->orderBy('created_at', 'desc')
                        ->get();
        //return $clientRequests;
        return view('clientsRequests.list', ['clientRequests' => $clientRequests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ven = new VendorsController();
        $vendors = $ven->getVendors();

        $cli = new ClientsController();
        $clients = $cli->getClients();
        return view('clientsRequests.create', ['vendors' => $vendors, 'clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'vendor' => 'required',
            'description' => 'required',
            'price' => 'required'
            ]);

        try {
            $clientRequest = new ClientsRequests();
            $clientRequest->client_id = $request->client;
            $clientRequest->vendor_id = $request->vendor;
            $clientRequest->description = $request->description;
            $clientRequest->price = $request->price;
            $clientRequest->status = 1;

            $clientRequest->save();
        }catch (Throwable $e) {
            report($e);
            return back()->with(['type' => 'danger', 'msg' => 'Failed request, please try again!']);
        }

        $emailJob = (new SendRequestMail($request))->delay(Carbon::now()->addSeconds(5));
        dispatch($emailJob);
        return back()->with(['type' => 'success', 'msg' => 'Your request has been send, thank you!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientsRequests  $clientsRequests
     * @return \Illuminate\Http\Response
     */
    public function show(ClientsRequests $clientsRequests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientsRequests  $clientsRequests
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientsRequests $clientsRequests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientsRequests  $clientsRequests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientsRequests $clientsRequests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientsRequests  $clientsRequests
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientsRequests $clientsRequests)
    {
        //
    }
}
