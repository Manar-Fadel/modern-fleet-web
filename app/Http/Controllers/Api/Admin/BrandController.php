<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $search_word = $request->get('search_word', '');

        $brands = Brand::query()
            ->when(! empty($search_word), function ($query) use ($search_word) {
            return $query->where('name_ar', 'like', '%'.$search_word.'%')
                ->orWhere('name_en', 'like', '%'.$search_word.'%');
        })->paginate(20);

        return Response::json([
            'status' => true,
            'data' => [
                'lists' => BrandResource::collection($brands),
            ]
        ]);
    }

    public function show($id): JsonResponse
    {
        return response()->json(Brand::findOrFail($id));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'logo_url' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($request->hasFile('logo_url')) {
            $validated['logo_url'] = $request->file('logo_url')->store('brands', 'public');
        }

        $brand = Brand::create($validated);

        return response()->json(['message' => 'تمت إضافة الماركة بنجاح', 'brand' => $brand], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'logo_url' => 'nullable|file|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($request->hasFile('logo_url')) {
            // حذف الصورة القديمة
            if ($brand->logo_url && Storage::disk('public')->exists($brand->logo_url)) {
                Storage::disk('public')->delete($brand->logo_url);
            }
            $validated['logo_url'] = $request->file('logo_url')->store('brands', 'public');
        }

        $brand->update($validated);

        return response()->json(['message' => 'تم تحديث الماركة بنجاح', 'brand' => $brand]);
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand->logo_url && Storage::disk('public')->exists($brand->logo_url)) {
            Storage::disk('public')->delete($brand->logo_url);
        }

        $brand->delete();
        return response()->json(['message' => 'تم حذف الماركة']);
    }

}
