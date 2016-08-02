<?php

namespace Pitchart\GeorgeAbilbot\Service;

use Pitchart\GeorgeAbilbot\Domain\Entity\Tweet;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;


class Response
{
    /** @var ExpressionLanguage */
    private $expressionLanguage;

    /** @var array */
    private $expressionParts = array();

    /** @var string */
    private $message;

    /**
     * Response constructor.
     * @param ExpressionLanguage $expressionLanguage
     * @param array $expression
     * @param string $message
     */
    public function __construct(ExpressionLanguage $expressionLanguage, array $expressionParts, $message)
    {
        $this->expressionLanguage = $expressionLanguage;

        foreach ($expressionParts as $expressionPart) {
            $this->expressionParts[] = $expressionPart;
        }
        $this->message = $message;
    }

    /**
     * @param Tweet $tweet
     * return bool
     */
    public function canApplyTo(Tweet $tweet) {
        foreach ($this->expressionParts as $expression) {
            if ($this->expressionLanguage->evaluate($expression, array('tweet' => $tweet))) {
                return true;
            }
        }
        return false;
    }

    public function getScore(Tweet $tweet) {
        $score = 0;
        foreach ($this->expressionParts as $expression) {
            if ($this->expressionLanguage->evaluate($expression, array('tweet' => $tweet))) {
                $score += 100/count($this->expressionParts);
            }
        }
        return $score * count($this->expressionParts);
    }
}