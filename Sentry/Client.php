<?php

namespace DTuX\Sentry;

use Raven_Client;

/**
 * Raven Client - Uses Raven DNS from env.php
 *
 * @package        violuke\Sentry
 * @author         violuke, based on code by Sebwite
 * @copyright      Copyright (c) 2015, Sebwite, 2017 violuke. All rights reserved
 */
class Client extends Raven_Client
{
    public function __construct()
    {
        $ravenDNS = null;
        $options  = [ ];

        if ( php_sapi_name() !== 'cli' )
        {
            $root = __DIR__.'/../../../..';

            if ( is_file($envFile = $root . '/app/etc/env.php') )
            {
                $env = include $envFile;
            }
            else
            {
                throw new \Exception('Cannot read env file');
            }

            $isDeveloper = array_key_exists('MAGE_MODE', $env) && $env[ 'MAGE_MODE' ] === 'developer';

            // Only log to Sentry if the use is not in development mode
            if ( !$isDeveloper )
            {
                $ravenDNS = array_key_exists('raven_dns', $env) ? $env[ 'raven_dns' ] : null;
            }
        }
        $this->setEnvironment($env[ 'MAGE_MODE' ]);
        exec('git describe --always', $version_mini_hash);
        exec('git describe --tags --abbrev=0', $tag);

        $this->tags_context([
            'php_version'   => phpversion(),
            'git_commit'    => $version_mini_hash,
            'git_tag'       => $tag
        ]);

        parent::__construct($ravenDNS, $options);
//        $this->install();
    }
}
