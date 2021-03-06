<?php

namespace Sxule\Meddle;

use Sxule\Meddle\Exceptions\MeddleException;
use Sxule\Meddle\ErrorHandling\ErrorMessagePool;

class Caching
{
    private static $cacheDir;

    /**
     * Saves file to cache directory.
     *
     * @param string $hash      Hash used to identify file
     * @param string $type      PHP or HTML
     * @param string $content   Content to be saved to file
     * @throws MeddleException
     * @return boolean Returns true on success, or false
     */
    public static function saveFile(string $hash, string $type, string $content)
    {
        $cacheDir = self::$cacheDir ?: dirname(__DIR__, 1).'/cache';

        $type = strtolower($type);
        $dir = "$cacheDir";
        $path = "$dir/$hash.$type";
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $bytes = file_put_contents($path, $content);

        if (empty($path) || $bytes === false) {
            throw new MeddleException(ErrorMessagePool::get('cachingSaveFileError'));
        }

        return $path;
    }

    /**
     * Removes cache file
     *
     * @param string $hash      Hash used to identify file
     * @param string $type      PHP or HTML
     *
     * @throws MeddleException
     *
     * @return boolean  Returns true if successfully removed, or false
     *                  Also true if file never existed
     */
    public static function removeFile(string $hash, string $type)
    {
        $cacheDir = self::$cacheDir ?: dirname(__DIR__, 2).'/cache';

        $success = true;
        $type = strtolower($type);
        $dir = "$cacheDir";
        $path = "$dir/$hash.$type";
        if (file_exists($path)) {
            $success = unlink($path);
        }

        if (!$success) {
            throw new MeddleException(ErrorMessagePool::get('cachingRemoveFileError'));
        }

        return $success;
    }

    /**
     * Gets cached file path
     *
     * @param string $hash  Hash used to identify file
     * @param string $type  PHP or HTML
     * @return void
     */
    public static function getFilePath(string $hash, string $type)
    {
        $cacheDir = self::$cacheDir ?: dirname(__DIR__, 2).'/cache';
        $type = strtolower($type);
        $path = "$cacheDir/$hash.$type";

        if (!file_exists($path)) {
            return null;
        }

        return $path;
    }

    /**
     * @param string $cacheDir
     * @return void
     */
    public static function setCacheDirectory(string $cacheDir)
    {
        self::$cacheDir = $cacheDir;
    }
}