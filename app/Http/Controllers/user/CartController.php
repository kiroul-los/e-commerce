<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add a product to the cart
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Check if the product is already in the cart for the authenticated user
        $cartItem = Auth::user()->carts()->where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Auth::user()->carts()->create([
                'product_id' => $product->id,
                'product_name' => $product->title,
                'price' => $product->discount_price ?? $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // View the cart for the authenticated user
    public function viewCart()
    {
        $cartItems = Auth::user()->carts;
        return view('cart.index', compact('cartItems'));
    }

    // Update the quantity of a product in the cart
    public function updateCart(Request $request, $id)
    {
        $cartItem = Auth::user()->carts()->findOrFail($id);

        if ($cartItem) {
            $cartItem->update(['quantity' => $request->quantity]);
            return redirect()->back()->with('success', 'Cart updated successfully!');
        }

        return redirect()->back()->with('error', 'Product not found in cart!');
    }

    // Remove a product from the cart
    public function removeFromCart($id)
    {
        $cartItem = Auth::user()->carts()->findOrFail($id);

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Product removed from cart!');
        }

        return redirect()->back()->with('error', 'Product not found in cart!');
    }

    // Clear the cart for the authenticated user
    public function clearCart()
    {
        Auth::user()->carts()->delete();
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}
