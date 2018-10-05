<?php

namespace DTuX\Sentry\Sentry;

use \Psr\Log\LogLevel;
use Monolog\Handler\RavenHandler;

class Handler extends RavenHandler
{
    /**
     * Handler constructor.
     * @param $ravenClient \DTuX\Sentry\Sentry\Client
     * @param $level
     * @param bool $bubble
     */
    public function __construct($ravenClient, $level = LogLevel::DEBUG, $bubble = true)
    {

        if (is_array($ravenClient) && array_key_exists('instance', $ravenClient)) {

            $ravenClient = new $ravenClient['instance'];
        }

        $this->setFormatter(new \Monolog\Formatter\LineFormatter("%message% %context% %extra%\n"));

        $ravenClient->setRelease('000000000001111111111122');
        $ravenClient->setEnvironment(getenv('MAGENTO_RUN_MODE'));

        parent::__construct($ravenClient, $level, $bubble);
    }

}