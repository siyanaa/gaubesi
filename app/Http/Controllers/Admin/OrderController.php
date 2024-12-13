<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{

    public function index()
    {
       
        $groupedOrders = Order::with(['user', 'product', 'cart'])
            ->get()
            ->groupBy('bill_no');

        return view('admin.order.index', compact('groupedOrders'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([ 
                'location' => 'required|string',
                'contact' => 'required|string',
                'date' => 'required|date',
                'product_ids' => 'required|array',
                'status' => 'pending', 
            ]);

            // Generate bill number
            $date = date('Ymd');
            $lastOrder = Order::whereDate('created_at', today())->latest()->first();

            $newNumber = $lastOrder
                ? str_pad(((int) substr($lastOrder->bill_no, -4)) + 1, 4, '0', STR_PAD_LEFT)
                : '0001';

            $billNo = "ORD-{$date}-{$newNumber}";

            // Create orders for each product
            foreach ($request->product_ids as $productId) {
                Order::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'location' => $request->location,
                    'contact' => $request->contact,
                    'date' => $request->date,
                    'bill_no' => $billNo
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'bill_no' => $billNo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,paid,cancelled'
    ]);

    $order = Order::findOrFail($id);
    $order->update(['status' => $request->status]);

    if ($request->ajax()) {
        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    return redirect()->back()->with('success', 'Order status updated successfully.');
}


}
