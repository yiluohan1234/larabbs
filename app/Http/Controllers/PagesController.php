<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function root()
    {
        // return view('pages.root');
        // return view('fadmin.dashboard');
        return redirect('/admin');
    }
}