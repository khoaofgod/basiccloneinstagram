<?php
/*
 * Khoa. B custom helper for SEO
 */

namespace App\Http\Helpers;

use Illuminate\Support\Facades\App;

class Social
{
    /*
     * return a seo friend link URL string
     */
    public static function seoLink($text) {
        return preg_replace("/[^a-zA-Z0-9]+/","-",trim(strtolower($text)));
    }

    /**
     * Return Avatar Link Profile
     * @param $email
     * @return string
     */
    public static function avatar($email) {
        $linkPath = "storage/avatar/".self::getHash($email).".jpg";
        $img = public_path($linkPath);
        return file_exists($img) ? "/{$linkPath}" : "https://www.gravatar.com/avatar/".self::getHash($email)."?s=200";
    }


    /**
     * Generate hash MD5
     * @param $text
     * @return string
     */
    public static function getHash($text) {
        return md5(strtolower($text));
    }
}
