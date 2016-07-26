<?php

namespace Pitchart\GeorgeAbilbot\Service;

use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter
{
    /** @var \OAuth */
    private $oauth;

    private $actions = array(
        'connexion' => 'account/verify_credentials',
        'update' => 'statuses/update',
    );

    /**
     * Twitter constructor.
     * @param \OAuth $oauth
     */
    public function __construct(TwitterOAuth $oauth)
    {
        $this->oauth = $oauth;
    }

    public function publish($status){
        $array = array(
            'status' => $status,
        );
        return $this->oauth->post($this->getUrl('update'), $array);
    }

    public function testConnection() {
        return $this->oauth->get($this->getUrl('connexion'));
    }

    private function getUrl($type) {
        if (array_key_exists($type, $this->actions)) {
            return $this->actions[$type];
        }
        throw new \InvalidArgumentException('Invalid url type');
    }


}