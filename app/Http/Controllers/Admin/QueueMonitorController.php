<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QueueMonitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class QueueMonitorController extends Controller
{
    /**
     * List all queue jobs
     */
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $query = QueueMonitor::query();

        // ✅ Filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('job_class')) {
            $query->where('job_class', 'like', '%' . $request->job_class . '%');
        }

        $monitors = $query->latest()->paginate(20);

        return view('cpanel.queue.index', compact('monitors'));
    }

    /**
     * View job details
     */
    public function show(QueueMonitor $monitor): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('cpanel.queue.show', compact('monitor'));
    }

    /**
     * Retry failed job
     */
    public function retry(QueueMonitor $monitor): \Illuminate\Http\RedirectResponse
    {
        if ($monitor->status !== 'failed') {
            return back()->with('error', 'Job is not failed.');
        }

        try {
            dispatch(new $monitor->job_class());
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Job re-dispatched successfully.');
    }

    /**
     * Delete job record
     */
    public function destroy(QueueMonitor $monitor): \Illuminate\Http\RedirectResponse
    {
        $monitor->delete();

        return redirect()
            ->route('admin.queue.index')
            ->with('success', 'Queue record deleted.');
    }
}
