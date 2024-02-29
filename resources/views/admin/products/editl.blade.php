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
                <h2>Edit Product</h2>
        
                <!-- Form to Edit Product -->
                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
        
                    <div class="mb-3">
                        <label for="product_name">Product Name:</label>
                        <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="company_id">Select Company:</label>
                        <select name="company_id" class="form-control" required>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ $product->company_id == $company->id ? 'selected' : '' }}>
                                    {{ $company->company_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="mb-3">
                        <label for="price">Price:</label>
                        <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="qty">Quantity:</label>
                        <input type="text" name="qty" class="form-control" value="{{ $product->qty }}" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="color">Color:</label>
                        <input type="text" name="color" class="form-control" value="{{ $product->color }}" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="images">Product Images:</label>
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>
        
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>






            
        </div>
    </div>
@include('admin.footer')
@include('admin.scripts')
</body>
</html>