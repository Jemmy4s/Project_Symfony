<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompteControllerTest extends WebTestCase
{
    public function testCompte()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/compte');
    }

}
