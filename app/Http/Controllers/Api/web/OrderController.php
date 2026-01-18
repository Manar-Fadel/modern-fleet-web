<?php

namespace App\Http\Controllers\Api\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\AcceptOfferRequest;
use App\Http\Requests\web\CreateOrderRequest;
use App\Http\Resources\CarRequestResource;
use App\Managers\AdminManager;
use App\Managers\Constants;
use App\Models\CarQuotation;
use App\Models\CarRequest;
use App\Models\CarRequestItem;
use App\Models\CarRequestItemImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class OrderController extends Controller
{
    public function saveOrder(CreateOrderRequest $request): JsonResponse
    {
        try {
            DB::transaction(function () use ($request) {

                $order = CarRequest::create([
                    'user_id' => $request->get('user_id'),
                    'type' => 'car',
                    'status' => Constants::PENDING,
                ]);
                foreach ($request->requests as $item) {
                    $orderItem = CarRequestItem::create([
                        'car_request_id' => $order->id,
                        'brand_id' => $item['brand_id'],
                        'model_id' => $item['model_id'],
                        'manufacturing_year_id' => $item['manufacturing_year_id'],
                        'quantity' => $item['quantity'],
                        'description' => $item['description'] ?? null,

                        'is_attachments_enabled' => $item['is_attachments_enabled'] ?? false,
                        'attachment_type_id' => $item['attachment_type_id'] ?? null,
                        'attachment_description' => $item['attachment_description'] ?? null,
                    ]);

                    if (!empty($item['images'])) {
                        foreach ($item['images'] as $image) {
                            $path = AdminManager::uploadImageFile($image, 'uploads/orders/' . date('Y-m'));
                            CarRequestItemImage::create([
                                'car_request_item_id' => $orderItem->id,
                                'path' => $path,
                            ]);
                        }
                    }
                }
            });

            return response()->json([
                'status' => true,
                'message' => Lang::get('web.order created successfully', [], app()->getLocale()),
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => [
                    'trace' => $exception->getTraceAsString()
                ]
            ], 400);
        }
    }
    public function acceptOffer(AcceptOfferRequest $request, $orderId): JsonResponse
    {
        try {
            $order = CarRequest::where('id', $orderId)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            if ($order->status !== Constants::PENDING) {
                throw new \Exception('لا يمكن قبول عرض لطلب غير نشط');
            }

            DB::transaction(function () use ($order, $request) {
                $offer = CarQuotation::findOrFail($request->get('offer_id'));
                $order->update([
                    'accepted_quotations_id' => $offer->id,
                    'accepted_user_id' => $offer->user_id,
                    'status' => Constants::ACCEPTED,
                ]);
                $offer->update(['status' => Constants::ACCEPTED]);
            });

            return response()->json([
                'status' => true,
                'message' => 'تم قبول العرض بنجاح',
                'data' => [
                    'order' => new CarRequestResource($order),
                ]
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'data' => [
                    'trace' => $exception->getTraceAsString()
                ]
            ], 400);
        }
    }

}
