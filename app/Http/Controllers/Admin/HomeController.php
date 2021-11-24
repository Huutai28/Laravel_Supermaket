<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    //
    public function index ()
    {
        return view('admin.index');
    }

    public function logout ()
    {
        Auth::logout();
        return redirect()->intended('login');
    }
}
