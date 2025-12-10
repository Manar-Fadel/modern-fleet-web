<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandModelResource;
use App\Managers\AdminManager;
use App\Models\EquipmentBrand;
use App\Models\EquipmentModel;
use App\Models\HeavyVehicleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BrandController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $brands = EquipmentBrand::query()->orderBy('id', 'DESC')->paginate(21);
        return view('cpanel.brand.index', ['brands' => $brands]);
    }
    public function brandModels($id): \Illuminate\Http\JsonResponse
    {
        $models = EquipmentModel::where('brand_id', $id)->orderBy('name_en', 'ASC')->get();
        return response()->json(BrandModelResource::collection($models));
    }
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (empty($request->get('name_ar')) || empty($request->get('name_en'))) {
            Session::flash('error', 'Pleas Fill Data Correctly');
            return redirect()->back();
        }

        $model = new EquipmentBrand;
        $model->name_ar = $request->get('name_ar');
        $model->name_en = $request->get('name_en');
        if ($request->has('image')) {
            $model->logo = AdminManager::uploadImageFile($request->file('image'), 'uploads/brands/');
        }

        if ($model->save()) {
            Session::flash('message', 'Data added successfully');
        } else {
            Session::flash('error', 'Pleas Fill Data Correctly');
        }

        return redirect()->back();
    }
    public function storeModel(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (empty($request->get('brand_id')) || empty($request->get('name_ar')) || empty($request->get('name_en'))) {
            Session::flash('error', 'Pleas Fill Data Correctly');
            return redirect()->back();
        }

        $brand  = EquipmentBrand::find($request->get('brand_id'));
        if (!$brand instanceof EquipmentBrand){
            Session::flash('error', 'EquipmentBrand not found');
        }
        $model = new EquipmentModel();
        $model->brand_id = $request->get('brand_id');
        $model->name_ar = $request->get('name_ar');
        $model->name_en = $request->get('name_en');
        if ($model->save()) {
            Session::flash('message', 'Data added successfully');
        } else {
            Session::flash('error', 'Pleas Fill Data Correctly');
        }

        return redirect()->back();
    }
    public function update($id): \Illuminate\Http\RedirectResponse
    {
        $model = EquipmentBrand::find($id);
        if ($model instanceof EquipmentBrand) {
            $model->fill(request()->all());
            if ($model->save()) {
                $model->touch();
                Session::flash('success', 'Data updated successfully');
            }
        }

        return redirect()->back();
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $model = EquipmentBrand::find($id);
        if ($model instanceof EquipmentBrand) {
            // check there is no orders to this brand,
            $brand_orders_count = HeavyVehicleRequest::where('brand_id', $model->id)->count();
            if ($brand_orders_count > 0) {
                Session::flash('error', "EquipmentBrand has orders before, shouldn't be deleted");
                return redirect()->back();
            }

            $model->models()->delete();
            if ($model->delete()) {
                Session::flash('message', 'Data deleted successfully');
            }
        }

        return redirect()->back();
    }

    public function deleteModel($id): \Illuminate\Http\RedirectResponse
    {
        $model = EquipmentModel::find($id);
        if ($model instanceof EquipmentModel) {
            if (count($model->heavyVehicles) > 0){
                Session::flash('error', "Model has vehicles related to it, shouldn't be deleted");
                return redirect()->back();
            }
            if (count($model->heavyVehicleRequests) > 0){
                Session::flash('error', "Model has orders related to it, shouldn't be deleted");
                return redirect()->back();
            }
            if ($model->delete()) {
                Session::flash('message', 'Model deleted successfully');
            }
        }

        return redirect()->back();
    }

}
