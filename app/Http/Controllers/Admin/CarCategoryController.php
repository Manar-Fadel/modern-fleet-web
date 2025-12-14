<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarCategoryRequest;
use App\Models\CarCategory;
use Illuminate\Http\Request;

class CarCategoryController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $categories = CarCategory::latest()->paginate(10);

        return view('cpanel.heavy_vehicle_categories.index', compact('categories'));
    }
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('cpanel.heavy_vehicle_categories.create');
    }
    public function store(CarCategoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        CarCategory::create($request->validated());

        return redirect()
            ->route('admin.heavy-vehicle-categories.index')
            ->with('success', 'Category created successfully.');
    }
    public function edit(CarCategory $carCategory): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view(
            'cpanel.heavy_vehicle_categories.edit',
            compact('carCategory')
        );
    }
    public function update(CarCategoryRequest $request, CarCategory $carCategory): \Illuminate\Http\RedirectResponse
    {
        $carCategory->update($request->validated());

        return redirect()
            ->route('admin.heavy-vehicle-categories.index')
            ->with('success', 'Category updated successfully.');
    }
    public function destroy(CarCategory $carCategory): \Illuminate\Http\RedirectResponse
    {
        $carCategory->delete();

        return redirect()
            ->route('admin.heavy-vehicle-categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
