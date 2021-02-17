<?php

namespace Fluent\Socialite\Contracts;

use Closure;
use Fluent\Socialite\Contracts\ProviderInterface;

interface FactoryInterface
{
    /**
     * Get an OAuth provider implementation.
     *
     * @param  string  $driver
     * @return ProviderInterface
     */
    public function driver($driver = null);

    /**
     * Register a custom driver creator Closure.
     *
     * @param  string  $driver
     * @return $this
     */
    public function extend($driver, Closure $callback);

    /**
     * Get all of the created "drivers".
     *
     * @return array
     */
    public function getDrivers();

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver();

    /**
     * Build an OAuth 2 provider instance.
     *
     * @param  string  $provider
     * @param  array  $config
     * @return AbstractProvider
     */
    public function buildProvider($provider, $config);
}
