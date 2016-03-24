<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LinkControllerTest extends WebTestCase
{

    protected function assertJsonResponse($response, $statusCode = 200) {
        $this->assertEquals(
            $statusCode, $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
    }

    /**
     *
     */

    public function testIndex()
    {

        $client = static::createClient();

        $client->request('GET', '/links', array(), array(), array(
            '   HTTP_ACCEPT'   => 'application/json',
                'HTTP_CONTENT_TYPE' => 'application/json'
            ));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /*
    public function testCopy()
    {


        $client = static::createClient();

        $client->request('COPY', '/links/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    */

    public function testCorrectPostLink() {
        $client = static::createClient();
        $client->request('POST', '/links', array(), array(), array(
            'Accept'   => 'application/json',
            'HTTP_CONTENT_TYPE' => 'application/json'
            ),
              "{
                title: 'test',
                content: 'content',
                url: 'url',
                readed: false,
                archived: false
              }"
        );

        $this->assertJsonResponse($client->getResponse(), 201, false);
    }

}
