<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserBorrowController extends Controller
{
    // Show books the user is currently borrowing
    public function active()
    {
        $borrows = Auth::user()
            ->borrows()
            ->whereNull('returned_at')
            ->with('book')
            ->get();

        return view('user.borrows.active', compact('borrows'));
    }

    // Show history of all past borrows
    public function history()
    {
        $borrows = Auth::user()
            ->borrows()
            ->whereNotNull('returned_at')
            ->with('book')
            ->get();

        return view('user.borrows.history', compact('borrows'));
    }
}
