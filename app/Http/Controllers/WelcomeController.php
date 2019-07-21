<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        if(auth()->check()){
            return redirect()->route('home');
        }

        return view('welcome.index');
    }
}
