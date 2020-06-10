<?php

namespace Demo\App;

use Exception;

class LocalStorage implements GenericStorageInterface
{
    const STORAGE_DIR = './storage/';

    /**
     * @param string $path
     * @return boolean
     */
    public function put(string $path)
    {
        try {
            $content  = file_get_contents($path);
            $filename = pathinfo($path, PATHINFO_BASENAME);

            $file = fopen(self::STORAGE_DIR.$filename, "w");
            fwrite($file, $content);
            fclose($file);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param string $filename
     * @return false|string
     */
    public function get(string $filename)
    {
        try {
            return file_get_contents(self::STORAGE_DIR.$filename);
        } catch (Exception $e) {
            return false;
        }
    }
}