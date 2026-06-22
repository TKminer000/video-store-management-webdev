<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TapeController extends Controller
{
    public function index()
    {
        $tapes = DB::table('tape')
            ->join('movie', 'tape.movie_id', '=', 'movie.movie_id')
            ->select('tape.*', 'movie.title as movie_title')
            ->orderBy('tape.tape_number')
            ->get();
        return view('tapes.index', compact('tapes'));
    }

    public function create()
    {
        $movies = DB::table('movie')->orderBy('title')->get();
        return view('tapes.create', compact('movies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|integer',
            'format'   => 'required|in:Beta,VHS',
        ]);

        DB::table('tape')->insert([
            'movie_id' => $request->movie_id,
            'format'   => $request->format,
        ]);

        DB::table('audit_logs')->insert([
            'user_id'        => session('user_id'),
            'action'         => 'CREATE',
            'table_affected' => 'tape',
            'details'        => 'Added tape for movie ID: ' . $request->movie_id,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('tapes.index')->with('success', 'Tape added!');
    }

    public function edit($id)
    {
        $tape   = DB::table('tape')->where('tape_number', $id)->first();
        $movies = DB::table('movie')->orderBy('title')->get();
        return view('tapes.edit', compact('tape', 'movies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'movie_id' => 'required|integer',
            'format'   => 'required|in:Beta,VHS',
        ]);

        DB::table('tape')->where('tape_number', $id)->update([
            'movie_id' => $request->movie_id,
            'format'   => $request->format,
        ]);

        DB::table('audit_logs')->insert([
            'user_id'        => session('user_id'),
            'action'         => 'UPDATE',
            'table_affected' => 'tape',
            'details'        => 'Updated tape number: ' . $id,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('tapes.index')->with('success', 'Tape updated!');
    }

    public function destroy($id)
    {
        DB::table('tape')->where('tape_number', $id)->delete();

        DB::table('audit_logs')->insert([
            'user_id'        => session('user_id'),
            'action'         => 'DELETE',
            'table_affected' => 'tape',
            'details'        => 'Deleted tape number: ' . $id,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        return redirect()->route('tapes.index')->with('success', 'Tape deleted!');
    }

    public function rent($id)
    {
        $tape = DB::table('tape')->where('tape_number', $id)->first();

        if (!$tape || $tape->status != 'available') {
            return back()->withErrors(['error' => 'This tape is not available for rent.']);
        }

        DB::transaction(function () use ($id) {
            DB::table('tape')->where('tape_number', $id)->update(['status' => 'rented']);

            DB::table('rentals')->insert([
                'tape_number' => $id,
                'user_id'     => session('user_id'),
                'rented_at'   => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            DB::table('audit_logs')->insert([
                'user_id'        => session('user_id'),
                'action'         => 'RENT',
                'table_affected' => 'tape',
                'details'        => 'Rented tape number: ' . $id,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        });

        return back()->with('success', 'Tape #' . $id . ' has been rented!');
    }

    public function returnTape($id)
    {
        $tape = DB::table('tape')->where('tape_number', $id)->first();

        if (!$tape || $tape->status != 'rented') {
            return back()->withErrors(['error' => 'This tape is not currently rented.']);
        }

        DB::transaction(function () use ($id) {
            DB::table('tape')->where('tape_number', $id)->update(['status' => 'available']);

            DB::table('rentals')
                ->where('tape_number', $id)
                ->whereNull('returned_at')
                ->update(['returned_at' => now(), 'updated_at' => now()]);

            DB::table('audit_logs')->insert([
                'user_id'        => session('user_id'),
                'action'         => 'RETURN',
                'table_affected' => 'tape',
                'details'        => 'Returned tape number: ' . $id,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        });

        return back()->with('success', 'Tape #' . $id . ' has been returned!');
    }
}
