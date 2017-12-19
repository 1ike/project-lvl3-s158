<?php

class HomeTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->expectedGET = file_get_contents('tests/fixtures/expected-get.txt');
    }


    public function testHomeGET()
    {
        $this->get('/');

        $this->assertEquals(
            $this->expectedGET,
            $this->response->getContent()
        );
    }
}
