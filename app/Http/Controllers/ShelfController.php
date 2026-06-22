<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShelfController extends Controller
{
    public function index()
    {
        $shelves = DB::table('shelf')->orderBy('category')->get();
        return view('shelves.index', compact('shelves'));
    }

    public function create()
    {
        return view('shelves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:50',
        ]);

        DB::table('shelf')->insert(['category' => $request->category]);

        DB::table('audit_logs')->insert([
            'user_id'        => session('user_id'),
            'action'         => 'CREATE',
            'table_affected' => 'shelf',
            'details'        => 'Added shelf: ' . $request->category,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('shelves.index')->with('success', 'Shelf added!');
    }

    public function edit($id)
    {
        $shelf = DB::table('shelf')->where('shelf_id', $id)->first();
        return view('shelves.edit', compact('shelf'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['category' => 'required|string|max:50']);

        DB::table('shelf')->where('shelf_id', $id)->update(['category' => $request->category]);

        DB::table('audit_logs')->insert([
            'user_id'        => session('user_id'),
            'action'         => 'UPDATE',
            'table_affected' => 'shelf',
            'details'        => 'Updated shelf ID: ' . $id,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('shelves.index')->with('success', 'Shelf updated!');
    }

    public function destroy($id)
    {
        DB::table('shelf')->where('shelf_id', $id)->delete();

        DB::table('audit_logs')->insert([
            'user_id'        => session('user_id'),
            'action'         => 'DELETE',
            'table_affected' => 'shelf',
            'details'        => 'Deleted shelf ID: ' . $id,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('shelves.index')->with('success', 'Shelf deleted!');
    }
}