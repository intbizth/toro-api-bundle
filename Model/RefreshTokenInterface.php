<?php

namespace Toro\Bundle\ApiBundle\Model;

use FOS\OAuthServerBundle\Model\RefreshTokenInterface as BaseRefreshTokenInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface RefreshTokenInterface extends BaseRefreshTokenInterface, ResourceInterface
{
}
