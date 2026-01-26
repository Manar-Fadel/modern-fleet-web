<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OfferStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreCarRequestQuotationRequest;
use App\Http\Requests\CarQuotationRequest;
use App\Managers\Constants;
use App\Models\CarRequestQuotation;
use App\Models\CarRequest;
use App\Models\CarRequestQuotationItem;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CarQuotationController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $query = CarRequestQuotation::query()
            ->with(['request', 'items', 'images'])
            ->latest();

        // type cars or heavy-vehicles,
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

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

    public function create($id, Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $model = CarRequest::with('items.brand','items.model','items.year', 'user')
            ->has('items')
            ->has('user')
            ->findOrFail($id);

        if (!$model instanceof \App\Models\CarRequest) {
            return Redirect::back();
        }
        if ($request->filled('type') && $request->input('type') == 'heavy_vehicle') {
            return view('cpanel.heavy_vehicle_quotations.create',
                compact('id', 'model')
            );

        }else {
            return view('cpanel.car_quotations.create',
                compact('id', 'model')
            );
        }
    }

    public function store($id, StoreCarRequestQuotationRequest $request): \Illuminate\Http\RedirectResponse
    {
        $carRequest = CarRequest::findOrFail($id);
        DB::transaction(function () use ($request, $carRequest) {

            $quotation = CarRequestQuotation::create([
                'type' => $carRequest->type,
                'car_request_id' => $carRequest->id,
                'total_amount' => $request->total_amount,
                'vat_amount' => $request->vat_amount ?? 0,
                'total_with_vat' => $request->total_with_vat,
                'status' => Constants::PENDING,
            ]);

            foreach ($request->items as $item) {
                CarRequestQuotationItem::create([
                    'car_request_quotation_id' => $quotation->id,
                    'car_request_item_id' => $item['item_id'],
                    'unit_price' => $item['unit_price'],
                    'attachment_price' => $item['attachment_price'] ?? 0,
                    'total_price' => $item['total_price'],
                    'vat_amount' => $item['vat_amount'] ?? 0,
                    'total_with_vat' => $item['total_with_vat'],
                    'is_with_vat' => isset($item['is_with_vat']),
                    'description' => $item['description'] ?? null,
                ]);
            }
        });

        return redirect()
            ->route('admin.car-quotations.index', ['type' => 'car'])
            ->with('success', 'Quotation created successfully.');
    }
    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $quotation = CarRequestQuotation::findOrFail($id);
        $quotation->load([
            'request.items.brand',
            'request.items.model',
            'request.items.year',
            'items'
        ]);

        return view('cpanel.car_quotations.edit', compact('quotation'));
    }

    public function update($id, StoreCarRequestQuotationRequest $request): \Illuminate\Http\RedirectResponse
    {
        $quotation = CarRequestQuotation::findOrFail($id);
        DB::transaction(function () use ($request, $quotation) {
            $quotation->update([
                'total_amount' => $request->total_amount,
                'vat_amount' => $request->vat_amount ?? 0,
                'total_with_vat' => $request->total_with_vat,
            ]);

            foreach ($request->items as $item) {

                $quotationItem = CarRequestQuotationItem::where('id', $item['quotation_item_id'])
                    ->where('car_request_quotation_id', $quotation->id)
                    ->firstOrFail();

                $quotationItem->update([
                    'unit_price' => $item['unit_price'],
                    'attachment_price' => 0,
                    'total_price' => $item['total_price'],
                    'vat_amount' => $item['vat_amount'] ?? 0,
                    'total_with_vat' => $item['total_with_vat'],
                    'is_with_vat' => isset($item['is_with_vat']),
                    'description' => $item['description'] ?? null,
                ]);
            }
        });

        return redirect()
            ->route('admin.car-quotations.index', ['type' => 'car'])
            ->with('success', 'Quotation has been updated successfully.');
    }


    public function destroy(CarRequestQuotation $carQuotation): \Illuminate\Http\RedirectResponse
    {
        $carQuotation->items->delete();
        $carQuotation->delete();

        return redirect()
            ->route('admin.car-quotations.index')
            ->with('success', 'Quotation deleted successfully.');
    }
    public function generatePdf(CarRequestQuotation $quotation): \Illuminate\Http\Response
    {
        $quotation->load([
            'request.user',
            'request.items.brand',
            'request.items.model',
            'request.items.year',
            'items.requestItem'
        ]);

        $pdf = Pdf::loadView('cpanel.pdf.quotation', compact('quotation'))
            ->setPaper('A4', 'portrait');

        return $pdf->download("Quotation_{$quotation->id}.pdf");
    }

}
