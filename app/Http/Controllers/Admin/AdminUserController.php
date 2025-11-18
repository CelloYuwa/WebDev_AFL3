<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('admin.users.index', compact('users'));
    }

    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();

        return back()->with('success', 'User promoted to admin');
    }

    public function makeUser(User $user)
    {
        $user->role = 'user';
        $user->save();

        return back()->with('success', 'User demoted to regular user');
    }
}
