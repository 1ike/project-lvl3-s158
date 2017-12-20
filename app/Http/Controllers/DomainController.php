<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;

// use Illuminate\Http\Response;

class DomainController extends Controller
{
    public function show($id)
    {
        $title = "Domain #{$id} - PageSpeed";
        $domains = DB::table('domains')->where('id', $id)->get();

        return view('domains', [
            'title' => $title,
            'routeName' => '',
            'domains' => $domains,
            'hasPagination' => false
            ]);
        }

    public function showAll()
    {
        $title = 'Domains - PageSpeed';
        $routeName = app('request')->route()[1]['as'];
        $domains = DB::table('domains')->orderBy('id', 'desc')->paginate(5);

        return view('domains', [
            'title' => $title,
            'routeName' => $routeName,
            'domains' => $domains,
            'hasPagination' => true
        ]);
    }

    public function create(Request $request)
    {

        $url = $request->input('url');
        $validator = Validator::make($request->all(), [
            'url' => 'required|url'
            ]);

        if ($validator->fails()) {
            $errorTitle = 'The url format is invalid - PageSpeed';
            return view('home', [
                'title' => $errorTitle,
                'routeName' => '',
                'url' => $url,
                'errors' => $validator->errors()->all(),
            ]);
        }

        $title = "Domain {$url} - PageSpeed";
        $time = date('Y-m-d h:i', time());
        $id = DB::table('domains')->insertGetId([
            'name' => $url,
            'created_at' => $time,
            'updated_at' => $time,
        ]);

        return redirect()->route('domain', ['id' => $id]);
    }


/*     public function showResult(Request $request, \GuzzleHttp\Client $client)
    {
        $url = $request->input('url');

        // $client = new \GuzzleHttp\Client(['verify' => false]);
        $request1 = new \GuzzleHttp\Psr7\Request('GET', $url);
        $promise = $client->sendAsync($request1)->then(function ($response) {
             return $response->getBody();
        });
        $html = $promise->wait();

        return view('home', ['url' => $url, 'html' => $html]);
    } */
}
