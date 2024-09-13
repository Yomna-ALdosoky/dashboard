<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Products</h1>

        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('dalate'))
        <div class="alert alert-danger">
            {{ session('dalate') }}
        </div>
        @endif

        <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Add New Product</a>

        <form action="{{ route('product.index') }}" method="GET" class="mb-4">
            <div class="form-row">
                <div class="col">
                    <input type="text" name="title" class="form-control" placeholder="Search by Title" value="{{ request('title') }}">
                </div>
                <div class="col">
                    <input type="text" name="brand" class="form-control" placeholder="Search by Brand" value="{{ request('brand') }}">
                </div>
                <div class="col">
                    <input type="number" step="0.01" name="price" class="form-control" placeholder="Search by Price" value="{{ request('price') }}">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Brand</th>
                    <th>Image</th>
                    <th>Details</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->brand }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" width="100">
                            @endif
                        </td>
                        <td>{{ $product->details }}</td>
                        <td>${{ $product->price }}</td>
                        <td>
                            
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            {{-- {{ route('product.destroy', $product->id) }} --}}
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
