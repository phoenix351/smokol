<?php

namespace App\Libraries;

// use \OAuth2\Storage\Pdo;
use \App\Libraries\CustomOauthStorage;


class Oauth
{
    var $server;

    function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $dsn = getenv('database.default.DSN');
        $username = getenv('database.default.username');
        $password = getenv('database.default.password');

        $storage = new CustomOauthStorage([
            'dsn' => $dsn,
            'username' => $username,
            'password' => $password,
        ]);
        $this->server = new \OAuth2\Server($storage);
        $this->server->addGrantType(new \OAuth2\GrantType\UserCredentials($storage));

        // Add the "Client Credentials" grant type (it is the simplest of the grant types)
        //$this->server->addGrantType(new \OAuth2\GrantType\ClientCredentials($storage));

        // Add the "Authorization Code" grant type (this is where the oauth magic happens)
        $this->server->addGrantType(new \OAuth2\GrantType\AuthorizationCode($storage));
    }
}
