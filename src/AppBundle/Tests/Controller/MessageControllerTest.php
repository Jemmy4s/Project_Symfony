<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MessageControllerTest extends WebTestCase
{
    public function testEcriremessage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ecrireMessage');
    }

    public function testLiremessage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lireMessage');
    }

}
