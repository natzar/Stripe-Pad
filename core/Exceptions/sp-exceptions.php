<?php
// Base custom exception which other exceptions can extend
namespace StripePad\Exceptions;

use Exception;


class StripePadException extends Exception
{

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $_SESSION['errors'][] = $message;
    }
}

class PermissionsException extends StripePadException {}
class DatabaseException extends StripePadException {}

class FileSystemException extends StripePadException {}

class ValidationException extends StripePadException {}
