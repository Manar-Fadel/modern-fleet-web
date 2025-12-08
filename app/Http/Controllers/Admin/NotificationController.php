<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $type = $request->get('type');
        $search_word = $request->get('search_word');

        $models = Notification::query()
            ->when(! empty($type), function ($query) use ($type) {
                return $query->where('type', $type);
            })
            ->when(! empty($search_word), function ($query) use ($search_word) {
                return $query->where('message_ar', 'like', '%'.$search_word.'%')
                            ->orWhere('message_en', 'like', '%'.$search_word.'%');
            })->orderBy('id', 'DESC')
            ->paginate(20);

        $types = Notification::query()->distinct('type')->pluck('type')->toArray();
        return view('cpanel.notifications.index', [
            'models' => $models,
            'models_count' => $models->total(),
            'types' => $types
        ]);
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $model = Notification::find($id);
        if ($model instanceof Notification) {
            if ($model->delete()) {
                Session::flash('message', 'Notification deleted successfully');
            }
        }

        return Redirect::back();
    }


}
