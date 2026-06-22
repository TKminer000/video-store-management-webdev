<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (session('role') != 'admin') abort(403);
        $users = DB::table('users')->orderBy('name')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (session('role') != 'admin') abort(403);
        return view('users.create');
    }

    public function store(Request $request)
    {
        if (session('role') != 'admin') abort(403);
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:255',
            'role'     => 'required|in:admin,staff',
        ]);

        DB::table('users')->insert([
            'name'       => $request->name,
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('audit_logs')->insert([
            'user_id'        => session('user_id'),
            'action'         => 'CREATE',
            'table_affected' => 'users',
            'details'        => 'Added user: ' . $request->username,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('users.index')->with('success', 'User added!');
    }

    public function edit($id)
    {
        if (session('role') != 'admin') abort(403);
        $user = DB::table('users')->where('id', $id)->first();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (session('role') != 'admin') abort(403);
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,staff',
        ]);

        DB::table('users')->where('id', $id)->update([
            'name'       => $request->name,
            'role'       => $request->role,
            'updated_at' => now(),
        ]);

        if ($request->filled('password')) {
            DB::table('users')->where('id', $id)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        DB::table('audit_logs')->insert([
            'user_id'        => session('user_id'),
            'action'         => 'UPDATE',
            'table_affected' => 'users',
            'details'        => 'Updated user ID: ' . $id,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('users.index')->with('success', 'User updated!');
    }

    public function destroy($id)
    {
        if (session('role') != 'admin') abort(403);
        if ($id == session('user_id')) {
            return redirect()->route('users.index')->with('error', 'Cannot delete yourself!');
        }

        DB::table('users')->where('id', $id)->delete();

        DB::table('audit_logs')->insert([
            'user_id'        => session('user_id'),
            'action'         => 'DELETE',
            'table_affected' => 'users',
            'details'        => 'Deleted user ID: ' . $id,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('users.index')->with('success', 'User deleted!');
    }
}