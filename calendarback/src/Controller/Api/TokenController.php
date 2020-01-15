<?php

namespace App\Controller\Api;

use App\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class TokenController extends AbstractFOSRestController
{

    public function testPOSTCreateToken()
    {
        $response = $this->client->post('/api/tokens', [
            'auth' => ['samuel', 'motdepas']
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
