<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarImage;
use Illuminate\Support\Facades\Storage;

class CarImageController extends Controller
{
    public function setMain(CarImage $image): \Illuminate\Http\RedirectResponse
    {
        CarImage::where('car_id', $image->car_id)
            ->update(['is_main' => false]);

        $image->update(['is_main' => true]);

        return back()->with('success','Main image updated');
    }
    public function destroy(CarImage $image): \Illuminate\Http\RedirectResponse
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();

        return back()->with('success','Image deleted successfully');
    }
}
