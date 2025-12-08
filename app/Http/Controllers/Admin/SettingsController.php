<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $settings = Settings::get();

        return view('cpanel.settings.index', ['settings' => $settings]);
    }

    public function list(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $settings = Settings::query()->paginate(20);
        return view('cpanel.settings.list', ['models' => $settings]);
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $settings = Settings::get();
        foreach ($settings as $setting) {
            if (isset($_POST[$setting->code_key])) {
                $settingRow = Settings::find($setting->id);
                $settingRow->value = $_POST[$setting->code_key];
                $settingRow->save();
            }
        }

        return redirect()->back();
    }
    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $model = Settings::find($id);
        if ($model instanceof Settings) {
            $model->delete();
            Session::flash('success', 'Data deleted successfully');
        }
        return redirect()->back();
    }
}
