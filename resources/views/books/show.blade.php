@extends('layout.mainlayout')

@section('title', $book->title)
@section('subtitle', 'Book Details')

@section('content')
<div class="row mb-3">
    <div class="col-md-12 text-end">
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-primary">Edit Book</a>
        @endif
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <img src="{{ $book->cover_url ?? 'https://via.placeholder.com/300x400?text=No+Cover' }}" 
                class="card-img-top" 
                alt="{{ $book->title }} Cover">
        </div>
    </div>

    <div class="col-md-8">
        <h2>{{ $book->title }}</h2>
        <p><strong>Author:</strong> {{ $book->author }}</p>
        <p><strong>Category:</strong> {{ $book->category }}</p>
        <p><strong>Available Copies:</strong> {{ $book->available_copy }}</p>
        <p><strong>Description:</strong></p>
        <p>{{ $book->description }}</p>
    </div>
</div>


@endsection
