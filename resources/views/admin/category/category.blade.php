
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    @include('admin.css')
    <style>
        .div_center{
            text-align:center;
            padding-top:40px;
        }
        .h2_font{
            font-size:40px ;
            padding-bottom:40px ;
        }


        /* Style the input with the class 'custom-input' */
        .custom-input {
            background-color: #f8f9fa; /* Light gray background */
            color: #212529; /* Dark text color */
            border: 1px solid #ced4da; /* Default border */
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            transition: all 0.3s ease; /* Smooth transition for hover and focus */
        }

        /* Change background and border on focus */
        .custom-input:focus {
            background-color: #ffffff; /* White background */
            color: #212529; /* Dark text */
            border-color: #007bff; /* Blue border */
            outline: none; /* Remove default outline */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Add focus shadow */
        }

        /* Style the placeholder text */
        .custom-input::placeholder {
            color: #6c757d; /* Muted gray placeholder */
            font-style: italic; /* Optional: Italic placeholder text */
        }

        /* Disabled input styling */
        .custom-input:disabled {
            background-color: #e9ecef; /* Light gray background */
            color: #6c757d; /* Muted text color */
            cursor: not-allowed; /* Change cursor for disabled inputs */
        }

        body {
            background-color: black;
            color: white;
        }

        .custom-input, .form-control {
            background-color: #333;
            color: white;
            border: 1px solid #555;
        }

        .custom-btn {
            background-color: #007bff;
            color: white;
        }

        .custom-btn:hover {
            background-color: #0056b3;
        }

        .table {
            background-color: #222;
            color: white;
        }

        .table th, .table td {
            border-color: #444;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #333;
        }

        .alert {
            background-color: #444;
            color: white;
        }



    </style>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
@include('admin.sidebar')
<!-- partial -->
@include('admin.navbar')
<!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session('error') }}
                    </div>
                @endif


                <div class="div_center">
                <h2 class="h2_font">Add Category</h2>
                <form action="{{ url('/add_category') }}" method="POST" class="custom-form">
                    @csrf
                    <div class="form-group">
                        <label for="cat_name" class="form-label">Category Name:</label>
                        <input
                            type="text"
                            name="cat_name"
                            id="cat_name"
                            class="form-control custom-input"
                            placeholder="Enter category name"
                            required
                        />
                    </div>
                    <button type="submit" class="btn btn-primary custom-btn">Add Category</button>
                </form>
            </div>

            <div class="mt-5">
                <h2 class="h2_font">Category List</h2>
                @if($categories->isEmpty())
                    <p class="text-muted">No categories found.</p>
                @else
                    <table class="table table-bordered table-striped mt-3">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ url('/edit_category/' . $category->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <form action="{{ url('delete_category/' . $category->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>



    <!-- plugins:js -->

@include('admin.js')
<!-- End custom js for this page -->
</body>
</html>

