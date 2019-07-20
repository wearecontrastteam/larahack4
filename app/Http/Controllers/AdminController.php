<?php

namespace App\Http\Controllers;

use App\Person;
use App\Services\PersonService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // TODO change this to a middleware
        if(!in_array(Auth::user()->id, [1,2,3])) {
            abort(403);
        }

        return view('admin.index', [
            'people' => Person::all()
        ]);
    }

    public function add_person(Request $request)
    {
        // TODO change this to a middleware
        if(!in_array(Auth::user()->id, [1,2,3])) {
            abort(403);
        }

        $service = new PersonService();
        $service->importPersonFromGithub($request->get('github_username'));

        return redirect('/admin');

    }
}
