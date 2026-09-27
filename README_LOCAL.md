# Aesthetique (Localhost - XAMPP)

## 1) Put project in XAMPP
- Copy/keep this folder under: `C:\xampp\htdocs\aesthetique`

## 2) Start services
- Start **Apache** and **MySQL** from XAMPP Control Panel.

## 3) Create database
- Create database named: `aesthetique`
- Import/ensure tables exist:
  - `users`
  - `products`
  - `orders`
  - `order_items`

> Note: The PHP code expects columns like `orders.total`, `orders.order_status`, `orders.order_date`, and `order_items.price`.

## 4) Open the app
- In browser: `http://localhost/aesthetique/index.php`

## 5) Test payment flow (demo)
- Register/Login
- Add items to cart
- Go to Checkout → Place Order
- Pick a test payment method (success/fail)
- You should land on the payment result page and see the order status updated.

