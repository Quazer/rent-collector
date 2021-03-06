<?php

namespace AppBundle\Model\Logic\Filter\Expire;

class DateFilter
{
    /**
     * @var int
     */
    private $timestamp;

    /**
     * DateFilter constructor.
     */
    public function __construct()
    {
        $this->timestamp = (new \DateTime())->modify('- 4 week')->getTimestamp();
    }

    /**
     * @param int $timestamp
     * @return bool
     */
    public function isExpire(int $timestamp)
    {
        return $timestamp < (int)$this->timestamp;
    }
}