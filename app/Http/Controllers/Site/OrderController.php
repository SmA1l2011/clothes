<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index()
    {
        // $orders = Session::get("orders");
        // unset($orders[""]);
        // Session::put("orders", $orders);
        if (Session::get("orders") !== null) {
            $count = key(Session::get("orders"));
            $orderProduct = Product::getAllProducts("id", [], Session::get("orders"));
        } else {
            $count = null;
            $orderProduct = [];
        }
        $allOrders = Order::getAllOrders();
        return view("site/orders/index", compact("allOrders", "orderProduct", "count"));
    }

    public function store(Request $request)
    {
        $orders = Session::get("orders");
        if ($request->post("order") !== null) {
            foreach ($orders as $key => $order) {
                $data = [
                    "product_id" => $order[0],
                    "user_id" => auth()->user()->id,
                    "count" => $order[1],
                    "price" => ($order[2] * $order[1]),
                    "created_at" => now(),
                    "updated_at" => now(),
                ];
                Order::ordersCreate($data);
            }
            $orders = [];
        }
        if ($request->post("id") !== null) {
            $orders[$request->post("id")][1] = $request->post("count");
        }
        if ($request->post("delete") !== null) {
            foreach ($orders as $key => $order) {
                if ($order[0] == $request->post("product_id")) {
                    unset($orders[$key]);
                    break;
                }
            }
        }
        if (!empty($orders)) {
            Session::put("orders", $orders);
        } else {
            Session::forget("orders");
        }
        return to_route("orderIndex");
    }
}
