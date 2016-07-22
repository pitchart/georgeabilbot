<?php

namespace Pitchart\GeorgeAbilbot\Service;

class Twitter
{
    /** @var \OAuth */
    private $oauth;

    private $version = 1.1;

    private $host = 'https://api.twitter.com/';

    private $actions = array(
        'update' => 'statuses/update.json',
    );

    /**
     * Twitter constructor.
     * @param \OAuth $oauth
     */
    public function __construct(\OAuth $oauth, $version = null)
    {
        $this->oauth = $oauth;
        if ($version) {
            $this->version = $version;
        }
    }

    public function publish($status){
        $array = array(
            'status' => $status,
        );
        $this->oauth->fetch($this->getUrl('update'), $array, OAUTH_HTTP_METHOD_POST);
    }

    private function getUrl($type) {
        if (array_key_exists($type, $this->actions)) {
            return sprintf('%s%s/%s', $this->host, $this->version, $this->actions[$type]);
        }
        throw new \InvalidArgumentException('Invalid url type');
    }


}