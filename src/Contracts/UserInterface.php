<?php

namespace Fluent\Socialite\Contracts;

use ArrayAccess;

interface UserInterface extends ArrayAccess
{
    /**
     * Get the unique identifier for the user.
     *
     * @return string
     */
    public function getId();

    /**
     * Get the nickname / username for the user.
     *
     * @return string
     */
    public function getNickname();

    /**
     * Get the full name of the user.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the e-mail address of the user.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get the avatar / image URL for the user.
     *
     * @return string
     */
    public function getAvatar();

     /**
      * Get the raw user array.
      *
      * @return array
      */
    public function getRaw();

    /**
     * Set the raw user array from the provider.
     *
     * @param  array  $user
     * @return $this
     */
    public function setRaw(array $user);

    /**
     * Map the given array onto the user's properties.
     *
     * @param  array  $attributes
     * @return $this
     */
    public function map(array $attributes);

    /**
     * Set the token on the user.
     *
     * @param  string  $token
     * @return $this
     */
    public function setToken($token);

    /**
     * Set the refresh token required to obtain a new access token.
     *
     * @param  string  $refreshToken
     * @return $this
     */
    public function setRefreshToken($refreshToken);

    /**
     * Set the number of seconds the access token is valid for.
     *
     * @param  int  $expiresIn
     * @return $this
     */
    public function setExpiresIn($expiresIn);
}
