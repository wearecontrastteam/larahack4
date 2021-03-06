<?php

namespace App\Services;

use App\Person;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class PersonService
{

    public function importPersonFromGithub($username)
    {
        try{
            $res = (new Client())->request('GET',
                'https://api.github.com/users/' . $username
                . "?client_id=" . config('github.client_id') . "&client_secret=" . config('github.client_secret')
            );
            $response_contents = json_decode($res->getBody()->getContents(), true);

            $name = $response_contents['name'];
            if($name === '' || $name === null){
                $name = $response_contents['login'];
            }

            Person::updateOrCreate([
                'login' => $response_contents['login'],
                'name' => $name,
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