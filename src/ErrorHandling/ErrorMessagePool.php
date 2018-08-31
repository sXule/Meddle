<?php

namespace Meddle\ErrorHandling;

class ErrorMessagePool
{
    public static function get(string $key, $arg = null)
    {
        $errorFilePath = __DIR__.'/errors.json';
        $errorsContents = file_get_contents($errorFilePath);
        $errors = json_decode($errorsContents, true);

        if (!isset($errors[$key])) {
            return "An error occurred!";
        }

        $error = sprintf($errors[$key], $arg);

        return $error;
    }
}