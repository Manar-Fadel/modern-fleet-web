<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\CarCategory;
use App\Models\CarImage;
use App\Models\EquipmentBrand;
use App\Models\EquipmentModel;
use App\Models\ManufacturingYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $query = Car::query()->with(['brand', 'brandModel', 'year', 'mainImage']);

        // Filters
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('model_id')) {
            $query->where('model_id', $request->model_id);
        }

        if ($request->filled('manufacturing_year_id')) {
            $query->where('manufacturing_year_id', $request->manufacturing_year_id);
        }

        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $cars = $query->latest()->paginate(20)->withQueryString();

        return view('cpanel.cars.index', [
            'cars' => $cars,
            'brands' => EquipmentBrand::all(),
            'categories' => CarCategory::all(),
            'models' => EquipmentModel::all(),
            'years' => ManufacturingYear::all(),
        ]);
    }
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('cpanel.cars.create', [
            'brands' => EquipmentBrand::all(),
            'models' => EquipmentModel::all(),
            'years' => ManufacturingYear::orderByDesc('year')->get(),
            'categories' => CarCategory::all(),
        ]);
    }
    public function store(CarRequest $request): \Illuminate\Http\RedirectResponse
    {
        $car = Car::create($request->validated());
        $car->is_main = $request->boolean('is_main');
        $car->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $file) {
                $path = $file->store('cars', 'public');

                CarImage::create([
                    'car_id' => $car->id,
                    'path' => $path,
                    'is_main' => $i === 0,
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.cars.index')->with('success','Car created successfully');
    }
    public function edit(Car $car): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $car->load('images');

        return view('cpanel.cars.edit', [
            'car' => $car,
            'brands' => EquipmentBrand::all(),
            'models' => EquipmentModel::all(),
            'years' => ManufacturingYear::orderByDesc('year')->get(),
            'categories' => CarCategory::all(),
        ]);
    }
    public function update(CarRequest $request, Car $car): \Illuminate\Http\RedirectResponse
    {
        $car->update($request->validated());
        $car->is_main = $request->boolean('is_main');
        $car->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('cars', 'public');

                CarImage::create([
                    'car_id' => $car->id,
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.cars.index')->with('success','Car updated successfully');
    }
    public function destroy(Car $car): \Illuminate\Http\RedirectResponse
    {
        $car->delete();
        return back()->with('success', 'Car deleted successfully');
    }
}
