@extends('layout.mainlayout')

@section('title', $book->title)
@section('subtitle', 'Detailed information about this book')

@section('content')

<div class="row mb-4">
    <div class="col-md-4">
        <img src="{{ $book->cover_url }}" alt="{{ $book->title }}" class="img-fluid rounded shadow">
    </div>
    <div class="col-md-8">
        <h2>{{ $book->title }}</h2>
        <p><strong>Author:</strong> {{ $book->author }}</p>
        <p><strong>Category:</strong> {{ $book->category }}</p>
        <p><strong>ISBN:</strong> {{ $book->isbn ?? '-' }}</p>
        <p>{{ $book->description }}</p>

        @if(Auth::check() && Auth::user()->role === 'user')
            @if($book->available_copy > 0)
                <form action="{{ route('borrow.book', $book->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary">Borrow This Book</button>
                </form>
            @else
                <button class="btn btn-secondary" disabled>Out of Stock</button>
            @endif
        @endif
    </div>
</div>

<hr>

<h4>Copy Status</h4>
<ul>
    <li>Total Copies: {{ $book->total_copy }}</li>
    <li>Available Copies: {{ $book->available_copy }}</li>
    <li>Borrowed Copies: {{ $book->borrowed_copy }}</li>
</ul>

@if(Auth::check() && Auth::user()->role === 'admin')
    <hr>
    <h4>Current Borrowers</h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Borrowed At</th>
                <th>Due Date</th>
                <th>Penalty (if any)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($book->borrowRecords()->whereNull('returned_at')->get() as $record)
            <tr>
                <td>{{ $record->user->name }}</td>
                <td>{{ $record->borrowed_at }}</td>
                <td>{{ $record->due_at }}</td>
                <td>{{ $record->penalty ?? '0' }}</td>
                <td>Borrowed</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <hr>
    <h4>Borrowing History</h4>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Borrowed At</th>
                <th>Returned At</th>
                <th>Penalty</th>
            </tr>
        </thead>
        <tbody>
        @foreach($book->borrowRecords()->get() as $record)
            <tr>
                <td>{{ $record->user->name }}</td>
                <td>{{ $record->borrowed_at }}</td>
                <td>{{ $record->returned_at ?? '-' }}</td>
                <td>{{ $record->penalty ?? 0 }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

@endsection
