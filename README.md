- [About](#about)
- [Introduction](#introduction)
- [Installation](#installation)
- [Configuration](#configuration)
- [Authentication](#authentication)
    - [Routing](#routing)
    - [Optional Parameters](#optional-parameters)
    - [Access Scopes](#access-scopes)
    - [Retrieving User Details](#retrieving-user-details)
- [Contributing](#contributing)
- [License](#license)

## About

CodeIgniter4 Socialite is Forked from [Laravel Socialite](https://github.com/laravel/socialite) wrapper around OAuth 1 & OAuth 2 libraries for working with codeigniter4 compatibility.

## Introduction

CodeIgniter4 Socialite provides an expressive, fluent interface to OAuth authentication with Facebook, Google, LinkedIn, GitHub, GitLab and Bitbucket. It handles almost all of the boilerplate social authentication code you are dreading writing.

## Installation

To get started with Socialite, use the Composer package manager to add the package to your project's dependencies:

```sh
composer require agungsugiarto/codeigniter4-socialite
```
## Configuration

Copy the config file from `vendor/agungsugiarto/codeigniter4-socialite/src/Config/Socialite.php` to config folder of your codeigniter4 application change the namespace to `Config` and change class extends from `BaseConfig` to `\Fluent\Socialite\Config\Socialite`

Before using Socialite, you will need to add credentials for the OAuth providers your application utilizes. These credentials should be placed in your application's `app/Config/Socialite.php` configuration file, and should use the key `facebook`, `linkedin`, `google`, `github`, `gitlab`, or `bitbucket`, depending on the providers your application requires:

```php
/**
 * {@inheritdoc}
 */
public $services = [
    // ..
    'github' => [
        'client_id'     => '',
        'client_secret' => '',
        'redirect'      => '',
    ],
];
```

> If the `redirect` option contains a relative path, it will automatically be resolved to a fully qualified URL.

## Authentication
### Routing

To authenticate users using an OAuth provider, you will need two routes: one for redirecting the user to the OAuth provider, and another for receiving the callback from the provider after authentication. The example controller below demonstrates the implementation of both routes:

```php
use Fluent\Socialite\Facades\Socialite;

$routes->get('auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

$routes->get('auth/callback', function () {
    $user = Socialite::driver('github')->user();
    // $user->token
});
```

The `redirect` method provided by the `Socialite` facade takes care of redirecting the user to the OAuth provider, while the `user` method will read the incoming request and retrieve the user's information from the provider after they are authenticated.

### Optional Parameters

A number of OAuth providers support optional parameters in the redirect request. To include any optional parameters in the request, call the `with` method with an associative array:

```php
use Fluent\Socialite\Facades\Socialite;

return Socialite::driver('google')
    ->with(['hd' => 'example.com'])
    ->redirect();
```

> When using the `with` method, be careful not to pass any reserved keywords such as `state` or `response_type`.

### Access Scopes

Before redirecting the user, you may also add additional "scopes" to the authentication request using the `scopes` method. This method will merge all existing scopes with the scopes that you supply:

```php
use Fluent\Socialite\Facades\Socialite;

return Socialite::driver('github')
    ->scopes(['read:user', 'public_repo'])
    ->redirect();
```

You can overwrite all existing scopes on the authentication request using the `setScopes` method:

```php
use Fluent\Socialite\Facades\Socialite;

return Socialite::driver('github')
    ->setScopes(['read:user', 'public_repo'])
    ->redirect();
```

## Retrieving User Details

After the user is redirected back to your authentication callback route, you may retrieve the user's details using Socialite's `user` method. The user object returned by the `user` method provides a variety of properties and methods you may use to store information about the user in your own database. Different properties and methods may be available depending on whether the OAuth provider you are authenticating with supports OAuth 1.0 or OAuth 2.0:

```php
$routes->get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();

    // OAuth 2.0 providers...
    $token = $user->token;
    $refreshToken = $user->refreshToken;
    $expiresIn = $user->expiresIn;

    // All providers...
    $user->getId();
    $user->getNickname();
    $user->getName();
    $user->getEmail();
    $user->getAvatar();
});
```

#### Retrieving User Details From A Token (OAuth2)

If you already have a valid access token for a user, you can retrieve their details using Socialite's `userFromToken` method:
```php
use Fluent\Socialite\Facades\Socialite;

$user = Socialite::driver('github')->userFromToken($token);
```

#### Stateless Authentication

The `stateless` method may be used to disable session state verification. This is useful when adding social authentication to an API:

```php
use Fluent\Socialite\Facades\Socialite;

return Socialite::driver('google')->stateless()->user();
```
## Contributing

Thank you for considering contributing to Socialite!.

## License

CodeIgniter4 Socialite is open-sourced software licensed under the [MIT license](LICENSE.md).
