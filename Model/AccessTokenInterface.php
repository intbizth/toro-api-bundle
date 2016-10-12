<?php

namespace Toro\Bundle\ApiBundle\Model;

use FOS\OAuthServerBundle\Model\AccessTokenInterface as BaseAccessTokenInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface AccessTokenInterface extends BaseAccessTokenInterface, ResourceInterface
{
}
