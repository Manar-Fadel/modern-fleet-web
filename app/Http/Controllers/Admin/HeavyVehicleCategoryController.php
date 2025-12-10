<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HeavyVehicleCategoryRequest;
use App\Models\HeavyVehicleCategory;
use Illuminate\Http\Request;

class HeavyVehicleCategoryController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $categories = HeavyVehicleCategory::latest()->paginate(10);

        return view('cpanel.heavy_vehicle_categories.index', compact('categories'));
    }
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('cpanel.heavy_vehicle_categories.create');
    }
    public function store(HeavyVehicleCategoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        HeavyVehicleCategory::create($request->validated());

        return redirect()
            ->route('admin.heavy-vehicle-categories.index')
            ->with('success', 'Category created successfully.');
    }
    public function edit(HeavyVehicleCategory $heavyVehicleCategory): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view(
            'cpanel.heavy_vehicle_categories.edit',
            compact('heavyVehicleCategory')
        );
    }
    public function update(HeavyVehicleCategoryRequest $request, HeavyVehicleCategory $heavyVehicleCategory): \Illuminate\Http\RedirectResponse
    {
        $heavyVehicleCategory->update($request->validated());

        return redirect()
            ->route('admin.heavy-vehicle-categories.index')
            ->with('success', 'Category updated successfully.');
    }
    public function destroy(HeavyVehicleCategory $heavyVehicleCategory): \Illuminate\Http\RedirectResponse
    {
        $heavyVehicleCategory->delete();

        return redirect()
            ->route('admin.heavy-vehicle-categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
