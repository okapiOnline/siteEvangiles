<?php

namespace Meupf\PlateformBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResponsableControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/responsable');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'responsable/add');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/responsable/edit');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/responsable/delete');
    }

}
