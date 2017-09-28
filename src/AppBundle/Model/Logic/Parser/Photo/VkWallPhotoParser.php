<?php

namespace AppBundle\Model\Logic\Parser\Photo;

use AppBundle\Exception\ParseException;
use Schema\Note\Photo;

class VkWallPhotoParser implements PhotoParserInterface
{
    /**
     * @param $data
     * @return Photo[]
     * @throws ParseException
     */
    public function parse($data)
    {
        if (!is_array($data)) {
            throw new ParseException(sprintf('%s: data is not an array', __CLASS__ . '\\' . __FUNCTION__));
        }

        $photos = [];

        if (!array_key_exists('attachments', $data)) {
            return $photos;
        }

        foreach ($data['attachments'] as $attachment) {
            if (!array_key_exists('photo', $attachment)) {
                continue;
            }

            $photo = $attachment['photo'];

            switch (true) {
                case array_key_exists('photo_604', $photo):
                    $low = $photo['photo_604'];
                    break;
                case array_key_exists('photo_130', $photo):
                    $low = $photo['photo_130'];
                    break;
                default:
                    $low = null;
            }

            switch (true) {
                case array_key_exists('photo_1280', $photo):
                    $high = $photo['photo_1280'];
                    break;
                case array_key_exists('photo_807', $photo):
                    $high = $photo['photo_807'];
                    break;
                case array_key_exists('photo_604', $photo):
                    $high = $photo['photo_604'];
                    break;
                default:
                    $high = null;
            }

            if (null === $low || null == $high) {
                continue;
            }

            $photos[] =
                (new Photo())
                    ->setHigh($high)
                    ->setLow($low);
        }

        return $photos;
    }
}
