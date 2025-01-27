<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Product - Admin Panel</title>

    <!-- Include CSS -->
    @include('admin.css')

    <style>
        body {
            background-color: #121212;
            color: #fff;
        }

        .container-scroller {
            margin-top: 50px;
        }

        .content-wrapper {
            padding: 20px;
        }

        .form-container {
            background: #1f1f1f;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            margin: 0 auto;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #fff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            color: #f1f1f1;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #444;
            background-color: #333;
            color: #fff;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-group textarea {
            resize: vertical;
            height: 150px;
        }

        .form-group input[type="file"] {
            padding: 5px;
        }

        .btn-submit {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            padding: 12px;
            border-radius: 6px;
            border: none;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #28a745;
            color: white;
        }

        .alert-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    <!-- Sidebar -->
@include('admin.sidebar')
<!-- Navbar -->
    @include('admin.navbar')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="form-container">
                <h2>Add Product</h2>

                <!-- Display errors or success message -->
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

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">Product Title</label>
                        <input type="text" id="title" name="title" placeholder="Enter product title" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" placeholder="Enter product description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <input type="file" id="image" name="image" required>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select id="category_id" name="category_id" required>
                            <option value="" disabled selected>Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" placeholder="Enter product quantity" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" step="0.01" placeholder="Enter product price" required>
                    </div>

                    <div class="form-group">
                        <label for="discount_price">Discount Price</label>
                        <input type="number" id="discount_price" name="discount_price" step="0.01" placeholder="Enter discount price (optional)">
                    </div>

                    <button type="submit" class="btn-submit">Add Product</button>
                </form>
            </div>
        </div>

    <!-- Include JS -->
    @include('admin.js')
</div>
</body>
</html>
