<?php

namespace Fluent\Socialite\Config;

use CodeIgniter\Config\BaseService;
use CodeIgniter\Config\Factories;
use Fluent\Socialite\SocialiteManager;

class Services extends BaseService
{
    /**
     * Socialite service instance.
     * 
     * @return SocialiteManager
     */
    public static function socialite(bool $getshared = true)
    {
        if ($getshared) {
            return static::getSharedInstance('socialite');
        }

        return new SocialiteManager(new Factories(), $getshared);
    }
}