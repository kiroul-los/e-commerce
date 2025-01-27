<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
</head>
<body>

@include('home.header')

<div class="container mt-5">
    <h2>Your Cart</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($cartItems->isEmpty())
        <p>Your cart is empty!</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Image</th> <!-- Added Image column -->
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->product_name }}" style="width: 100px; height: auto;">

                    </td> <!-- Displaying product image -->
                    <td>EGP. {{ number_format($item->price, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 80px;">
                            <button type="submit" class="btn btn-warning mt-2">Update</button>
                        </form>
                    </td>
                    <td>EGP. {{ number_format($item->price * $item->quantity, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h4>Total: EGP. {{ number_format($cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        }), 2) }}</h4>

        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Clear Cart</button>
        </form>

        <a href="#" class="btn btn-success mt-3">Proceed to Checkout</a>
    @endif
</div>

@include('home.footer')

<script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('home/js/bootstrap.js') }}"></script>
<script src="{{ asset('home/js/custom.js') }}"></script>

</body>
</html>
