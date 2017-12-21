<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
// use Laravel\Lumen\Testing\DatabaseTransactions;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
// use GuzzleHttp\Psr7\Request;
// use GuzzleHttp\Exception\RequestException;

use App\Http\Controllers\DomainController;

class DomainTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->expectedPOST = file_get_contents('tests/fixtures/expected-post.txt');
    }


    public function testAddDomain()
    {
        $url = 'http://la-la-la.ru';

        $this->post('/domains', ['url' => $url]);

        $this->seeInDatabase('domains', ['name' => $url]);
        $this->assertResponseStatus(302);
    }

    public function testRejectWrongDomain()
    {
        $url = 'http:\\la-la-la.ru';

        $this->post('/domains', ['url' => $url]);

        $this->notseeInDatabase('domains', ['name' => $url]);
        $this->assertResponseOk();
    }

    public function testGuzzle()
    {
        $url = 'http://ya.ru';

        $request = app('request');
        $request->replace(['url' => $url]);

        $status_expected = 200;
        $length_expected = 10547;
        $body_expected = file_get_contents('tests/fixtures/expected-html.txt');

        $mock = new MockHandler([
            new Response(
                $status_expected,
                 ['Content-Length' => $length_expected],
                  $body_expected)
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $res = (new DomainController)->create($request, $client);

        $status = DB::table('domains')->value('code');
        $length = DB::table('domains')->value('content_length');
        $body = DB::table('domains')->value('body');

        $this->assertEquals($status_expected, $status);
        $this->assertEquals($length_expected, $length);
        $this->assertEquals($body_expected, $body);
    }

}
