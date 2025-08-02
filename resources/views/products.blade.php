@extends('layouts.app')

@section('title', 'Products - Mini ECommerce Cart')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">
                <i class="fas fa-box me-2"></i>
                Our Products
            </h1>
            <a href="{{ route('cart.show') }}" class="btn btn-outline-primary">
                <i class="fas fa-shopping-cart me-2"></i>
                View Cart
                @php
                    $cartCount = count(session('cart', []));
                @endphp
                @if($cartCount > 0)
                    <span class="badge bg-danger ms-1">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
    </div>
</div>

<div class="row">
    @foreach($products as $product)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body d-flex flex-column">
                <div class="text-center mb-3">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-box fa-2x text-primary"></i>
                    </div>
                </div>

                <h5 class="card-title text-center">{{ $product['name'] }}</h5>
                <p class="card-text text-muted text-center">{{ $product['description'] }}</p>

                <div class="text-center mb-3">
                    <span class="h4 text-success">₹{{ number_format($product['price'], 0) }}</span>
                </div>

                <form action="{{ route('cart.add') }}" method="POST" class="mt-auto">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">

                    <div class="row g-2">
                        <div class="col-6">
                            <label for="quantity-{{ $product['id'] }}" class="form-label">Quantity:</label>
                            <select name="quantity" id="quantity-{{ $product['id'] }}" class="form-select" required>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-cart-plus me-2"></i>
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card bg-light">
            <div class="card-body text-center">
                <h5 class="card-title">
                    <i class="fas fa-info-circle me-2"></i>
                    About This Demo
                </h5>
                <p class="card-text">
                    This is a mini ecommerce cart built with Laravel. All cart data is stored in PHP sessions.
                    You can add products to cart, view your cart, update quantities, remove items, and clear the entire cart.
                    All prices are displayed in Indian Rupees (₹).
                </p>
                <div class="row text-start">
                    <div class="col-md-6">
                        <h6>Features:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Add products to cart</li>
                            <li><i class="fas fa-check text-success me-2"></i>View cart with totals</li>
                            <li><i class="fas fa-check text-success me-2"></i>Update quantities</li>
                            <li><i class="fas fa-check text-success me-2"></i>Remove items</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Technology:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-code text-primary me-2"></i>Laravel 12</li>
                            <li><i class="fas fa-code text-primary me-2"></i>PHP Sessions</li>
                            <li><i class="fas fa-code text-primary me-2"></i>Bootstrap 5</li>
                            <li><i class="fas fa-code text-primary me-2"></i>Blade Templates</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
