<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\HeavyVehicle;

class HeavyVehiclesController extends Controller
{

    public function view($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $model = HeavyVehicle::with('images')->findOrFail($id);
        return view('web.heavy-vehicles.view', compact('model'));
    }

}
