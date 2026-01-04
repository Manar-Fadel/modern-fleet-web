<?php

namespace App\Http\Controllers\web;

use App\Managers\Constants;
use App\Models\CarQuotation;
use App\Models\CarRequest;
use App\Models\HeavyVehicleQuotation;
use App\Models\HeavyVehicleRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class OrderController
{
    public function orderNow():  \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('web.order-now');
    }
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $car_orders = CarRequest::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(10);
        $heavy_vehicle_orders = HeavyVehicleRequest::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(10);
        return view('web.my-orders', compact(
            'car_orders', 'heavy_vehicle_orders'
        ));
    }
    public function view($type, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $model = [];
        if ($type == 'car-request') {
            $model = CarRequest::find($id);
            if (!$model instanceof CarRequest) {
                return redirect()->back();
            }

        }elseif ($type == 'heavy-vehicle-request') {
            $model = HeavyVehicleRequest::find($id);
            if (!$model instanceof HeavyVehicleRequest) {
                return redirect()->back();
            }
        }

        return view('web.view-order', compact('id', 'model', 'type'));
    }
    public function accept($type, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        if ($type == 'car-request') {
            $offer = CarQuotation::find($id);
            if (!$offer instanceof CarQuotation) {
                return redirect()->back();
            }
            $order = CarRequest::find($offer->request_id);
            if (!$order instanceof CarRequest) {
                Session::flash('error', Lang::get('web.Order not found'));
                return redirect()->back();
            }
            if ($order->status !== Constants::PENDING) {
                Session::flash('error', Lang::get('web.other offer already accepted'));
                return redirect()->back();
            }
            $offer->status = Constants::ACCEPTED;
            if ($offer->save()) {
                $order->status = Constants::ACCEPTED;
                $order->accepted_user_id = $offer->user_id;
                $order->accepted_quotations_id = $offer->id;
                if ($order->save()) {

                    Session::flash(
                        'message',
                        Lang::get('web.Offer accepted successfully', [], app()->getLocale())
                    );
                }
            }
        }elseif ($type == 'heavy-vehicle-request'){
            $offer = HeavyVehicleQuotation::find($id);
            if (!$offer instanceof HeavyVehicleQuotation) {
                return redirect()->back();
            }
            $order = HeavyVehicleRequest::find($offer->request_id);
            if (!$order instanceof HeavyVehicleRequest) {
                Session::flash('error', Lang::get('web.Order not found'));
                return redirect()->back();
            }
            if ($order->status !== Constants::PENDING) {
                Session::flash('error', Lang::get('web.other offer already accepted'));
                return redirect()->back();
            }
            $offer->status = Constants::ACCEPTED;
            if ($offer->save()) {
                $order->status = Constants::ACCEPTED;
                $order->accepted_user_id = $offer->user_id;
                $order->accepted_quotations_id = $offer->id;
                if ($order->save()) {

                    Session::flash(
                        'message',
                        Lang::get('web.Offer accepted successfully', [], app()->getLocale())
                    );
                }
            }
        }
        return redirect()->back();
    }
    public function  decline($type, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        if ($type == 'car-request') {
            $offer = CarQuotation::find($id);
            if (!$offer instanceof CarQuotation) {
                return redirect()->back();
            }
            $order = CarRequest::find($offer->request_id);
            if (!$order instanceof CarRequest) {
                return redirect()->back();
            }
            $offer->status = Constants::REJECTED;
            if ($offer->save()) {
                Session::flash(
                    'message',
                    Lang::get('web.Offer declined successfully', [], app()->getLocale())
                );
            }
        }elseif ($type == "heavy-vehicle-request") {
            $offer = HeavyVehicleQuotation::find($id);
            if (!$offer instanceof HeavyVehicleQuotation) {
                return redirect()->back();
            }
            $order = HeavyVehicleRequest::find($offer->request_id);
            if (!$order instanceof HeavyVehicleRequest) {
                return redirect()->back();
            }
            $offer->status = Constants::REJECTED;
            if ($offer->save()) {
                Session::flash(
                    'message',
                    Lang::get('web.Offer declined successfully', [], app()->getLocale())
                );
            }
        }
        return redirect()->back();
    }

}
