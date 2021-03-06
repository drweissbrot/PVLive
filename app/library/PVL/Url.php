<?php
namespace PVL;

class Url extends \DF\Url
{
    /**
     * Return path for API function call.
     *
     * @param null $path
     * @return null|string
     */
    public static function api($path = NULL)
    {
        if (is_array($path))
        {
            $prev_include_domain = self::$include_domain;
            self::$include_domain = false;

            $path = self::route($path);

            self::$include_domain = $prev_include_domain;
        }

        if (defined('DF_API_URL'))
        {
            $path = ltrim($path, '/api');
            return DF_API_URL.'/'.ltrim($path, '/');
        }
        else
        {
            return self::getUrl($path);
        }
    }

    /**
     * Return URL for user-uploaded content.
     *
     * @param null $path
     * @return string
     */
    public static function upload($path = NULL)
    {
        if (defined('DF_UPLOAD_URL'))
            return DF_UPLOAD_URL.'/'.ltrim($path, '/');
        else
            return self::content($path);
    }
}