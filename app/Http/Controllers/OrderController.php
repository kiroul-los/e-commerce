<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $user = auth()->user();

        // Get the user's cart items
        $cartItems = $user->products; // Assuming you have the cart relation defined as shown before

        // Check if the user has items in their cart
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        // Return the order creation view with the cart items and user data
        return view('order.create', compact('user', 'cartItems'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'payment_method' => 'required|string',
            'address' => 'required|string',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Create the order
        $order = $user->orders()->create([
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending', // You can modify this based on the payment method
            'delivery_status' => 'pending', // You can modify this based on delivery status
        ]);

        // Loop through the cart items and create order items
        foreach ($user->products as $cartItem) {
            $order->products()->attach($cartItem->id, [
                'quantity' => $cartItem->pivot->quantity,
                'price' => $cartItem->pivot->price,
                'product_name' => $cartItem->pivot->product_name,
                'image' => $cartItem->pivot->image,
            ]);
        }

        // Clear the user's cart (optional)
        $user->products()->detach();

        // Redirect with success message
        return redirect()->route('order.show', $order->id)->with('success', 'Order created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
