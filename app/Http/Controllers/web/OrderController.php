<?php

namespace App\Http\Controllers\web;

use App\Jobs\DealerOfferAcceptedEmailJob;
use App\Mail\OfferAccepted;
use App\Managers\Constants;
use App\Managers\SettingsManager;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OurCar;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrderController
{
    public function orderNow():  \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        return view('web.order-now',  compact(
            'customer_care_mobile', 'customer_care_email',
            'location', 'local'
        ));
    }
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        $orders = Order::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(10);
        return view('web.my-orders', compact(
            'orders', 'customer_care_mobile', 'customer_care_email',
            'location', 'local'
        ));
    }
    public function view($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $model = Order::find($id);
        if (!$model instanceof Order) {
            return redirect()->back();
        }

        $related_cars = OurCar::where('brand_id', $model->brand_id)->take(2)->get();

        $local = app()->getLocale();
        $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
        $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
        $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

        return view('web.view-order', compact(
            'id', 'model', 'customer_care_mobile', 'customer_care_email',
            'location', 'local', 'related_cars'
        ));
    }
    public function accept($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $offer = Offer::find($id);
        if (!$offer instanceof Offer) {
            return redirect()->back();
        }
        $order = Order::find($offer->order_id);
        if (!$order instanceof Order) {
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
            $order->accepted_dealer_id = $offer->user_id;
            $order->accepted_offer_id = $offer->id;
            if ($order->save()){
                DealerOfferAcceptedEmailJob::dispatch($offer);
                Mail::to($offer->user->email)->send(new OfferAccepted($offer));

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
        $offer = Offer::find($id);
        if (!$offer instanceof Offer) {
            return redirect()->back();
        }
        $order = Order::find($offer->order_id);
        if (!$order instanceof Order) {
            return redirect()->back();
        }
        $offer->status = Constants::REJECTED;
        if ($offer->save()) {
            // handle sending email to dealer that user declined his offer,
            Session::flash(
                'message',
                Lang::get('web.Offer declined successfully', [], app()->getLocale())
            );
        }

        return redirect()->back();
    }
    public function  cancelAcceptedOffer($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $offer = Offer::find($id);
        if (!$offer instanceof Offer) {
            return redirect()->back();
        }
        $order = Order::find($offer->order_id);
        if (!$order instanceof Order) {
            return redirect()->back();
        }
        $offer->status = Constants::REJECTED;
        if ($offer->save()) {
            $order->status = Constants::PENDING;
            if ($order->save()){
                // handle sending email to dealer that user declined his offer,
                Session::flash(
                    'message',
                    Lang::get('web.Offer Acceptance cancelled successfully', [], app()->getLocale())
                );
            }
        }

        return redirect()->back();
    }

}
