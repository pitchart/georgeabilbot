<?php

namespace Pitchart\GeorgeAbilbot\Service;

use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter
{
    /** @var \OAuth */
    private $oauth;

    private $version = 1.1;

    private $host = 'https://api.twitter.com/';

    private $actions = array(
        'update' => 'statuses/update',
    );

    /**
     * Twitter constructor.
     * @param \OAuth $oauth
     */
    public function __construct(TwitterOAuth $oauth, $version = null)
    {
        $this->oauth = $oauth;
        if ($version) {
            $this->version = $version;
        }
    }

    public function publish($status){
        return $this->oauth->post($this->getUrl('update'), array(
            'status' => $status,
        ));
    }

    private function getUrl($type) {
        if (array_key_exists($type, $this->actions)) {
            return $this->actions[$type];
        }
        throw new \InvalidArgumentException('Invalid url type');
    }


}