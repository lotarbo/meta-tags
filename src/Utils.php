<?php


namespace Lotarbo\MetaTags;


class Utils
{
    public static function escape($value)
    {
        if ($value === null) {
            return null;
        }

        return strip_tags($value);
    }
}