<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $prefix = 'intranet.clients.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        return view($this->prefix . 'index', ['clients' => User::getClients()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client)
    {
        $this->authorize('delete', $client);
        $client->delete();
        return redirect()->action([ClientController::class, 'index']);
    }

    public function apiOrders($dni)
    {
        $client = User::where('dni', $dni)->first();
        $orders = Order::where('client_id', $client->id)->get();

        return response(['orders' => new ClientResource($orders)], 200);
    }

    public function apiOrder($dni, $id)
    {
        $client = User::where('dni', $dni)->first();
        $order = Order::where('client_id', $client->id)
            ->where('id', $id)->first();

        return response(['order' => new ClientResource($order)], 200);
    }
}
