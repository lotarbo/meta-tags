<?php


namespace Lotarbo\MetaTags;


class Utils
{
    public static function escape(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return strip_tags($value);
    }

    public static function cut(?string $value, ?int $length): ?string
    {
        if ($value === null) {
            return null;
        }
        if ($length === null) {
            return $value;
        }
        if (mb_strlen($value) <= $length) {
            return $value;
        }

        return mb_substr($value, 0, mb_strpos($value, ' ', $length));
    }
}