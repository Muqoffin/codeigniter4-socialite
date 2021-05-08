<?php

namespace Fluent\Socialite\Contracts;

use CodeIgniter\Http\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use Fluent\Socialite\Contracts\UserInterface;
use GuzzleHttp\Client;

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

    /**
     * Get a Social User instance from a known access token.
     *
     * @param  string  $token
     * @return UserInterface
     */
    public function userFromToken($token);

    /**
     * Get the access token response for the given code.
     *
     * @param  string  $code
     * @return array
     */
    public function getAccessTokenResponse($code);

    /**
     * Merge the scopes of the requested access.
     *
     * @param  array|string  $scopes
     * @return $this
     */
    public function scopes($scopes);

    /**
     * Set the scopes of the requested access.
     *
     * @param  array|string  $scopes
     * @return $this
     */
    public function setScopes($scopes);

    /**
     * Get the current scopes.
     *
     * @return array
     */
    public function getScopes();

    /**
     * Set the redirect URL.
     *
     * @param  string  $url
     * @return $this
     */
    public function redirectUrl($url);

    /**
     * Set the Guzzle HTTP client instance.
     *
     * @return $this
     */
    public function setHttpClient(Client $client);

    /**
     * Set the request instance.
     *
     * @return $this
     */
    public function setRequest(RequestInterface $request);

    /**
     * Indicates that the provider should operate as stateless.
     *
     * @return $this
     */
    public function stateless();

    /**
     * Set the custom parameters of the request.
     *
     * @param  array  $parameters
     * @return $this
     */
    public function with(array $parameters);
}
