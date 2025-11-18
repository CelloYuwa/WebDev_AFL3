@extends('layout.mainlayout')

@section('title', 'Borrow Book')

@section('content')

<h3>Borrow: {{ $book->title }}</h3>

<form method="POST" action="{{ route('admin.borrow.do', $book->id) }}">
    @csrf

    <label>Select user:</label>
    <select name="user_id">
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <br><br>

    <button type="submit">Confirm Borrow</button>
</form>

@endsection

