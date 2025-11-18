<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function changeRole(User $user)
    {
        $this->authorizeAdmin();

        if ($user->id == Auth::id()) {
            return back()->with('error', 'Cannot change your own role.');
        }

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return back()->with('success', 'Role updated!');
    }




    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }
}
