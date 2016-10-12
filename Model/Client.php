<?php

namespace Toro\Bundle\ApiBundle\Model;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;

class Client extends BaseClient implements ClientInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPublicId()
    {
        return $this->getRandomId();
    }
}
