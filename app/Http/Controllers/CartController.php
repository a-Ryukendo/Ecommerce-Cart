<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Hardcoded products array
    private $products = [
        1 => [
            'id' => 1,
            'name' => 'Laptop',
            'price' => 74999.00,
            'description' => 'High-performance laptop for work and gaming'
        ],
        2 => [
            'id' => 2,
            'name' => 'Smartphone',
            'price' => 44999.00,
            'description' => 'Latest smartphone with advanced features'
        ],
        3 => [
            'id' => 3,
            'name' => 'Headphones',
            'price' => 11999.00,
            'description' => 'Wireless noise-cancelling headphones'
        ]
    ];

    // Display products page
    public function index()
    {
        return view('products', ['products' => $this->products]);
    }

    // Display cart page
    public function show()
    {
        $cart = session('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            if (isset($this->products[$productId])) {
                $product = $this->products[$productId];
                $subtotal = $product['price'] * $quantity;
                $cartItems[] = [
                    'id' => $productId,
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ];
                $total += $subtotal;
            }
        }

        return view('cart', [
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }

    // Add product to cart
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|min:1|max:3',
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (!isset($this->products[$productId])) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $cart = session('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.show')->with('success', 'Product added to cart successfully!');
    }

    // Update product quantity
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|min:1|max:3',
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (!isset($this->products[$productId])) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $cart = session('cart', []);
        $cart[$productId] = $quantity;
        session(['cart' => $cart]);

        return redirect()->route('cart.show')->with('success', 'Cart updated successfully!');
    }

    // Remove product from cart
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|min:1|max:3'
        ]);

        $productId = $request->input('product_id');
        $cart = session('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
            return redirect()->route('cart.show')->with('success', 'Product removed from cart!');
        }

        return redirect()->route('cart.show')->with('error', 'Product not found in cart.');
    }

    // Clear entire cart
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.show')->with('success', 'Cart cleared successfully!');
    }

    // Checkout (bonus feature)
    public function checkout()
    {
        $cart = session('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Cart is empty.');
        }

        // Clear the cart after checkout
        session()->forget('cart');
        
        return redirect()->route('products.index')->with('success', 'Thank you for your purchase! Your order has been placed successfully.');
    }
}
