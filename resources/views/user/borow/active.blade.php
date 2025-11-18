@extends('layout.mainlayout')

@section('title', 'My Borrowed Books')

@section('content')

<table border="1" cellpadding="8">
    <tr>
        <th>Book</th>
        <th>Borrowed At</th>
        <th>Return Before</th>
        <th>Penalty</th>
    </tr>

    @foreach ($borrows as $borrow)
        <tr>
            <td>{{ $borrow->book->title }}</td>
            <td>{{ $borrow->borrow_date }}</td>
            <td>{{ $borrow->due_date }}</td>
            <td>{{ $borrow->penalty }} rupiah</td>
        </tr>
    @endforeach
</table>

@endsection
