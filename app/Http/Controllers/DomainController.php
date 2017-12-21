<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;

use GuzzleHttp\Client;

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

    public function create(Request $request, Client $client)
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

        $res = $client->request('GET', $url);
        $statusCode = $res->getStatusCode();
        $hasContentLength = $res->hasHeader('Content-Length');
        $contentLength = $hasContentLength ?
            $res->getHeader('Content-Length')[0] : -1;
        $body = $res->getBody();

        $title = "Domain {$url} - PageSpeed";
        $time = date('Y-m-d h:i', time());
        $id = DB::table('domains')->insertGetId([
            'name' => $url,
            'created_at' => $time,
            'updated_at' => $time,
            'code' => $statusCode,
            'content_length' => $contentLength,
            'body' => $body,
        ]);

        return redirect()->route('domain', ['id' => $id]);
    }

}
