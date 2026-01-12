<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Managers\Constants;
use App\Models\CarQuotation;
use App\Models\CarRequest;
use App\Models\EquipmentBrand;
use App\Models\EquipmentModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $individual_users_count = User::where('type', Constants::CUSTOMER)->count();
        $companies_users_count = User::where('type', Constants::COMPANY)->count();

        $pending_orders_count = CarRequest::where('status', Constants::PENDING)->count();
        $accepted_orders_count = CarRequest::where('status', Constants::ACCEPTED)->count();

        $pending_offers_count = CarQuotation::where('status', Constants::PENDING)->count();
        $accepted_offers_count = CarQuotation::where('status', Constants::ACCEPTED)->count();

        $brands_count = EquipmentBrand::count();
        $models_count = EquipmentModel::count();

        return view('cpanel.dashboard', [
            'pending_orders_count' => $pending_orders_count,
            'accepted_orders_count' => $accepted_orders_count,
            'pending_offers_count' => $pending_offers_count,
            'accepted_offers_count' => $accepted_offers_count,
            'brands_count' => $brands_count,
            'models_count' => $models_count,
            'individual_users_count' => $individual_users_count,
            'companies_users_count' => $companies_users_count
        ]);
    }
    public function logs(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('cpanel.logs.index', [
            'years' => Constants::YEARS_LIST,
            'months' => Constants::MONTHS_LIST,
            'weeks' => Constants::WEEKS_LIST
            ]);
    }
}
