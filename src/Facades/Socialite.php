<?php

namespace Fluent\Socialite\Facades;

use Closure;
use Fluent\Socialite\Config\Services;
use Fluent\Socialite\Contracts\FactoryInterface;
use Fluent\Socialite\Contracts\ProviderInterface;

/**
 * @see \Fluent\Socialite\Contracts\FactoryInterface
 * @see \Fluent\Socialite\Contracts\ProviderInterface
 *
 * @method static ProviderInterface driver(string $driver = null)
 * @method static $this extend($driver, Closure $callback)
 * @method static array getDrivers()
 * @method static string getDefaultDriver()
 * @method static ProviderInterface buildProvider($provider, $config)
 */
class Socialite
{
    /**
     * Socialite facade service instance.
     *
     * @param string $method
     * @param array $arguments
     * @return FactoryInterface|ProviderInterface
     */
    public static function __callStatic($method, $arguments)
    {
        return Services::getSharedInstance('socialite')->{$method}(...$arguments);
    }
}
