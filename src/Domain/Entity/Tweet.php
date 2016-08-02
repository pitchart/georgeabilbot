<?php

namespace Pitchart\GeorgeAbilbot\Domain\Entity;

class Tweet
{
    private $username;

    private $createdDate;

    private $text;

    private $idStr;

    /**
     * Tweet constructor.
     * @param $username
     * @param $createdDate
     * @param $text
     * @param $idStr
     */
    public function __construct($username, $createdDate, $text, $idStr)
    {
        $this->username = $username;
        $this->createdDate = $createdDate;
        $this->text = $text;
        $this->idStr = $idStr;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getIdStr()
    {
        return $this->idStr;
    }

}