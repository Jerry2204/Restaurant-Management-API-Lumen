<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ApiResponse;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function createOrder(Request $request)
    {
        $this->validate($request, [
            'table_id' => 'required',
            'items' => 'required|array',
            'items.*.menu_id' => 'required',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        try {

            # Start Transaction
            DB::beginTransaction();

            # Step 1: Save order in orders table
            $order = new Order();
            $order->table_id = $request->input('table_id');
            $order->total_amount = 0;
            $order->save();

            $totalAmount = 0;

            # Step 2: Save order items into Order Item
            foreach($request->input('items') as $item)
            {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->menu_id = $item['menu_id'];
                $orderItem->quantity = $item['quantity'];
                $orderItem->price = $item['price'];
                $orderItem->save();

                $totalAmount += $orderItem->quantity * $orderItem->price;
            }

            # Step 3: Update total_amount in order tables
            $order->total_amount = $totalAmount;
            $order->save();

            # Commit transaction
            DB::commit();

            $data = Order::with('orderItems')->find($order->id);

            return ApiResponse::success($data, 'Order created successfully!', 201);
        } catch(\Exception $e) {
            # Rollback when error
            DB::rollBack();

            return ApiResponse::error('', 500, $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|string|in:pending,in_progress,completed,cancelled'
        ]);

        $order = Order::find($id);

        if (!$order) {
            return ApiResponse::error('Order Not Found!', 404);
        }

        $order->status = $request->input('status');
        $order->save();

        return ApiResponse::success($order, 'Order status updated succesfully!');
    }

}
