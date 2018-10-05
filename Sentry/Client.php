<?php

namespace DTuX\Sentry\Sentry;

use Raven_Client;

/**
 * Raven Client - Uses Raven DNS from env.php
 *
 * @package        Sentry\Sentry
 */
class Client extends Raven_Client
{
    public function __construct()
    {
        $ravenDNS = null;
        $options = [];

        if (php_sapi_name() !== 'cli') {
            $root = __DIR__ . '/../../../..';

            if (is_file($envFile = $root . '/etc/env.php')) {
                $env = include $envFile;
            } else {
                throw new \Exception('Cannot read env file');
            }

            $isDeveloper = array_key_exists('MAGE_MODE', $env) && $env['MAGE_MODE'] === 'developer';

            // Only log to Sentry if the use is not in development mode
            if (!$isDeveloper) {
                $ravenDNS = array_key_exists('raven_dns', $env) ? $env['raven_dns'] : null;
            }

        }


        parent::__construct($ravenDNS, $options);

//        $this->install();
    }
}
