<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @include('admin.styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.navbar')
        @include('admin.sidebar')
        <div class="content-wrapper">


            <div class="container">
                <h2>Add Product</h2>
    
                <!-- Form to Add Product -->
                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="product_name">Product Name:</label>
                        <input type="text" name="product_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="company_id">Select Company:</label>
                        <select name="company_id" class="form-control" required>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price">Price:</label>
                        <input type="text" name="price" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="qty">Quantity:</label>
                        <input type="text" name="qty" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="color">Color:</label>
                        <input type="text" name="color" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="images">Product Images:</label>
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>



        </div>
    </div>
@include('admin.footer')
@include('admin.scripts')
</body>
</html>
