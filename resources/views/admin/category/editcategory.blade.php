<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Category - Admin Panel</title>

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
                <h2 class="text-center" style="color: #fff; font-size: 24px; font-weight: bold; margin-bottom: 20px;">Edit Category</h2>

                <form action="{{ url('update_category/' . $category->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Sending PUT request for update -->

                    <div class="form-group mb-4">
                        <label for="cat_name" style="color: #f1f1f1; font-size: 16px;">Category Name:</label>
                        <input
                            type="text"
                            name="cat_name"
                            id="cat_name"
                            class="form-control"
                            value="{{ old('cat_name', $category->name) }}"
                            placeholder="Enter category name"
                            required
                            style="background-color: #333333; color: #fff; border: 1px solid #444444; padding: 12px 20px; font-size: 16px; border-radius: 6px; transition: all 0.3s ease;"
                        >
                    </div>

                    <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; font-size: 16px; padding: 12px 25px; width: 100%; border-radius: 6px; cursor: pointer; transition: all 0.3s ease;">
                        Update Category
                    </button>
                </form>
            </div>

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
