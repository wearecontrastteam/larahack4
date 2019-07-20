<?php

namespace App\Http\Controllers;

use App\Person;
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

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://api.github.com/users/' . $request->get('github_username'));
        $response_contents = json_decode($res->getBody()->getContents(), true);

        Person::updateOrCreate([
            'login' => $response_contents['login'],
            'name' => $response_contents['name'],
            'avatar_url' => $response_contents['avatar_url'],
            'bio' => $response_contents['bio'],
            'github_id' => $response_contents['id'],
        ]);

        return redirect('/admin');

        // login, avatar_url, bio
    }
}
