<?php

namespace Toro\Bundle\ApiBundle\Model;

use FOS\OAuthServerBundle\Model\ClientInterface as BaseClientInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface ClientInterface extends BaseClientInterface, ResourceInterface
{
}
