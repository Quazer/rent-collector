<?php

namespace AppBundle\Model\Logic\Filter\RawContent;

use AppBundle\Model\Logic\Collector\RawData;

class VkCommentRawContentFilter implements RawContentFilterInterface
{
    /**
     * @param RawData $raw
     * @return bool
     */
    public function handle(RawData $raw)
    {
        return true;
    }
}
