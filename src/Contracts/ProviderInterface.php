<?php

namespace Fluent\Socialite\Contracts;

use CodeIgniter\Http\RedirectResponse;
use Fluent\Socialite\Contracts\UserInterface;

interface ProviderInterface
{
    /**
     * Redirect the user to the authentication page for the provider.
     *
     * @return RedirectResponse
     */
    public function redirect();

    /**
     * Get the User instance for the authenticated user.
     *
     * @return UserInterface
     */
    public function user();
}
