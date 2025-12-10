<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateDealerRequest;
use App\Managers\AdminManager;
use App\Managers\Constants;
use App\Managers\ExcelManager;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CompanyUsersController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $trusted_status = $request->get('trusted_status');
        $search_word = $request->get('search_word');

        $from_date = null;
        $to_date = null;
        if (!empty($request->get('year')) && !empty($request->get('month'))) {
            $year = $request->get('year');
            $month = $request->get('month');
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
        }

        $models = User::when(!is_null($from_date) && !is_null($to_date), function ($query) use ($from_date, $to_date) {
                        $query->where('created_at', '>=', $from_date)
                                ->whereDate('created_at', '<=', $to_date);
                        })->where('user', Constants::COMPANY);

        $models = $models->when(! empty($trusted_status), function ($query) use ($trusted_status) {
                    if ($trusted_status == 'TRUSTED') {
                        $query->where('is_trusted', 1);
                    }elseif ($trusted_status == 'NOT_TRUSTED') {
                        $query->where('is_trusted', 0);
                    }
            })->when(! empty($search_word), function ($query) use ($search_word) {
                $query->where(function ($query) use ($search_word) {
                    $query->where('full_name', 'like', '%'.$search_word.'%')
                        ->orWhere('shop_name', 'like', '%'.$search_word.'%')
                        ->orWhere('email', 'like', '%'.$search_word.'%')
                        ->orWhere('phone_number', 'like', '%'.$search_word.'%');
                });
            })->orderBy('id', 'DESC');

        if ($request->get("action") !== null && $request->get("action") == "export") {
            $models = $models->get();
            if (count($models) <= 0){
                return redirect()->back();
            }

            ExcelManager::exportDealers($models);
            return redirect()->back();
        }else{
            $models = $models->paginate(9);
            return view('cpanel.dealers.index', [
                'models' => $models,
                'trusted_statuses' => ['TRUSTED' => 'Trusted', 'NOT_TRUSTED' => 'Not Trusted'],
                'years' => Constants::YEARS_LIST,
                'months' => Constants::MONTHS_LIST,
                'weeks' => Constants::WEEKS_LIST
            ]);
        }
    }
    public function activateEmail($id): \Illuminate\Http\RedirectResponse
    {
        $model = User::find($id);
        if ($model instanceof User) {
            if (!is_null($model->email_verified_at)){
                $model->email_verified_at = null;
            }else{
                $model->email_verified_at = Carbon::now();
            }
            $model->save();
        }

        return redirect()->back();
    }
    public function activateAccount($id): \Illuminate\Http\RedirectResponse
    {
        $model = User::find($id);
        if ($model instanceof User) {
            if($model->is_account_active == 0){
                $model->is_account_active = 1;
            }else{
                $model->is_account_active = 0;
            }
            $model->save();
        }

        return redirect()->back();
    }
    public function enableTrusted($id): \Illuminate\Http\RedirectResponse
    {
        $model = User::find($id);
        if ($model instanceof User) {
            if ($model->is_trusted == 1){
                $model->is_trusted = 0;
            }else{
                $model->is_trusted = 1;
            }
            $model->save();
        }

        return redirect()->back();
    }
    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $user = User::find($id);
        if ($user instanceof User) {
            $user->phone_number = "D".substr($user->id, 0, 2)."_".$user->phone_number;
            if (!empty($user->email)) {
                $user->email = "D-" . $user->id . "_" . $user->email;
            }
            $user->save();
            $user->delete();
        }

        return redirect()->back();
    }
    public function store(CreateDealerRequest $request): \Illuminate\Http\RedirectResponse
    {
        $model = new User();
        $model->type = Constants::DEALER;
        $model->full_name = $request->get('full_name');
        $model->email = $request->get('email');
        $model->password = Hash::make($request->get('password'));
        $model->phone_number = $request->get('phone_number');
        $model->id_number = $request->get('id_number');
        $model->is_trusted =  $request->get('is_trusted') == 1 ? 1 : 0;
        $model->is_verified_email = 1;
        $model->email_verified_at = Carbon::now();
        $model->is_verified_admin = 1;

        if ($request->has('showroom_doc')) {
            $file = $request->file('showroom_doc');
            $doc_name = AdminManager::uploadImageFile($file, 'uploads/dealers/showroom_docs/');
            $model->showroom_doc = $doc_name;
        }

        if ($model->save()) {
            Session::flash('message', 'Dealer added successfully');
        }

        return redirect()->back();
    }
    public function update($id, Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = User::find($id);
        if (!$user instanceof User) {
            return  redirect()->back();
        }
        $user->update([
            'full_name' => $request->input('full_name'),
            'shop_name' => $request->input('shop_name')
        ]);

        if ($request->has('showroom_doc')) {
            $doc_path = AdminManager::uploadImageFile($request->file('showroom_doc'), 'uploads/dealers/showroom_docs/');
            $user->showroom_doc = $doc_path;
            $user->save();
        }
        if ($request->has('document_url')) {
            $doc_path = AdminManager::uploadImageFile($request->file('document_url'), 'uploads/users/document_urls/');
            $user->document_url = $doc_path;
            $user->save();
        }
        if ($request->has('business_card_image')) {
            $doc_path = AdminManager::uploadImageFile($request->file('business_card_image'), 'uploads/bank-delegates/business_cards/');
            $user->business_card_image = $doc_path;
            $user->save();
        }
        if ($request->has('tax_certificate_doc')) {
            $doc_path = AdminManager::uploadImageFile($request->file('tax_certificate_doc'), 'uploads/users/tax_certificate/');
            $user->tax_certificate_doc = $doc_path;
            $user->save();
        }
        if ($request->has('national_address_certificate_doc')) {
            $doc_path = AdminManager::uploadImageFile($request->file('national_address_certificate_doc'), 'uploads/users/national_address_certificate/');
            $user->national_address_certificate_doc = $doc_path;
            $user->save();
        }
        if ($request->has('commercial_registry_doc')) {
            $doc_path = AdminManager::uploadImageFile($request->file('commercial_registry_doc'), 'uploads/users/commercial_registry/');
            $user->commercial_registry_doc = $doc_path;
            $user->save();
        }
        if ($request->has('representative_authorization_doc')) {
            $doc_path = AdminManager::uploadImageFile($request->file('representative_authorization_doc'), 'uploads/users/representative_authorization/');
            $user->representative_authorization_doc = $doc_path;
            $user->save();
        }

        Session::flash('message', 'Updated Successfully!');
        return \redirect()->back();
    }
    public function view($id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $model = User::find($id);
        if ($model instanceof User) {
            return view('cpanel.dealers.view', [
                'model' => $model,
                'years' => Constants::YEARS_LIST,
                'months' => Constants::MONTHS_LIST,
                'weeks' => Constants::WEEKS_LIST,
                'offer_statuses' => OfferStatus::cases(),
            ]);
        }

        return redirect()->back();
    }


}
