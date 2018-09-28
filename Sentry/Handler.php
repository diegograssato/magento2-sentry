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
        $client->setRelease($tag);


        parent::__construct($ravenClient, $level, $bubble);

//        $this->registerExceptionHandler();
//        $this->registerErrorHandler();
//        $this->registerShutdownFunction();
    }

    /**
     * Get the hash of the current git HEAD
     * @param str $branch The git branch to check
     * @return mixed Either the hash or a boolean false
     */
    function get_current_git_commit($branch = 'master')
    {
        if ($hash = file_get_contents(sprintf('.git/refs/heads/%s', $branch))) {
            return $hash;
        } else {
            return false;
        }
    }
}