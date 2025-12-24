<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarQuotationRequest;
use App\Models\CarQuotation;
use App\Models\CarRequest;
use App\Models\User;
use Illuminate\Http\Request;

class CarQuotationController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $query = CarQuotation::query()
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

        $quotations = $query->has('request')->paginate(20)->withQueryString();
        $statuses = OfferStatus::cases();
        return view('cpanel.car_quotations.index',
            compact('quotations', 'statuses')
        );
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $users    = User::orderBy('full_name')->get();
        $requests = CarRequest::query()->latest()->get();
        $statuses = OfferStatus::cases();

        return view('cpanel.car_quotations.create',
            compact('users', 'requests', 'statuses')
        );
    }

    public function store(CarQuotationRequest $request): \Illuminate\Http\RedirectResponse
    {
        CarQuotation::create($request->validated());

        return redirect()
            ->route('admin.car-quotations.index')
            ->with('success', 'Quotation created successfully.');
    }

    public function edit(CarQuotation $carQuotation): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $users    = User::orderBy('full_name')->get();
        $requests = CarRequest::query()->latest()->get();
        $statuses = OfferStatus::cases();

        return view('cpanel.car_quotations.edit',
            compact('carQuotation', 'users', 'requests', 'statuses')
        );
    }

    public function update(CarQuotationRequest $request, CarQuotation $carQuotation): \Illuminate\Http\RedirectResponse
    {
        $carQuotation->update($request->validated());

        return redirect()
            ->route('admin.car-quotations.index')
            ->with('success', 'Quotation updated successfully.');
    }

    public function destroy(CarQuotation $carQuotation): \Illuminate\Http\RedirectResponse
    {
        $carQuotation->delete();

        return redirect()
            ->route('admin.car-quotations.index')
            ->with('success', 'Quotation deleted successfully.');
    }
}
