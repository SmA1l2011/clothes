<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        if (isset($_GET["sortBy"])) {
            switch ($_GET["sortBy"]) {
                case "default":
                    $sortBy = "id";
                break;

                case "price down":
                    $sortBy = "priceD";
                break;

                case "price up":
                    $sortBy = "priceU";
                break;
                    
                default:
                    $sortBy = $_GET["sortBy"];
                break;
            }
        } else {
            $sortBy = "id";
        }
        $filters = [];
        foreach ($_GET as $key => $value) {
            $filters[$key] = $value;
        }
        $allUsers = User::getAllUsers();
        $allOrders = Order::getAllOrders($sortBy, $filters);
        return view("admin/orders/index", compact("allOrders", "allUsers"));
    }

    public function delete($id)
    {
        Order::orderDelete($id);
        return back();
    }
}
