<?php

namespace DTuX\Sentry;

use Monolog\Logger;

class Handler extends \Raven_ErrorHandler
{
    /**
     * Handler constructor.
     * @param $ravenClient \DTuX\Sentry\Client
     * @param $level
     * @param bool $bubble
     */
    public function __construct($ravenClient, $level = Logger::DEBUG, $bubble = true)
    {

        if (is_array($ravenClient) && array_key_exists('instance', $ravenClient)) {
            $ravenClient = new $ravenClient['instance'];
        }

        parent::__construct($ravenClient, $level, $bubble);

//        $this->registerExceptionHandler();
//        $this->registerErrorHandler();
//        $this->registerShutdownFunction();
    }

}