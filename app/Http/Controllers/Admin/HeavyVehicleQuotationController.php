<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeavyVehicleQuotationRequest;
use App\Models\HeavyVehicleQuotation;
use App\Models\HeavyVehicleRequest;
use App\Models\User;
use Illuminate\Http\Request;

class HeavyVehicleQuotationController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $query = HeavyVehicleQuotation::query()
            ->with(['user', 'request'])
            ->latest();

        // ✅ Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // ✅ VAT filter
        if ($request->filled('is_with_vat')) {
            $query->where('is_with_vat', $request->is_with_vat);
        }

        // ✅ Date range filter
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $quotations = $query->paginate(20)->withQueryString();
        $statuses = OfferStatus::cases();
        return view('cpanel.heavy_vehicle_quotations.index',
            compact('quotations', 'statuses')
        );
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $users    = User::orderBy('full_name')->get();
        $requests = HeavyVehicleRequest::query()->latest()->get();
        $statuses = OfferStatus::cases();

        return view('cpanel.heavy_vehicle_quotations.create',
            compact('users', 'requests', 'statuses')
        );
    }

    public function store(HeavyVehicleQuotationRequest $request): \Illuminate\Http\RedirectResponse
    {
        HeavyVehicleQuotation::create($request->validated());

        return redirect()
            ->route('admin.heavy-vehicle-quotations.index')
            ->with('success', 'Quotation created successfully.');
    }

    public function edit(HeavyVehicleQuotation $heavyVehicleQuotation): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $users    = User::orderBy('full_name')->get();
        $requests = HeavyVehicleRequest::query()->latest()->get();
        $statuses = OfferStatus::cases();

        return view('cpanel.heavy_vehicle_quotations.edit', 'statuses',
            compact('heavyVehicleQuotation', 'users', 'requests')
        );
    }

    public function update(HeavyVehicleQuotationRequest $request, HeavyVehicleQuotation $heavyVehicleQuotation): \Illuminate\Http\RedirectResponse
    {
        $heavyVehicleQuotation->update($request->validated());

        return redirect()
            ->route('admin.heavy-vehicle-quotations.index')
            ->with('success', 'Quotation updated successfully.');
    }

    public function destroy(HeavyVehicleQuotation $heavyVehicleQuotation): \Illuminate\Http\RedirectResponse
    {
        $heavyVehicleQuotation->delete();

        return redirect()
            ->route('admin.heavy-vehicle-quotations.index')
            ->with('success', 'Quotation deleted successfully.');
    }
}
