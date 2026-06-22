<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('movie');

        if ($search = $request->search) {
            $movieIds = DB::table('movie_actor')
                ->join('actor', 'movie_actor.actor_id', '=', 'actor.actor_id')
                ->where('actor.name', 'like', "%{$search}%")
                ->pluck('movie_id');

            $query->where(function($q) use ($search, $movieIds) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('director', 'like', "%{$search}%")
                  ->orWhereIn('movie_id', $movieIds);
            });
        }

        $movies = $query->orderBy('title')->get();
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:150',
            'category' => 'required|string|max:50',
            'director' => 'required|string|max:100',
            'year'     => 'required|integer|min:1900|max:2099',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('movies', 'public');
        }

        DB::table('movie')->insert([
            'title'    => $request->title,
            'category' => $request->category,
            'director' => $request->director,
            'year'     => $request->year,
            'image'    => $imagePath,
        ]);

        DB::table('audit_logs')->insert([
            'user_id'       => session('user_id'),
            'action'        => 'CREATE',
            'table_affected'=> 'movie',
            'details'       => 'Added movie: ' . $request->title,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie added!');
    }

    public function edit($id)
    {
        $movie = DB::table('movie')->where('movie_id', $id)->first();
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'    => 'required|string|max:150',
            'category' => 'required|string|max:50',
            'director' => 'required|string|max:100',
            'year'     => 'required|integer|min:1900|max:2099',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $updateData = [
            'title'    => $request->title,
            'category' => $request->category,
            'director' => $request->director,
            'year'     => $request->year,
        ];

        if ($request->hasFile('image')) {
            $updateData['image'] = $request->file('image')->store('movies', 'public');
        }

        DB::table('movie')->where('movie_id', $id)->update($updateData);

        DB::table('audit_logs')->insert([
            'user_id'       => session('user_id'),
            'action'        => 'UPDATE',
            'table_affected'=> 'movie',
            'details'       => 'Updated movie ID: ' . $id,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie updated!');
    }

    public function destroy($id)
    {
        $movie = DB::table('movie')->where('movie_id', $id)->first();

        DB::table('movie')->where('movie_id', $id)->delete();

        DB::table('audit_logs')->insert([
            'user_id'       => session('user_id'),
            'action'        => 'DELETE',
            'table_affected'=> 'movie',
            'details'       => 'Deleted movie: ' . $movie->title,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie deleted!');
    }
}
