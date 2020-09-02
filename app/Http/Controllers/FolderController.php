<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function changeOrder(Request $request)
    {
        $validated = $request->validate([
            "by" => "required|in:filename,size,date",
            "order" => "required|in:ASC,DESC"
        ]);

        $user = Auth::user();
        $order = $user->order;

        if (!$order) {
            $order = new Order(["user_id" => $user->id]);
        }

        $order->by = $validated["by"];
        $order->order = $validated["order"];

        $order->save();

        return response()->json(["success" => __("folder.orderchanged")]);
    }
}
