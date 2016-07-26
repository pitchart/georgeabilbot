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
        'search' => 'search/tweets',
    );

    /**
     * Twitter constructor.
     * @param \OAuth $oauth
     */
    public function __construct(TwitterOAuth $oauth)
    {
        $this->oauth = $oauth;
    }

    /**
     * @param $status
     * @return array|object
     */
    public function publish($status){
        $array = array(
            'status' => $status,
        );
        return $this->oauth->post($this->getUrl('update'), $array);
    }

    /**
     * @return array|object
     */
    public function testConnection() {
        return $this->oauth->get($this->getUrl('connexion'));
    }

    /**
     * @param $terms
     * @return array|object
     */
    public function search($terms) {
        return $this->oauth->get($this->getUrl('search'), array(
            'q' => $terms,
        ));
    }

    /**
     * @param string $type
     * @return string
     * @throws \InvalidArgumentException
     */
    private function getUrl($type) {
        if (array_key_exists($type, $this->actions)) {
            return $this->actions[$type];
        }
        throw new \InvalidArgumentException('Invalid twitter url type');
    }

}