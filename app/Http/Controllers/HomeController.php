<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

class HomeController extends Controller
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
        $items = Barang::paginate(20);
        return view('home', compact('items'));
    }
}
