<?php

namespace Fluent\Socialite;

use CodeIgniter\Config\Services;
use Fluent\Socialite\AbstractManager;
use Fluent\Socialite\Helpers\Arr;
use Fluent\Socialite\Helpers\Str;
use InvalidArgumentException;
use Fluent\Socialite\Two\BitbucketProvider;
use Fluent\Socialite\Two\FacebookProvider;
use Fluent\Socialite\Two\GithubProvider;
use Fluent\Socialite\Two\GitlabProvider;
use Fluent\Socialite\Two\GoogleProvider;
use Fluent\Socialite\Two\LinkedInProvider;

class SocialiteManager extends AbstractManager
{
    /**
     * Get a driver instance.
     *
     * @param  string  $driver
     * @return mixed
     */
    public function with($driver)
    {
        return $this->driver($driver);
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Fluent\Socialite\Two\AbstractProvider
     */
    protected function createGithubDriver()
    {
        $config = $this->config->services['github'];

        return $this->buildProvider(
            GithubProvider::class, $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Fluent\Socialite\Two\AbstractProvider
     */
    protected function createFacebookDriver()
    {
        $config = $this->config->services['facebook'];

        return $this->buildProvider(
            FacebookProvider::class, $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Fluent\Socialite\Two\AbstractProvider
     */
    protected function createGoogleDriver()
    {
        $config = $this->config->services['google'];

        return $this->buildProvider(
            GoogleProvider::class, $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Fluent\Socialite\Two\AbstractProvider
     */
    protected function createLinkedinDriver()
    {
        $config = $this->config->services['linkedin'];

        return $this->buildProvider(
            LinkedInProvider::class, $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Fluent\Socialite\Two\AbstractProvider
     */
    protected function createBitbucketDriver()
    {
        $config = $this->config->services['bitbucket'];

        return $this->buildProvider(
            BitbucketProvider::class, $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Fluent\Socialite\Two\AbstractProvider
     */
    protected function createGitlabDriver()
    {
        $config = $this->config->services['gitlab'];

        return $this->buildProvider(
            GitlabProvider::class, $config
        )->setHost($config['host'] ?? null);
    }

    /**
     * Build an OAuth 2 provider instance.
     *
     * @param  string  $provider
     * @param  array  $config
     * @return \Fluent\Socialite\Two\AbstractProvider
     */
    public function buildProvider($provider, $config)
    {
        return new $provider(
            Services::request(),
            $config['client_id'],
            $config['client_secret'],
            $this->formatRedirectUrl($config),
            Arr::get($config, 'guzzle', [])
        );
    }

    /**
     * Format the server configuration.
     *
     * @param  array  $config
     * @return array
     */
    public function formatConfig(array $config)
    {
        return array_merge([
            'identifier' => $config['client_id'],
            'secret' => $config['client_secret'],
            'callback_uri' => $this->formatRedirectUrl($config),
        ], $config);
    }

    /**
     * Format the callback URL, resolving a relative URI if needed.
     *
     * @param  array  $config
     * @return string
     */
    protected function formatRedirectUrl(array $config)
    {
        $redirect = Arr::value($config['redirect']);

        return Str::startsWith($redirect, '/')
            ? redirect()->to($redirect)
            : $redirect;
    }

    /**
     * Get the default driver name.
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function getDefaultDriver()
    {
        throw new InvalidArgumentException('No Socialite driver was specified.');
    }
}
