<?php

namespace Toro\Bundle\ApiBundle\Model;

use FOS\OAuthServerBundle\Entity\ClientManager as BaseClientManager;

class ClientManager extends BaseClientManager
{
    /**
     * {@inheritdoc}
     */
    public function findClientByPublicId($publicId)
    {
        return $this->findClientBy(['randomId' => $publicId]);
    }
}
