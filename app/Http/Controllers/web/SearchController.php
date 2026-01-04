<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Managers\AdminManager;
use App\Managers\CarManager;
use App\Managers\HeavyVehicleManager;
use App\Models\Car;
use App\Models\HeavyVehicle;

class SearchController extends Controller
{
    public function index($type): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $models = []; $categories = []; $brands_list = [];
        if ($type == 'cars') {
            $categories = CarManager::getCategoriesList();
            $brands_list = AdminManager::getBrandsAsArray('cars');

            $models = Car::query()
                ->with(['brand', 'brandModel', 'category', 'year'])
                ->filter(request()->only([
                    'brand_id',
                    'model_id',
                    'category_id',
                    'manufacturing_year_id',
                ]))
                ->latest()
                ->paginate(9)
                ->withQueryString();

        }elseif ($type == 'heavy_vehicles') {
            $categories = HeavyVehicleManager::getCategoriesList();
            $brands_list = AdminManager::getBrandsAsArray('heavy_vehicles');

            $models = HeavyVehicle::query()
                ->with(['brand', 'brandModel', 'category', 'year'])
                ->filter(request()->only([
                    'brand_id',
                    'model_id',
                    'category_id',
                    'manufacturing_year_id',
                ]))
                ->latest()
                ->paginate(9)
                ->withQueryString();
        }

        $local = app()->getLocale();
        $years = AdminManager::getYearsAsArray();

        return view('web.search', compact('models', 'type',
            'local', 'categories', 'years', 'brands_list'
        ));
    }

}
