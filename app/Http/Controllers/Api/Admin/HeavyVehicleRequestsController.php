<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeOrderStatusRequest;
use App\Http\Resources\OfferResource;
use App\Http\Resources\CarRequestResource;
use App\Managers\Constants;
use App\Models\CarQuotation;
use App\Models\CarRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;

class HeavyVehicleRequestsController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $year = empty($request->get('year')) ? Carbon::now()->year : $request->get('year');
        $month = empty($request->get('month')) ? Carbon::now()->month : $request->get('month');
        $search_word = $request->get('search_word');
        $brand_id = $request->get('brand_id');

        $stat_start_date = $request->get('stat_start_date');
        $stat_to_date = $request->get('stat_to_date');

        if (empty($request->get('year')) && empty($request->get('month'))) {
            $to_date = Carbon::now();
            $from_date = Carbon::now()->subDays(7);
        }

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

        if (!is_null($stat_start_date) && !is_null($stat_to_date)) {
            $stat_start_date = Carbon::parse($stat_start_date)->startOfDay();
            $stat_to_date = Carbon::parse($stat_to_date)->startOfDay();
            $orders = CarRequest::whereDate('created_at', '>=', $stat_start_date)
                ->whereDate('created_at', '<=', $stat_to_date);
        }else{
            $orders = CarRequest::whereDate('created_at', '>=', $from_date)
                ->whereDate('created_at', '<=', $to_date);
        }

        $orders = $orders->where('type', 'heavy_vehicle')
            ->when(! empty($search_word), function ($query) use ($search_word) {
                return $query->where('order_number', 'like', '%'.$search_word.'%')
                    ->orWhere('description', 'like', '%'.$search_word.'%');
            })->when(! empty($brand_id), function ($query) use ($brand_id) {
                return $query->whereHas('items', function ($q) use ($brand_id){
                    $q->where('brand_id', $brand_id);
                });
            })
            ->withTrashed()
            ->with([
                'items.brand',
                'items.model',
                'items.year',
                'items.images',
            ])
            ->orderBy('id', 'DESC')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('d-m-Y');
            });

        $data = [];
        $orders->collect()->each(function ($item, $key) use (&$data) {
            $data[$key] = CarRequestResource::collection($item);
        });

        return Response::json([
            'status' => true,
            'data' => [
                'lists' => $data,
            ]
        ]);
    }
    public function userOrders($id, Request $request): \Illuminate\Http\JsonResponse
    {

        $search_word = $request->get('search_word');
        $brand_id = $request->get('brand_id');

        $models = CarRequest::where('user_id', $id)
            ->when(! empty($search_word), function ($query) use ($search_word) {
                return $query->where('order_number', 'like', '%'.$search_word.'%')
                    ->orWhere('description', 'like', '%'.$search_word.'%');
            })->when(! empty($brand_id), function ($query) use ($brand_id) {
                return $query->where('brand_id', $brand_id);
            })
            ->withTrashed()
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return Response::json([
            'status' => true,
            'data' => [
                "total" => $models->total(),
                "per_page" => $models->perPage(),
                "next_page_url" => $models->nextPageUrl(),
                "prev_page_url" => $models->previousPageUrl(),
                'orders' => CarRequestResource::collection($models)
            ],
        ]);
    }
    public function offers($id): \Illuminate\Http\JsonResponse
    {
        $offers = CarQuotation::where('request_id', $id)->orderBy('id', 'DESC')->get();

        return Response::json([
            'status' => true,
            'offers' => OfferResource::collection($offers),
        ]);
    }
    public function changeStatus($id, ChangeOrderStatusRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();

            $model = CarRequest::find($id);
            if (!$model instanceof CarRequest) {
                return Response::json([
                    'status' => false,
                    'message' => 'Order not found',
                ]);
            }

            if (in_array($request->get('status'), [Constants::ACCEPTED])) {
                $offer = CarQuotation::find($request->get('offer_id'));
                if (!$offer instanceof CarQuotation) {
                    return Response::json([
                        'status' => false,
                        'message' => 'Offer not found',
                    ]);
                }
                $offer->status = $request->get('status');
                if ($offer->save()) {
                    $model->confirmed_offer_id = $offer->id;
                    $model->confirmed_dealer_id = $offer->user_id;
                    $model->status = $request->get('status');
                    $model->save();
                }
            }

            $model->status = $request->get('status');
            if ($model->save()) {
                return Response::json([
                    'status' => true,
                    'message' => 'Order updated successfully',
                    'order' => new CarRequestResource($model),
                ]);
            }

        } catch (\Throwable $e) {
            DB::rollBack();
        }
        return Response::json([
            'status' => false,
            'message' => 'Error in saving order',
        ]);
    }
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();

            $model = CarRequest::find($id);
            if (!$model instanceof CarRequest) {
                throw new \Exception('Car request not found');
            }

            $model->quotations()->delete();
            $model->delete();
            DB::commit();

            return Response::json([
                'status' => true,
                'message' => 'Order deleted successfully',
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return Response::json([
                'status' => false,
                'message' => 'Error in deleting Order',
                'exception_error' => $e->getMessage(),
            ]);
        }
    }

}
