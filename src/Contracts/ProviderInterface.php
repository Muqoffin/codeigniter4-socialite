<?php

namespace Fluent\Socialite\Contracts;

interface ProviderInterface
{
    /**
     * Redirect the user to the authentication page for the provider.
     *
     * @return \CodeIgniter\Http\RedirectResponse
     */
    public function redirect();

    /**
     * Get the User instance for the authenticated user.
     *
     * @return \Fluent\Socialite\Contracts\UserInterface
     */
    public function user();
}
