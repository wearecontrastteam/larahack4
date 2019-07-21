<?php

namespace App\Services;

use App\Person;
use Exception;
use GuzzleHttp\Client;

class PersonService
{

    public function importPersonFromGithub($username)
    {
        try{
            $res = (new Client())->request('GET',
                'https://api.github.com/users/' . $username
                . "?client_id=" . env('GITHUB_CLIENT_ID') . "&client_secret=" . env('GITHUB_CLIENT_SECRET')
            );
            $response_contents = json_decode($res->getBody()->getContents(), true);

            Person::updateOrCreate([
                'login' => $response_contents['login'],
                'name' => $response_contents['name'],
                'avatar_url' => $response_contents['avatar_url'],
                'bio' => $response_contents['bio'],
                'github_id' => $response_contents['id'],
            ]);

            return true;
        } catch(Exception $exception){
            return false;
        }

    }
}