<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarsController extends Controller
{
    public function view($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $model = Car::with('images')->findOrFail($id);
        return view('web.cars.view', compact('model'));
    }

}
