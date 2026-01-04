<?php

namespace App\Http\Controllers\Api\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\AcceptOfferRequest;
use App\Http\Requests\web\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Managers\AdminManager;
use App\Managers\Constants;
use App\Models\CarQuotation;
use App\Models\CarRequest;
use App\Models\CarRequestImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function saveOrder(CreateOrderRequest $request): JsonResponse
    {
        try {
            $order = CarRequest::create([
                'user_id' => $request->get('user_id'),
                'vin_number' => $request->input('vin_number'),
                'brand_id' => $request->input('brand_id'),
                'model_id' => $request->input('model_id'),
                'year_id' => $request->input('year_id'),
                'description' => $request->input('description'),
                'status' => Constants::PENDING,
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = AdminManager::uploadImageFile($image, 'uploads/orders/'. date('Y-m'));
                    $order_img = new CarRequestImage();
                    $order_img->car_request_id = $order->id;
                    $order_img->path = $path;
                    $order_img->save();
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'تم إنشاء الطلب بنجاح',
                'data' => [
                    'order' => new OrderResource($order),
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
                    'order' => new OrderResource($order),
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
