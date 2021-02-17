<?php

namespace Fluent\Socialite\Contracts;

interface FactoryInterface
{
    /**
     * Get an OAuth provider implementation.
     *
     * @param  string  $driver
     * @return \Fluent\Socialite\Contracts\ProviderInterface
     */
    public function driver($driver = null);
}
