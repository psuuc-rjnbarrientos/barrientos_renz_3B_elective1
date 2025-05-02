<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Image Upload (Single + Multiple)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Single Image Upload</h1>
        <form action="{{ route('photos.store.single') }}" method="POST" enctype="multipart/form-data" class="mb-8">
            @csrf
            <div class="flex items-center gap-4">
                <input type="file" name="image" required
                    class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Upload</button>
            </div>
        </form>

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Multiple Images Upload</h1>
        <form action="{{ route('photos.store.multiple') }}" method="POST" enctype="multipart/form-data" class="mb-8">
            @csrf
            <div class="flex items-center gap-4">
                <input type="file" name="images[]" multiple required
                    class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Upload</button>
            </div>
        </form>

        @if (session('success'))
            <p class="text-green-600 mb-6">{{ session('success') }}</p>
        @endif

        <h2 class="text-2xl font-bold text-gray-800 mb-6">Uploaded Images</h2>

        @if ($photos->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                @foreach ($photos as $photo)
                    <div class="border border-gray-200 rounded-lg p-3 shadow-sm">
                        <img src="{{ asset('images/' . $photo->image) }}" alt="{{ $photo->image }}"
                            class="w-full h-48 object-cover rounded-md mb-3">
                        <form action="{{ route('photos.destroy', $photo->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this image?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full px-3 py-2 bg-red-600 text-white font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center">
                <div class="inline-flex items-center gap-2">
                    {{ $photos->links() }}
                </div>
            </div>
        @else
            <p class="text-muted text-center">No Image(s) found. Upload one now!</p>
        @endif
    </div>
</body>

</html>
