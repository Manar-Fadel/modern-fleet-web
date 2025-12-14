<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(User::paginate(20));
    }

    public function show($id): JsonResponse
    {
        return response()->json(User::findOrFail($id));
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['is_verified_email'] = true;
        $data['is_verified_admin'] = true;
        $data['email_verified_at'] = Carbon::now();
        $user = User::create($data);

        return response()->json([
            'status' => 'true',
            'message' => 'تمت إضافة المستخدم بنجاح',
            'data' => [
                'user' => new UserResource($user)
            ]],
            201
        );
    }

    public function userOrders($id, Request $request): \Illuminate\Http\JsonResponse
    {
        $search_word = $request->get('search_word');
        $brand_id = $request->get('brand_id');

        $models = Order::where('user_id', $id)
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
                'orders' => OrderResource::collection($models)
            ],
        ]);
    }

}
