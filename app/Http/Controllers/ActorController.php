<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    public function index()
    {
        $actors = DB::table('actor')->orderBy('name')->get();
        return view('actors.index', compact('actors'));
    }

    public function create()
    {
        return view('actors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        DB::table('actor')->insert(['name' => $request->name]);

        DB::table('audit_logs')->insert([
            'user_id'        => session('user_id'),
            'action'         => 'CREATE',
            'table_affected' => 'actor',
            'details'        => 'Added actor: ' . $request->name,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('actors.index')->with('success', 'Actor added!');
    }

    public function edit($id)
    {
        $actor = DB::table('actor')->where('actor_id', $id)->first();
        return view('actors.edit', compact('actor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:100']);

        DB::table('actor')->where('actor_id', $id)->update(['name' => $request->name]);

        DB::table('audit_logs')->insert([
            'user_id'        => session('user_id'),
            'action'         => 'UPDATE',
            'table_affected' => 'actor',
            'details'        => 'Updated actor ID: ' . $id,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('actors.index')->with('success', 'Actor updated!');
    }

    public function destroy($id)
    {
        $actor = DB::table('actor')->where('actor_id', $id)->first();
        DB::table('actor')->where('actor_id', $id)->delete();

        DB::table('audit_logs')->insert([
            'user_id'        => session('user_id'),
            'action'         => 'DELETE',
            'table_affected' => 'actor',
            'details'        => 'Deleted actor: ' . $actor->name,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('actors.index')->with('success', 'Actor deleted!');
    }
}