<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

use App\Http\Controllers\HomeController;

class HomeTest extends TestCase
{

    private $expectedPretty;
    private $expectedPlain;

    public function setUp()
    {
        parent::setUp();
        $this->expectedGET = file_get_contents('tests/fixtures/expected-get.txt');
        $this->expectedPOST = file_get_contents('tests/fixtures/expected-post.txt');
    }


    public function testGET()
    {
        $this->get('/');

        $this->assertEquals(
            $this->expectedGET,
            $this->response->getContent()
        );
    }

    public function testPOST()
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
    }
}
