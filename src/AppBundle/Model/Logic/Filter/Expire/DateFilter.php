<?php

namespace AppBundle\Model\Logic\Filter\Expire;

use Schema\Note\Note;

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
     * @param Note $note
     * @return bool
     */
    public function isExpire(Note $note)
    {
        return (int)$this->timestamp >= (int)$note->getTimestamp();
    }
}