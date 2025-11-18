<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;


class BookController extends Controller
{
    // Show all books
    public function index()
    {
        $books = Book::orderBy('title')->paginate(10);
        return view('books.index', compact('books'));
    }

    // Show detail page of a single book
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Show edit form (admin only)
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $book->update($request->only(['title','author','category','total_copy']));
        return redirect()->route('admin.books.show', $book->id)->with('success','Book updated!');
    }
    // Show create form
    public function create()
    {
        return view('admin.books.create');
    }

    // Store new book
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'total_copy' => 'required|integer|min:0',
        ]);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'category' => $request->category,
            'total_copy' => $request->total_copy,
            'available_copy' => $request->total_copy,
        ]);

        return redirect()->route('books.index')->with('success', 'Book created!');
    }

    public function index1(Request $request)
{
    $query = Book::query();

    if ($search = $request->input('search')) {
        $query->where('title', 'like', "%{$search}%");
    }

    $books = $query->paginate(10);

    return view('books.index', compact('books'));
}



    // Delete book
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted!');
    }



}
