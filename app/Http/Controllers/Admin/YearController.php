<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Managers\AdminManager;
use App\Models\Year;
use Illuminate\Support\Facades\Session;

class YearController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $years = Year::query()->orderBy('value', 'DESC')->get();
        return view('cpanel.year.index', ['years' => $years]);
    }

    public function store(): \Illuminate\Http\RedirectResponse
    {
        $model = new Year;
        $model->fill(request()->all());
        if ($model->save()) {
            Session::flash('message', 'Data added successfully');
        }

        return redirect()->back();
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $model = Year::find($id);
        if ($model->orders->count() > 0){
            Session::flash('error', "Sorry, can't delete year there are orders related to it");
            return redirect()->back();
        }
        $model->delete();
        Session::flash('message', 'Data deleted successfully');

        return redirect()->back();
    }
}
