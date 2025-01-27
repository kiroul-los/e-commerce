<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Product - Admin Panel</title>

    <!-- Include CSS -->
    @include('admin.css')
</head>
<body style="background-color: #121212; color: #fff;"> <!-- Dark background for the body -->

<div class="container-scroller">
    <!-- Sidebar -->
@include('admin.sidebar')
<!-- Navbar -->
    @include('admin.navbar')

    <div class="main-panel">
        <div class="content-wrapper">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="div_center" style="max-width: 700px; margin: 50px auto; padding: 40px; background-color: #1f1f1f; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);">
                <h2 class="text-center" style="color: #fff; font-size: 24px; font-weight: bold; margin-bottom: 20px;">Edit Product</h2>

                <form action="{{ route('products.update' , $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Sending PUT request for update -->

                    <!-- Product Title -->
                    <div class="form-group mb-4">
                        <label for="title" style="color: #f1f1f1; font-size: 16px;">Product Title:</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="form-control"
                            value="{{ old('title', $product->title) }}"
                            placeholder="Enter product title"
                            required
                            style="background-color: #333333; color: #fff; border: 1px solid #444444; padding: 12px 20px; font-size: 16px; border-radius: 6px; transition: all 0.3s ease;"
                        >
                    </div>

                    <!-- Product Description -->
                    <div class="form-group mb-4">
                        <label for="description" style="color: #f1f1f1; font-size: 16px;">Description:</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="form-control"
                            placeholder="Enter product description"
                            style="background-color: #333333; color: #fff; border: 1px solid #444444; padding: 12px 20px; font-size: 16px; border-radius: 6px; transition: all 0.3s ease;"
                        >{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Product Image -->
                    <div class="form-group mb-4">
                        <label style="color: #f1f1f1; font-size: 16px;">Current Image:</label>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="display: block; margin: 10px 0; max-width: 100px; border: 1px solid #444444; border-radius: 6px;">
                        <label for="image" style="color: #f1f1f1; font-size: 16px;">Upload New Image:</label>
                        <input
                            type="file"
                            name="image"
                            id="image"
                            class="form-control"
                            style="
        background-color: #333333;
        color: #fff;
        border: 1px solid #444444;
        padding: 8px 15px; /* Adjusted padding for better alignment */
        font-size: 16px;
        border-radius: 6px;
        line-height: 1.5; /* Ensures text inside aligns properly */
        height: auto; /* Ensures dynamic height adjustment */
        transition: all 0.3s ease;"
                        >

                    </div>

                    <!-- Product Category -->
                    <div class="form-group mb-4">
                        <label for="category_id" style="color: #f1f1f1; font-size: 16px;">Category:</label>
                        <select
                            name="category_id"
                            id="category_id"
                            class="form-control"
                            style="
        background-color: #333333;
        color: #fff;
        border: 1px solid #444444;
        padding: 10px 15px; /* Adjusted padding */
        font-size: 16px;
        border-radius: 6px;
        line-height: 1.5; /* Ensures proper spacing of text */
        height: auto; /* Adapts height dynamically */
        transition: all 0.3s ease;"
                        >
                            <option value="" disabled>Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <!-- Product Quantity -->
                    <div class="form-group mb-4">
                        <label for="quantity" style="color: #f1f1f1; font-size: 16px;">Quantity:</label>
                        <input
                            type="number"
                            name="quantity"
                            id="quantity"
                            class="form-control"
                            value="{{ old('quantity', $product->quantity) }}"
                            placeholder="Enter product quantity"
                            required
                            style="background-color: #333333; color: #fff; border: 1px solid #444444; padding: 12px 20px; font-size: 16px; border-radius: 6px; transition: all 0.3s ease;"
                        >
                    </div>

                    <!-- Product Price -->
                    <div class="form-group mb-4">
                        <label for="price" style="color: #f1f1f1; font-size: 16px;">Price:</label>
                        <input
                            type="number"
                            name="price"
                            id="price"
                            class="form-control"
                            step="10.00"
                            value="{{ old('price', $product->price) }}"
                            placeholder="Enter product price"
                            required
                            style="background-color: #333333; color: #fff; border: 1px solid #444444; padding: 12px 20px; font-size: 16px; border-radius: 6px; transition: all 0.3s ease;"
                        >
                    </div>

                    <!-- Discount Price -->
                    <div class="form-group mb-4">
                        <label for="discount_price" style="color: #f1f1f1; font-size: 16px;">Discount Price:</label>
                        <input
                            type="number"
                            name="discount_price"
                            id="discount_price"
                            class="form-control"
                            step="0.01"
                            value="{{ old('discount_price', $product->discount_price) }}"
                            placeholder="Enter discount price (optional)"
                            style="background-color: #333333; color: #fff; border: 1px solid #444444; padding: 12px 20px; font-size: 16px; border-radius: 6px; transition: all 0.3s ease;"
                        >
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; font-size: 16px; padding: 12px 25px; width: 100%; border-radius: 6px; cursor: pointer; transition: all 0.3s ease;">
                        Update Product
                    </button>
                </form>
            </div>

        </div>
    </div>

<!-- Include JS -->
@include('admin.js')

<script>
    // Smooth hover effect for the button
    document.querySelector('.btn-primary').addEventListener('mouseover', function() {
        this.style.backgroundColor = '#0056b3';
        this.style.borderColor = '#004085';
    });

    document.querySelector('.btn-primary').addEventListener('mouseout', function() {
        this.style.backgroundColor = '#007bff';
        this.style.borderColor = '#007bff';
    });
</script>

</body>
</html>
