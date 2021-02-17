<?php

namespace Fluent\Socialite\Facades;

use CodeIgniter\Config\BaseService;
use Fluent\Socialite\SocialiteManager;

/**
 * @see \Fluent\Socialite\SocialiteManager
 * 
 * @method static \Fluent\Socialite\Contracts\ProviderInterface driver(string $driver = null)
 */
class Socialite
{
    /**
     * Socialite facade service instance.
     * 
     * @param string $method
     * @param array $arguments
     * @return SocialiteManager
     */
    public static function __callStatic($method, $arguments)
    {
        return BaseService::getSharedInstance('socialite')->{$method}(...$arguments);
    }
}
