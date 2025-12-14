<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Managers\Constants;
use App\Models\EquipmentBrand;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CarRequestController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $currentMonthText = Carbon::now()->format('M');
        return view('cpanel.car-requests.index', [
            'brands' => EquipmentBrand::pluck('name_en', 'id')->toArray(),
            'order_statuses' => OrderStatus::cases(),
            'currentMonth' => $currentMonthText,
            'years' => Constants::YEARS_LIST,
            'months' => Constants::MONTHS_LIST,
            'weeks' => Constants::WEEKS_LIST,
        ]);
    }

}
