<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class AdminBorrowController extends Controller
{
    public function borrowForm(Book $book)
    {
        $users = User::where('role', 'user')->get();

        return view('admin.borrows.borrow', compact('book', 'users'));
    }

    public function borrow(Request $request, Book $book)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'deadline' => 'required|date',
        ]);

        // Create borrow record
        Borrow::create([
            'user_id' => $data['user_id'],
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'return_deadline' => $data['deadline'],
        ]);

        // Update copy counts
        $book->available_copy -= 1;
        $book->borrowed_copy += 1;
        $book->save();

        return redirect()->route('admin.books.show', $book->id)
            ->with('success', 'Book successfully borrowed');
    }

    public function returnBook(Borrow $borrow)
    {
        $borrow->returned_at = now();

        // calculate penalty
        if (now()->gt($borrow->return_deadline)) {
            $daysLate = now()->diffInDays($borrow->return_deadline);
            $borrow->penalty = $daysLate * 10000;
        }

        $borrow->save();

        // update book copies
        $book = $borrow->book;
        $book->available_copy += 1;
        $book->borrowed_copy -= 1;
        $book->save();

        return back()->with('success', 'Book returned successfully');
    }
}
