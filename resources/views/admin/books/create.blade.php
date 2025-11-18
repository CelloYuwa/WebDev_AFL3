@extends('layout.mainlayout')

@section('title', 'Add Book')

@section('content')
<div class="d-flex justify-content-center">
    <div class="col-md-6">
        <div class="card shadow p-4 mt-5">
            <h2 class="mb-4 text-center">Add New Book</h2>

            <div class="mb-3">
                <a href="{{ route('books.index') }}" class="btn btn-secondary">&larr; Back</a>
            </div>

            <form action="{{ route('admin.books.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Cover Image URL</label>
                    <input type="url" name="cover_url" class="form-control" placeholder="Enter valid cover image URL" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter book title" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Author</label>
                    <input type="text" name="author" class="form-control" placeholder="Enter author name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control" placeholder="Enter category" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Copies</label>
                    <input type="number" name="total_copy" class="form-control" placeholder="Enter number of copies" required min="1">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Enter book description"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Save Book</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
