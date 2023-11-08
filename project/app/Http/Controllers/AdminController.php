<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\SendOtpMail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Mail\SendResetLinkEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createUserForm()
{
    return view('admin.create');
}

public function listUsers()
{
    $users = User::all(); // Fetch all users from the database

    return view('admin.list', ['users' => $users]);
}
public function create(){
    return view('admin.create');

}
public function createUser(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required|in:user,merchant,admin',
    ]);

    // You should also hash the password before storing it.
    $user = new User;
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->role = $request->input('role'); // Assign a role

    $user->save();

    return redirect('/admin/users')->with('success', 'User created successfully.');
}

public function editUserForm($id)
{
    $user = User::findOrFail($id);
    return view('admin.edit', ['user' => $user]);
}

public function updateUser(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required|in:user,merchant,admin',
    ]);

    $user = User::findOrFail($id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->syncRoles([$request->input('role')]); // Update user role

    $user->save();

    return redirect('/admin/list')->with('success', 'User updated successfully.');
}

public function deleteUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect('/admin/users')->with('success', 'User deleted successfully.');
}

}
