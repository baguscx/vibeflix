<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(){
        $featuredMovies = Movie::whereIsFeatured(1)->get();
        $latestMovies = Movie::latest()->get();

        //cek api
        // return [
        //     'featuredMovies' => $featuredMovies,
        //     'latestMovies' => $latestMovies
        // ];

        return inertia('User/Dashboard/Index', [
            'featuredMovies' => $featuredMovies,
            'latestMovies' => $latestMovies
        ]);
        // return Inertia::render('User/Dashboard/Index');
        // return inertia('User/Dashboard/Index');
    }
}
