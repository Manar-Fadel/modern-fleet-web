<?php

namespace App\Http\Controllers\Api\web;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\EquipmentModelResource;
use App\Http\Resources\YearResource;
use App\Models\EquipmentBrand;
use App\Models\EquipmentModel;
use App\Models\ManufacturingYear;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index($type, Request $request): JsonResponse
    {
        $search_word = $request->input('search_word');

        if ($type == 'cars') {
            $query = EquipmentBrand::cars();

        }elseif ($type == 'heavy-vehicles') {
            $query = EquipmentBrand::heavyVehicle();
        }else{
            $query = EquipmentBrand::query();
        }
        $brands = $query->when(!empty($search_word), function ($innerQuery) use ($search_word) {
            $innerQuery->where(function ($query) use ($search_word) {
                            $query->where('brand_name_ar', 'like', '%' . $search_word . '%')
                                ->orWhere('brand_name_en', 'like', '%' . $search_word . '%');
                        });
                    })->orderBy('is_main', 'DESC')
                        ->get();

        return response()->json([
            'status' => 'true',
            'data' => [
                'brands' => BrandResource::collection($brands)
            ]
        ]);
    }
    public function getBrandModels($id, Request $request): JsonResponse
    {
        $models = EquipmentModel::where('brand_id', $id)->orderBy('id', 'ASC')->get();

        return response()->json([
            'status' => true,
            'data' => [
                'models' => EquipmentModelResource::collection($models),
            ]
        ]);
    }
    public function years(Request $request): JsonResponse
    {
        $models = ManufacturingYear::query()->orderBy('value', 'DESC')->get();
        return response()->json([
            'status' => 'true',
            'data' => [
                'years' => YearResource::collection($models)
            ]
        ]);
    }
}
