@extends('layout.mainlayout')

@section('title', 'Books')
@section('subtitle', 'All Available Books')

@section('content')
<div class="mb-3 d-flex justify-content-between">
    <h4>Books List</h4>
    @auth
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.books.create') }}" class="btn btn-success">Add New Book</a>
        @endif
    @endauth
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-primary">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Available Copies</th>
                @auth
                    @if(Auth::user()->role === 'admin')
                        <th>Actions</th>
                    @endif
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}">
                            {{ $book->title }}
                        </a>
                    </td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->available_copy }}</td>
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <td class="d-flex gap-2">
                                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        @endif
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Pagination links --}}
    <div class="d-flex justify-content-center">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
