<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HeavyVehicleRequest;
use App\Models\HeavyVehicle;
use App\Models\EquipmentBrand;
use App\Models\EquipmentModel;
use App\Models\ManufacturingYear;
use App\Models\HeavyVehicleCategory;
use Illuminate\Http\Request;
use App\Models\HeavyVehicleImage;
use Illuminate\Support\Facades\Storage;


class HeavyVehicleController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $query = HeavyVehicle::query()
            ->with(['brand', 'brandModel', 'year', 'category'])
            ->orderByDesc('id');

        // Optional filters
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        $heavyVehicles = $query->with(['brand', 'brandModel', 'year', 'category', 'images', 'mainImage'])
            ->paginate(20);

        $brands = EquipmentBrand::orderBy('name_en')->get();

        return view('cpanel.heavy_vehicles.index', compact('heavyVehicles', 'brands'));
    }
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $brands      = EquipmentBrand::orderBy('name_en')->get();
        $models      = EquipmentModel::orderBy('name_en')->get();
        $years       = ManufacturingYear::orderBy('year', 'desc')->get();
        $categories  = HeavyVehicleCategory::orderBy('name_en')->get();

        return view('cpanel.heavy_vehicles.create', compact(
            'brands', 'models', 'years', 'categories'
        ));
    }
    public function store(HeavyVehicleRequest $request): \Illuminate\Http\RedirectResponse
    {
        $vehicle = HeavyVehicle::create($request->validated());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('heavy_vehicles', 'public');

                HeavyVehicleImage::create([
                    'heavy_vehicle_id' => $vehicle->id,
                    'path'             => $path,
                    'is_main'          => $index === 0, // أول صورة رئيسية
                    'sort_order'       => $index,
                ]);
            }
        }

        return redirect()
            ->route('admin.heavy-vehicles.index')
            ->with('success', 'Heavy vehicle created successfully.');
    }
    public function edit(HeavyVehicle $heavyVehicle): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $heavyVehicle->load(['images']);

        $brands      = EquipmentBrand::orderBy('name_en')->get();
        $models      = EquipmentModel::orderBy('name_en')->get();
        $years       = ManufacturingYear::orderBy('year', 'desc')->get();
        $categories  = HeavyVehicleCategory::orderBy('name_en')->get();

        return view('cpanel.heavy_vehicles.edit', compact(
            'heavyVehicle', 'brands', 'models', 'years', 'categories'
        ));
    }
    public function update(HeavyVehicleRequest $request, HeavyVehicle $heavyVehicle): \Illuminate\Http\RedirectResponse
    {
        $heavyVehicle->update($request->validated());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('heavy_vehicles', 'public');

                HeavyVehicleImage::create([
                    'heavy_vehicle_id' => $heavyVehicle->id,
                    'path'             => $path,
                    'is_main'          => false,
                    'sort_order'       => $heavyVehicle->images()->count() + $index,
                ]);
            }
        }
        return redirect()
            ->route('admin.heavy-vehicles.index')
            ->with('success', 'Heavy vehicle updated successfully.');
    }
    public function destroy(HeavyVehicle $heavyVehicle): \Illuminate\Http\RedirectResponse
    {
        $heavyVehicle->delete();

        return redirect()
            ->route('admin.heavy-vehicles.index')
            ->with('success', 'Heavy vehicle deleted successfully.');
    }
}
