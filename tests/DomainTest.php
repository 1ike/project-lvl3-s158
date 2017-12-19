<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
// use Laravel\Lumen\Testing\DatabaseTransactions;

/* use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException; */

// use App\Http\Controllers\HomeController;

class DomainTest extends TestCase
{
    use DatabaseMigrations;

/*     public function setUp()
    {
        parent::setUp();
        $this->expectedGET = file_get_contents('tests/fixtures/expected-get.txt');
        // $this->expectedPOST = file_get_contents('tests/fixtures/expected-post.txt');
    } */


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

/*     public function testPOST()
    {
        $this->post('/', ['url' => 'ya.ru']);

        $req = app('request');

        $html = file_get_contents('tests/fixtures/expected-html.txt');
        $mock = new MockHandler([
            new Response(200, [], $html),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new \GuzzleHttp\Client(['handler' => $handler]);


        // var_dump();

        $this->assertEquals(
            $this->expectedPOST,
            (new HomeController)->showResult($req, $client)->render()
        );
    } */
}
