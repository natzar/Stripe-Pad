<?php
namespace StripePad\Exceptions;

use Exception;


class StripePadException extends Exception
{
   


    public function __construct($message, $code = 0, Exception $previous = null)
    {
        
        parent::__construct($message, $code, $previous);
        $_SESSION['errors'][] = $message;
        //include_once ROOT_PATH . "app/views/errors/error.php";
    }
}

class PermissionsException extends StripePadException {
    const INVALID_PERMISSIONS = "ERROR: Invalid permissions.";
}
class DatabaseException extends StripePadException {

}
class FileSystemException extends StripePadException {
    const INVALID_PERMISSIONS = "ERROR: Invalid permissions.";
    const FILE_NOT_EXISTS = "ERROR: Invalid permissions.";
}
class ValidationException extends StripePadException {}
