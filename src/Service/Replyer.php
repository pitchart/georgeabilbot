<?php

namespace Pitchart\GeorgeAbilbot\Service;

use Pitchart\GeorgeAbilbot\Domain\Entity\Tweet;

class Replyer
{
    /**
     * @var array
     */
    private $responses = array();

    public function __construct(array $responses) {
        foreach ($responses as $response) {
            if (!($response instanceof Response)) {
                throw new \InvalidArgumentException('Invalid response '.$response);
            }
            $this->responses[] = $response;
        }
    }

    /**
     * @param Tweet $tweet
     * return bool
     */
    public function canReply(Tweet $tweet) {
        /** @var Response $response */
        foreach ($this->responses as $response) {
            if ($response->canApplyTo($tweet)) {
                return true;
            }
        }
        return false;
    }

    public function getPreferedResponse(Tweet $tweet) {
        $preferedResponse = null;
        if ($this->canReply($tweet)) {
            $score = 0;
            /** @var Response $response */
            foreach ($this->responses as $response) {
                $responseScore = $response->getScore($tweet);
                if ($responseScore > $score) {
                    $score = $responseScore;
                    $preferedResponse = $response;
                }
                elseif ($responseScore == $score) {
                    $preferedResponse = rand(0,99) % 2 == 0 ? $preferedResponse : $response;
                }
            }
        }
        return $preferedResponse;
    }


}