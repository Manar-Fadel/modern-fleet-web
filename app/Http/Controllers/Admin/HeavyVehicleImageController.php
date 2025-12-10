<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeavyVehicleImage;
use Illuminate\Support\Facades\DB;

class HeavyVehicleImageController extends Controller
{
    /**
     * Set image as main image for a heavy vehicle
     */
    public function setMain(HeavyVehicleImage $image): \Illuminate\Http\RedirectResponse
    {
        DB::transaction(function () use ($image) {

            // 1️⃣ إلغاء الصورة الرئيسية القديمة
            HeavyVehicleImage::where('heavy_vehicle_id', $image->heavy_vehicle_id)
                ->where('is_main', true)
                ->update(['is_main' => false]);

            // 2️⃣ تعيين الصورة الجديدة
            $image->update([
                'is_main' => true,
            ]);
        });

        return back()->with('success', 'Main image updated successfully.');
    }
}
