<?php

namespace Toro\Bundle\ApiBundle\Model;

use FOS\OAuthServerBundle\Model\AuthCodeInterface as BaseAuthCodeInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface AuthCodeInterface extends BaseAuthCodeInterface, ResourceInterface
{
}
