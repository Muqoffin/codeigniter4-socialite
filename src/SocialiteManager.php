<?php

namespace Fluent\Socialite;

use Closure;
use CodeIgniter\Config\Factories;
use CodeIgniter\Config\Services;
use Fluent\Socialite\Contracts\FactoryInterface;
use Fluent\Socialite\Helpers\Arr;
use Fluent\Socialite\Helpers\Str;
use Fluent\Socialite\Two\AbstractProvider;
use Fluent\Socialite\Two\BitbucketProvider;
use Fluent\Socialite\Two\FacebookProvider;
use Fluent\Socialite\Two\GithubProvider;
use Fluent\Socialite\Two\GitlabProvider;
use Fluent\Socialite\Two\GoogleProvider;
use Fluent\Socialite\Two\LinkedInProvider;
use InvalidArgumentException;

use function array_merge;
use function is_null;
use function method_exists;
use function sprintf;
use function ucfirst;

class SocialiteManager implements FactoryInterface
{
    /**
     * The configuration repository instance.
     *
     * @var Socialite
     */
    protected $config;

    /**
     * The registered custom driver creators.
     *
     * @var array
     */
    protected $customCreators = [];

    /**
     * The array of created "drivers".
     *
     * @var array
     */
    protected $drivers = [];

    /**
     * Create a new manager instance.
     *
     * @return void
     */
    public function __construct(Factories $factory, bool $getShared = true)
    {
        $this->config = $factory::config('Socialite', ['getShared' => $getShared]);
    }

    /**
     * {@inheritdoc}
     */
    public function driver($driver = null)
    {
        $driver = $driver ?: $this->getDefaultDriver();

        if (is_null($driver)) {
            throw new InvalidArgumentException(sprintf(
                'Unable to resolve NULL driver for [%s].',
                static::class
            ));
        }

        // If the given driver has not been created before, we will create the instances
        // here and cache it so we can return it next time very quickly. If there is
        // already a driver created by this name, we'll just return that instance.
        if (! isset($this->drivers[$driver])) {
            $this->drivers[$driver] = $this->createDriver($driver);
        }

        return $this->drivers[$driver];
    }

    /**
     * Create a new driver instance.
     *
     * @param  string  $driver
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function createDriver($driver)
    {
        // First, we will determine if a custom driver creator exists for the given driver and
        // if it does not we will check for a creator method for the driver. Custom creator
        // callbacks allow developers to build their own "drivers" easily using Closures.
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver);
        } else {
            $method = 'create' . ucfirst($driver) . 'Driver';

            if (method_exists($this, $method)) {
                return $this->$method();
            }
        }

        throw new InvalidArgumentException("Driver [$driver] not supported.");
    }

    /**
     * Call a custom driver creator.
     *
     * @param  string  $driver
     * @return mixed
     */
    protected function callCustomCreator($driver)
    {
        return $this->customCreators[$driver]($this->config);
    }

    /**
     * Register a custom driver creator Closure.
     *
     * @param  string  $driver
     * @return $this
     */
    public function extend($driver, Closure $callback)
    {
        $this->customCreators[$driver] = $callback;

        return $this;
    }

    /**
     * Get all of the created "drivers".
     *
     * @return array
     */
    public function getDrivers()
    {
        return $this->drivers;
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param  string  $method
     * @param  array  $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return $this->driver()->{$method}(...$arguments);
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return AbstractProvider
     */
    protected function createGithubDriver()
    {
        $config = $this->config->services['github'];

        return $this->buildProvider(
            GithubProvider::class,
            $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return AbstractProvider
     */
    protected function createFacebookDriver()
    {
        $config = $this->config->services['facebook'];

        return $this->buildProvider(
            FacebookProvider::class,
            $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return AbstractProvider
     */
    protected function createGoogleDriver()
    {
        $config = $this->config->services['google'];

        return $this->buildProvider(
            GoogleProvider::class,
            $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return AbstractProvider
     */
    protected function createLinkedinDriver()
    {
        $config = $this->config->services['linkedin'];

        return $this->buildProvider(
            LinkedInProvider::class,
            $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return AbstractProvider
     */
    protected function createBitbucketDriver()
    {
        $config = $this->config->services['bitbucket'];

        return $this->buildProvider(
            BitbucketProvider::class,
            $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return AbstractProvider
     */
    protected function createGitlabDriver()
    {
        $config = $this->config->services['gitlab'];

        return $this->buildProvider(
            GitlabProvider::class,
            $config
        )->setHost($config['host'] ?? null);
    }

    /**
     * {@inheritdoc}
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
            'identifier'   => $config['client_id'],
            'secret'       => $config['client_secret'],
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
     * @throws InvalidArgumentException
     */
    public function getDefaultDriver()
    {
        throw new InvalidArgumentException('No Socialite driver was specified.');
    }
}
