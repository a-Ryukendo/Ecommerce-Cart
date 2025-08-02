@extends('layouts.app')

@section('title', 'Shopping Cart - Mini ECommerce Cart')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">
                <i class="fas fa-shopping-cart me-2"></i>
                Shopping Cart
            </h1>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>
                Continue Shopping
            </a>
        </div>
    </div>
</div>

@if(count($cartItems) > 0)
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Cart Items ({{ count($cartItems) }})
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                <i class="fas fa-box text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $item['name'] }}</h6>
                                                <small class="text-muted">ID: {{ $item['id'] }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold">₹{{ number_format($item['price'], 0) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                            <select name="quantity" class="form-select form-select-sm" style="width: 80px;" onchange="this.form.submit()">
                                                @for($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}" {{ $item['quantity'] == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold text-success">₹{{ number_format($item['subtotal'], 0) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to remove this item?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-calculator me-2"></i>
                        Order Summary
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold">Total Items:</span>
                        <span>{{ array_sum(array_column($cartItems, 'quantity')) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold">Subtotal:</span>
                        <span>₹{{ number_format($total, 0) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="h5 mb-0 fw-bold">Grand Total:</span>
                        <span class="h5 mb-0 fw-bold text-success">₹{{ number_format($total, 0) }}</span>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <form action="{{ route('cart.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-credit-card me-2"></i>
                                Proceed to Checkout
                            </button>
                        </form>
                        
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to clear your entire cart?')">
                                <i class="fas fa-trash me-2"></i>
                                Clear Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Cart Features
                    </h6>
                    <ul class="list-unstyled mb-0">
                        <li><i class="fas fa-check text-success me-2"></i>Update quantities</li>
                        <li><i class="fas fa-check text-success me-2"></i>Remove individual items</li>
                        <li><i class="fas fa-check text-success me-2"></i>Clear entire cart</li>
                        <li><i class="fas fa-check text-success me-2"></i>Real-time totals</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-shopping-cart fa-4x text-muted"></i>
                    </div>
                    <h3 class="text-muted mb-3">Your cart is empty</h3>
                    <p class="text-muted mb-4">Looks like you haven't added any products to your cart yet.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-bag me-2"></i>
                        Start Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection 