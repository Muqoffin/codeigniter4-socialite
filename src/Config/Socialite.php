<?php

namespace Fluent\Socialite\Config;

use CodeIgniter\Config\BaseConfig;

class Socialite extends BaseConfig
{
    /**
     *--------------------------------------------------------------------------
     * Third Party Services
     *--------------------------------------------------------------------------
     *
     * This file is for storing the credentials for third party services such
     * as Mailgun, Postmark, AWS and more. This file provides the de facto
     * location for this type of information, allowing packages to have
     * a conventional file to locate the various service credentials.
     */
    public $services = [
        'github'    => [
            'client_id'     => env('GITHUB_ID'),
            'client_secret' => env('GITHUB_SECRET'),
            'redirect'      => env('GITHUB_URL'),
        ],
    
        'facebook'  => [
            'client_id'     => env('FACEBOOK_ID'),
            'client_secret' => env('FACEBOOK_SECRET'),
            'redirect'      => env('FACEBOOK_URL'),
        ],
    
        'google'    => [
            'client_id'     => env('GOOGLE_ID'),
            'client_secret' => env('GOOGLE_SECRET'),
            'redirect'      => env('GOOGLE_URL'),
        ],

        'linkedin'  => [
            'client_id'     => env('LINKEDIN_ID'),
            'client_secret' => env('LINKEDIN_SECRET'),
            'redirect'      => env('LINKEDIN_URL'),
        ],

        'bitbucket' => [
            'client_id'     => env('BITBUCKET_ID'),
            'client_secret' => env('BITBUCKET_SECRET'),
            'redirect'      => env('BITBUCKET_URL'),
        ],
    
        'gitlab'    => [
            'client_id'     => env('GITLAB_ID'),
            'client_secret' => env('GITLAB_SECRET'),
            'redirect'      => env('GITLAB_URL'),
        ],
    ];
}