<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Product</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Product Title</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $product->title) }}" required>
            </div>

            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" name="brand" class="form-control" id="brand" value="{{ old('title', $product->brand) }}" required>
            </div>

            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" name="image" class="form-control-file" id="image">
                @if( $product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" width="100" class="mt-2">
                @endif
            </div>

            <div class="form-group">
                <label for="details">Product Details</label>
                <textarea name="details" class="form-control" id="details" rows="3">{{ old('details', $product->details) }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" class="form-control" id="price" value="{{ old('price', $product->price) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Edit Product</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
