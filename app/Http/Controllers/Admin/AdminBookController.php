<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('title')->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'total_copy' => 'required|integer|min:1',
        ]);

        $data['available_copy'] = $data['total_copy'];
        $data['borrowed_copy'] = 0;

        Book::create($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book added successfully');
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'total_copy' => 'required|integer|min:1',
        ]);

        // Recalculate available copies
        $usedCopies = $book->borrowed_copy;
        $data['available_copy'] = $data['total_copy'] - $usedCopies;

        $book->update($data);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book updated successfully');
    }
}
