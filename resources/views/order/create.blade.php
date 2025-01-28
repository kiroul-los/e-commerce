<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
</head>
<body>

@include('home.header')

<div class="container mt-5">
    <h2>Order Summary</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <h4>User Information</h4>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Phone:</strong> {{ $user->phone }}</p>
    <p><strong>Address:</strong> <input type="text" name="address" value="{{ old('address') }}" class="form-control"></p>

    <h4>Cart Items</h4>
    @if($cartItems->isEmpty())
        <p>Your cart is empty!</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td><img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="width: 100px; height: auto;"></td>
                    <td>EGP. {{ number_format($item->pivot->price, 2) }}</td>
                    <td>{{ $item->pivot->quantity }}</td>
                    <td>EGP. {{ number_format($item->pivot->price * $item->pivot->quantity, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h4>Total: EGP. {{ number_format($cartItems->sum(function ($item) {
            return $item->pivot->price * $item->pivot->quantity;
        }), 2) }}</h4>
    @endif

    <h4>Payment Method</h4>
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="payment_method">Choose Payment Method</label>
            <select name="payment_method" id="payment_method" class="form-control" required>
                <option value="cash_on_delivery">Cash on Delivery</option>
                <option value="card_payment">Payment with Card</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Place Order</button>
    </form>


@include('home.footer')

<script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('home/js/bootstrap.js') }}"></script>
<script src="{{ asset('home/js/custom.js') }}"></script>

</body>
</html>
