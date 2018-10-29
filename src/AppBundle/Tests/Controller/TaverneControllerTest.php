<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaverneControllerTest extends WebTestCase
{
    public function testCreerunhero()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/creerUnHero');
    }

    public function testChoisirunhero()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/choisirUnHero');
    }

}
