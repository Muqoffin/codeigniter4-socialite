<?php

namespace Fluent\Socialite\Two;

use Fluent\Socialite\AbstractUser;

class User extends AbstractUser
{
    /**
     * The user's access token.
     *
     * @var string
     */
    public $token;

    /**
     * The refresh token that can be exchanged for a new access token.
     *
     * @var string
     */
    public $refreshToken;

    /**
     * The number of seconds the access token is valid for.
     *
     * @var int
     */
    public $expiresIn;

    /**
     * {@inheritdoc}
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;

        return $this;
    }
}
