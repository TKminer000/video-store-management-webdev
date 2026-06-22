<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $mostRented = DB::table('rentals')
            ->join('tape', 'rentals.tape_number', '=', 'tape.tape_number')
            ->join('movie', 'tape.movie_id', '=', 'movie.movie_id')
            ->select('movie.movie_id', 'movie.title', 'movie.category', 'movie.image', DB::raw('COUNT(*) as rental_count'))
            ->groupBy('movie.movie_id', 'movie.title', 'movie.category', 'movie.image')
            ->orderByDesc('rental_count')
            ->get();

        $leastRented = DB::table('rentals')
            ->join('tape', 'rentals.tape_number', '=', 'tape.tape_number')
            ->join('movie', 'tape.movie_id', '=', 'movie.movie_id')
            ->select('movie.movie_id', 'movie.title', 'movie.category', 'movie.image', DB::raw('COUNT(*) as rental_count'))
            ->groupBy('movie.movie_id', 'movie.title', 'movie.category', 'movie.image')
            ->orderBy('rental_count')
            ->get();

        $currentlyRented = DB::table('rentals')
            ->join('tape', 'rentals.tape_number', '=', 'tape.tape_number')
            ->join('movie', 'tape.movie_id', '=', 'movie.movie_id')
            ->join('users', 'rentals.user_id', '=', 'users.id')
            ->whereNull('rentals.returned_at')
            ->select('rentals.*', 'movie.title', 'movie.image', 'tape.tape_number', 'users.name as staff_name')
            ->orderByDesc('rentals.rented_at')
            ->get();

        return view('reports.index', compact('mostRented', 'leastRented', 'currentlyRented'));
    }
}
