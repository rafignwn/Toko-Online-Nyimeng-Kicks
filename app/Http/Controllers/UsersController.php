<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class UsersController extends Controller
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
        $user = User::where('id', Auth::user()->id)->first();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'password' => 'confirmed'
        ]);

        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;

        if (!empty($request->password)){
            $user->password = $request->password;
        }

        $user->nohp = $request->nohp;
        $user->alamat = $request->alamat;
        $user->update();

        return redirect('profile')->with('pesan_berhasil', 'Profile berhasil di update!');
    }
}
