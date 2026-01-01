<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarsController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $models = Car::query()
            ->with(['brand', 'model', 'category', 'year'])
            ->filter(request()->only([
                'brand_id',
                'model_id',
                'category_id',
                'manufacturing_year_id',
            ]))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('cars.index', compact('models'));
    }

}
