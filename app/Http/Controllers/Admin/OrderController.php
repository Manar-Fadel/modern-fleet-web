<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Managers\Constants;
use App\Managers\ExcelManager;
use App\Models\Brand;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $currentMonthText = Carbon::now()->format('M');

        return view('cpanel.order.index', [
            'brands' => Brand::pluck('brand_name_en', 'id')->toArray(),
            'order_statuses' => OrderStatus::cases(),
            'currentMonth' => $currentMonthText,
            'years' => Constants::YEARS_LIST,
            'months' => Constants::MONTHS_LIST,
            'weeks' => Constants::WEEKS_LIST,
        ]);
    }

    public function export(Request $request): \Illuminate\Http\RedirectResponse
    {
        $year = empty($request->get('year')) ? Carbon::now()->year : $request->get('year');
        $month = empty($request->get('month')) ? Carbon::now()->month : $request->get('month');
        $search_word = $request->get('search_word');

        $to_date = Carbon::now();
        $from_date = Carbon::now()->subDays(7);

        if (! empty($request->get('week'))) {
            if ($request->get('week') == 'FIRST_WEEK') {
                $from_date = Carbon::parse($year.'-'.$month.'-'.'01');
                $to_date = Carbon::parse($year.'-'.$month.'-'.'07'.' 23:59:59');
            } elseif ($request->get('week') == 'SECOND_WEEK') {
                $from_date = Carbon::parse($year.'-'.$month.'-'.'07');
                $to_date = Carbon::parse($year.'-'.$month.'-'.'14'.' 23:59:59');

            } elseif ($request->get('week') == 'THIRD_WEEK') {
                $from_date = Carbon::parse($year.'-'.$month.'-'.'14');
                $to_date = Carbon::parse($year.'-'.$month.'-'.'24'.' 23:59:59');

            } elseif ($request->get('week') == 'FOURTH_WEEK') {
                $from_date = Carbon::parse($year.'-'.$month.'-'.'24');
                $to_date = Carbon::parse($from_date)->endOfMonth();
            }
        }else{
            $from_date = Carbon::parse($year.'-'.$month.'-'.'01');
            $to_date = Carbon::parse($from_date)->endOfMonth();
        }

        $orders = Order::whereDate('created_at', '>=', $from_date)
            ->whereDate('created_at', '<=', $to_date)
            ->when(! empty($search_word), function ($query) use ($search_word) {
                return $query->where('order_number', 'like', '%'.$search_word.'%')
                    ->orWhere('description', 'like', '%'.$search_word.'%');
            })
            ->has('user')
            ->orderBy('id', 'DESC')
            ->get();

        if (count($orders) <= 0){
            return redirect()->back();
        }

        ExcelManager::exportOrders($orders);
        return redirect()->back();
    }

}
