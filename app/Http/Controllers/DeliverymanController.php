<?php

namespace App\Http\Controllers;

use App\Models\Deliveryman;
use App\Models\User;
use Illuminate\Http\Request;

class DeliverymanController extends Controller
{
    private $prefix = 'intranet.deliverymen.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        return view($this->prefix . 'index', ['deliverymen' => User::getDeliverymen()]);
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
     * @param  \App\Models\Deliveryman  $deliveryman
     * @return \Illuminate\Http\Response
     */
    public function show(User $deliveryman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deliveryman  $deliveryman
     * @return \Illuminate\Http\Response
     */
    public function edit(User $deliveryman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deliveryman  $deliveryman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $deliveryman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deliveryman  $deliveryman
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $deliveryman)
    {
        $this->authorize('delete', $deliveryman);
        $deliveryman->delete();
        return redirect()->action([DeliverymanController::class, 'index']);
    }
}
