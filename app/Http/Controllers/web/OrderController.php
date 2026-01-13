<?php

namespace App\Http\Controllers\web;

use App\Managers\Constants;
use App\Models\CarRequestQuotation;
use App\Models\CarRequest;
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
        $orders = CarRequest::where('user_id', auth()->id())
            ->with([
                'items.brand',
                'items.model',
                'items.year',
                'items.images',
            ])
            ->latest()
            ->paginate(10);
        return view('web.my-orders', compact(
            'orders'
        ));
    }
    public function view($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $order = CarRequest::with([
            'items.brand',
            'items.model',
            'items.year',
            'items.images',
            'quotations.items.requestItem.brand',
            'quotations.items.requestItem.model',
            'quotations.items.requestItem.year',
        ])->findOrFail($id);
        return view('web.view-order', compact('id', 'order'));
    }
    public function accept($type, $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        if ($type == 'car-request') {
            $offer = CarRequestQuotation::find($id);
            if (!$offer instanceof CarRequestQuotation) {
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
            $offer = CarRequestQuotation::find($id);
            if (!$offer instanceof CarRequestQuotation) {
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
