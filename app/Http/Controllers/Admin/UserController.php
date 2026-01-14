<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
{
    return view('admin.users.create');
}

public function store(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'role' => ['required', 'in:employee,manager,admin'],
        'password' => ['required', 'string', 'min:8'],
    ]);

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'role' => $validated['role'],
        'password' => Hash::make($validated['password']),
    ]);

    return redirect()->route('admin.users.index')->with('success', 'Użytkownik dodany.');
}

}
