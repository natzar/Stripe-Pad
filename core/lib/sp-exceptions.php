<?php

namespace StripePad\Exceptions;

class StripePadException extends \Exception
{
    public function __construct(string $message = '', int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        // Si quieres, conserva esta línea; si no, sácala del constructor.
        $_SESSION['errors'][] = $message;
        log::system($message);
    }
}

class ViewException extends StripePadException
{
    public const INVALID_PERMISSIONS = "ERROR: Invalid permissions.";
    public const TPL_NOT_FOUND       = "ERROR: Template file not found.";

    public function __construct(string $message = self::INVALID_PERMISSIONS, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class PermissionsException extends StripePadException
{
    public const INVALID_PERMISSIONS = "ERROR: Invalid permissions.";

    public function __construct(string $message = self::INVALID_PERMISSIONS, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class DatabaseException extends StripePadException
{
    public const CONNECTION_FAILED = "DATABASE ERROR: Please check your database server is running and your connection settings at sp-config.php are correct.";

    public function __construct(string $message = self::CONNECTION_FAILED, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class FileSystemException extends StripePadException
{
    const INVALID_PERMISSIONS = "ERROR: Invalid permissions.";
    const FILE_NOT_EXISTS = "ERROR: Invalid permissions.";
}
class ValidationException extends StripePadException {}
