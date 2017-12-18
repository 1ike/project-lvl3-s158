<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function showResult(Request $request, \GuzzleHttp\Client $client)
    {
        $url = $request->input('url');

        // $client = new \GuzzleHttp\Client(['verify' => false]);
        $request1 = new \GuzzleHttp\Psr7\Request('GET', $url);
        $promise = $client->sendAsync($request1)->then(function ($response) {
             return $response->getBody();
        });
        $html = $promise->wait();

        return view('home', ['url' => $url, 'html' => $html]);
    }
}
