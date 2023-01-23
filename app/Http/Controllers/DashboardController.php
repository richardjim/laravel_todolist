<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Book;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $books = Book::with('author')->paginate(10);
        return view('dashboard')->with('books', $books);
    }
}
