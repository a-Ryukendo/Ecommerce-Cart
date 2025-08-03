# Mini ECommerce Cart - Laravel

A simple ecommerce cart application built with Laravel 12 that demonstrates session-based cart functionality.

## 🚀 Features

- **Product Display**: View 3 hardcoded products with details
- **Add to Cart**: Add products with custom quantities
- **Cart Management**: View cart with product details, quantities, and totals
- **Quantity Updates**: Modify product quantities in real-time
- **Remove Items**: Remove individual products from cart
- **Clear Cart**: Clear entire cart with one click
- **Checkout**: Simulated checkout process with thank you message
- **Session Storage**: All cart data stored in PHP sessions
- **Responsive Design**: Beautiful UI with Bootstrap 5
- **Flash Messages**: Success/error notifications

## 🛠 Technology Stack

- **Laravel 12** - PHP Framework
- **PHP 8.0+** - Programming Language
- **Bootstrap 5** - CSS Framework
- **Font Awesome** - Icons
- **Blade Templates** - View Engine
- **PHP Sessions** - Cart Data Storage

## 📋 Requirements

- PHP 8.0 or higher
- Composer
- Web server (Apache/Nginx) or PHP built-in server

## 🚀 Installation & Setup

### 1. Clone or Download the Project

```bash
# If you have the project files, navigate to the project directory
cd LaravelEcommerceCart
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Setup

```bash
# Copy environment file (if not already done)
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure session driver (already done in this project)
# SESSION_DRIVER=file is set in .env file
```

### 4. Configure Database (Optional)

The application uses session storage, so no database is required. However, if you want to configure a database:

1. Edit `.env` file and set your database credentials
2. Run migrations: `php artisan migrate`

### 5. Start the Development Server

```bash
# Using Laravel's built-in server
php artisan serve

# Or using PHP's built-in server
php -S localhost:8000 -t public
```

### 6. Access the Application

Open your browser and navigate to:
- **http://localhost:8000** (if using `php artisan serve`)
- **http://localhost:8000** (if using PHP built-in server)

## 📁 Project Structure

```
LaravelEcommerceCart/
├── app/
│   └── Http/Controllers/
│       └── CartController.php          # Main cart logic
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php              # Base layout
│   ├── products.blade.php             # Products page
│   └── cart.blade.php                 # Cart page
├── routes/
│   └── web.php                        # Application routes
├── Dockerfile                          # Docker configuration for deployment
├── render.yaml                         # Render deployment configuration
└── README.md                          # This file
```

## 🛒 How to Use

### 1. View Products
- Navigate to the home page to see available products
- Each product shows: Name, Description, Price (in Indian Rupees ₹)

### 2. Add to Cart
- Select quantity from dropdown (1-10)
- Click "Add to Cart" button
- Product will be added to your cart

### 3. View Cart
- Click "Cart" in navigation or "View Cart" button
- See all items with quantities and subtotals
- View grand total at the bottom

### 4. Manage Cart
- **Update Quantity**: Change quantity dropdown and form auto-submits
- **Remove Item**: Click trash icon next to item
- **Clear Cart**: Click "Clear Cart" button to remove all items

### 5. Checkout
- Click "Proceed to Checkout" button
- Cart will be cleared and thank you message displayed

## 🔧 Routes

| Method | Route | Description |
|--------|-------|-------------|
| GET | `/` | Display products page |
| GET | `/cart` | Display cart page |
| POST | `/cart/add` | Add product to cart |
| POST | `/cart/update` | Update product quantity |
| POST | `/cart/remove` | Remove product from cart |
| POST | `/cart/clear` | Clear entire cart |
| POST | `/cart/checkout` | Process checkout |

## 🎨 Features Implemented

### ✅ Core Requirements
- [x] Laravel 10+ (using Laravel 12)
- [x] PHP 8.0+
- [x] PHP `session()` for cart data storage
- [x] REST principles for routes
- [x] No external packages (Livewire, Inertia, etc.)
- [x] Blade views
- [x] Display 3 hardcoded products (ID, Name, Price in ₹)
- [x] Add products to cart functionality
- [x] View cart with product name, quantity, price, subtotal
- [x] Grand total calculation
- [x] Increase quantity functionality
- [x] Remove product functionality
- [x] Clear entire cart functionality
- [x] POST routes for all cart modifications

### ✅ Bonus Features
- [x] Bootstrap styling for modern UI
- [x] Fake checkout button with thank you message
- [x] Session flash messages for success/failure actions
- [x] Responsive design
- [x] Cart badge showing item count
- [x] Confirmation dialogs for destructive actions
- [x] Beautiful product cards with hover effects
- [x] Order summary sidebar
- [x] Empty cart state

## 🔍 Code Highlights

### Session Management
```php
// Store cart data in session
session(['cart' => $cart]);

// Retrieve cart data
$cart = session('cart', []);

// Clear cart
session()->forget('cart');
```

### RESTful Routes
```php
// All cart modifications use POST
Route::post('/cart/add', [CartController::class, 'add']);
Route::post('/cart/update', [CartController::class, 'update']);
Route::post('/cart/remove', [CartController::class, 'remove']);
Route::post('/cart/clear', [CartController::class, 'clear']);
```

### Validation
```php
$request->validate([
    'product_id' => 'required|integer|min:1|max:3',
    'quantity' => 'required|integer|min:1|max:10'
]);
```

## 🚀 Deployment

### Local Development
```bash
php artisan serve
```

### Render Deployment (Recommended)
1. Push your code to GitHub
2. Sign up at [render.com](https://render.com)
3. Connect your GitHub account
4. Create new Web Service
5. Select your repository
6. Configure environment variables
7. Deploy!

**See `RENDER_DEPLOYMENT.md` for detailed instructions.**

### Other Hosting Options
1. Set up a web server (Apache/Nginx)
2. Configure environment variables
3. Set proper file permissions
4. Use `php artisan config:cache` for optimization

## 🤝 Contributing

This is a demo project for learning purposes. Feel free to fork and modify as needed.

## 📝 License

This project is open source and available under the [MIT License](LICENSE).

---

**Built with ❤️ using Laravel**
