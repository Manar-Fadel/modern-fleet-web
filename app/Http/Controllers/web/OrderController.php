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
    public function accept($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $quotation = CarRequestQuotation::find($id);
        if (!$quotation instanceof CarRequestQuotation) {
            return redirect()->back();
        }
        $order = CarRequest::find($quotation->car_request_id);
        if (!$order instanceof CarRequest) {
            Session::flash('error', Lang::get('web.Order not found'));
            return redirect()->back();
        }
        if ($order->status !== Constants::PENDING) {
            Session::flash('error', Lang::get('web.other offer already accepted'));
            return redirect()->back();
        }
        $quotation->status = Constants::ACCEPTED;
        if ($quotation->save()) {
            $order->status = Constants::ACCEPTED;
            $order->accepted_user_id = $quotation->user_id;
            $order->accepted_quotation_id = $quotation->id;
            if ($order->save()) {

                Session::flash(
                    'message',
                    Lang::get('web.Offer accepted successfully', [], app()->getLocale())
                );
            }
        }

        return redirect()->back();
    }
    public function  decline($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $offer = CarRequestQuotation::find($id);
        if (!$offer instanceof CarRequestQuotation) {
            return redirect()->back();
        }
        $order = CarRequest::find($offer->car_request_id);
        if (!$order instanceof CarRequest) {
            Session::flash('error', Lang::get('web.Order not found'));
            return redirect()->back();
        }
        $offer->status = Constants::REJECTED;
        if ($offer->save()) {
            Session::flash(
                'message',
                Lang::get('web.Offer declined successfully', [], app()->getLocale())
            );
        }

        return redirect()->back();
    }

}
