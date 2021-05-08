<?php

namespace Fluent\Socialite;

use Fluent\Socialite\Contracts\UserInterface;

use function array_key_exists;

abstract class AbstractUser implements UserInterface
{
    /**
     * The unique identifier for the user.
     *
     * @var mixed
     */
    public $id;

    /**
     * The user's nickname / username.
     *
     * @var string
     */
    public $nickname;

    /**
     * The user's full name.
     *
     * @var string
     */
    public $name;

    /**
     * The user's e-mail address.
     *
     * @var string
     */
    public $email;

    /**
     * The user's avatar image URL.
     *
     * @var string
     */
    public $avatar;

    /**
     * The user's raw attributes.
     *
     * @var array
     */
    public $user;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * {@inheritdoc}
     */
    public function getRaw()
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setRaw(array $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function map(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->user);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->user[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->user[$offset] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->user[$offset]);
    }
}
