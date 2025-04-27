@extends('layouts.app')

@section('title', 'Product List')

@section('content')
    <div class="card">
        <div class="card-header bg-dark text-white rounded-top">
            <h3 class="mb-0">Product List</h3>
        </div>
        <div class="card-body">
            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('products.index') }}" class="mb-4">
                <div class="row g-3">
                    <!-- Search Input -->
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search by Name or Description</label>
                        <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Enter keyword...">
                    </div>
                    <!-- Price Filters -->
                    <div class="col-md-3">
                        <label for="min_price" class="form-label">Min Price</label>
                        <input type="number" step="0.01" name="min_price" id="min_price" class="form-control" value="{{ request('min_price') }}" placeholder="0.00">
                    </div>
                    <div class="col-md-3">
                        <label for="max_price" class="form-label">Max Price</label>
                        <input type="number" step="0.01" name="max_price" id="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="0.00">
                    </div>
                    <!-- Buttons -->
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Search</button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </div>
            </form>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Product Count -->
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
                <span class="text-muted">Found {{ $products->total() }} {{ Str::plural('Product', $products->total()) }}</span>
            </div>

            <!-- Product Table -->
            @if($products->isEmpty())
                <div class="alert alert-info">No products found. <a href="{{ route('products.create') }}">Add one now!</a></div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>QR Code</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{!! $product->qr !!}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete {{ $product->name }}?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $products->links() }}
            @endif
        </div>
    </div>
@endsection