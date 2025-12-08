<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUsForm;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index($brand_id = null): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $models = ContactUsForm::query()->paginate(20);

        return view('cpanel.contact.index', compact('models'));
    }
    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        ContactUsForm::find($id)->delete();
        Session::flash('message', 'Data deleted successfully');
        return redirect()->back();
    }




}
