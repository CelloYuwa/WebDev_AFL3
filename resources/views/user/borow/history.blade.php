@extends('layout.mainlayout')

@section('title', 'Borrow History')

@section('content')

<table border="1" cellpadding="8">
    <tr>
        <th>Book</th>
        <th>Borrowed At</th>
        <th>Returned At</th>
        <th>Penalty Paid</th>
    </tr>

    @foreach ($borrows as $borrow)
        <tr>
            <td>{{ $borrow->book->title }}</td>
            <td>{{ $borrow->borrow_date }}</td>
            <td>{{ $borrow->return_date }}</td>
            <td>{{ $borrow->penalty }}</td>
        </tr>
    @endforeach

</table>

@endsection
