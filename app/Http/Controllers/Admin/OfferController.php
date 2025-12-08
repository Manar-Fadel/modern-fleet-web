<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use App\Managers\Constants;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('cpanel.offer.index', [
            'years' => Constants::YEARS_LIST,
            'months' => Constants::MONTHS_LIST,
            'weeks' => Constants::WEEKS_LIST,
            'offer_statuses' => OfferStatus::cases(),
        ]);
    }


}
