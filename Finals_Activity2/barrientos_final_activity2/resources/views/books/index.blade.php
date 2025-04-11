<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #343a40;
        }
        .btn-custom {
            background-color: #0d6efd;
            border: none;
            padding: 8px 16px;
            font-size: 0.9rem;
        }
        .btn-custom:hover {
            background-color: #0b5ed7;
        }
        .btn-danger-custom {
            background-color: #dc3545;
            border: none;
            padding: 8px 16px;
            font-size: 0.9rem;
        }
        .btn-danger-custom:hover {
            background-color: #c82333;
        }
        .btn-link-custom {
            color: #0d6efd;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .btn-link-custom:hover {
            color: #0b5ed7;
            text-decoration: underline;
        }
        .table {
            margin-top: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>All Books</h1>
        <a href="{{ route('books.create') }}" class="btn btn-custom mb-3 text-white">Add New Book</a>
        @if ($books->isEmpty())
            <p>No books available.</p>
        @else
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Published Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->published_date }}</td>
                            <td>
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-link-custom btn-secondary text-white">Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger-custom text-white" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Bootstrap JS (Optional, for interactive components if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>