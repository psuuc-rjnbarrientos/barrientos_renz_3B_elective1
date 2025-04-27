@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <div class="card-header bg-info text-white rounded-top">
                    <h3 class="mb-0">{{ $product->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Product Details</h5>
                            <p><strong>Description:</strong> {{ $product->description ?: 'No description available' }}</p>
                            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <h5>QR Code</h5>
                            <div id="qr-section" class="p-3 bg-light rounded">
                                {!! $qr !!}
                            </div>
                            <button onclick="printQR()" class="btn btn-outline-primary mt-3">
                                <i class="bi bi-printer"></i> Print QR
                            </button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">← Back to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printQR() {
            const qrContent = document.getElementById('qr-section').innerHTML;
            const printWindow = window.open('', '', 'height=500,width=500');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Print QR Code - {{ $product->name }}</title>
                        <style>
                            body { text-align: center; padding: 20px; }
                            img { max-width: 100%; }
                        </style>
                    </head>
                    <body>
                        <h3>{{ $product->name }}</h3>
                        ${qrContent}
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }
    </script>
@endsection