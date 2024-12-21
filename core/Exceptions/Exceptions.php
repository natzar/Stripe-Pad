<?php
// Base custom exception which other exceptions can extend
class BaseCustomException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function customLog()
    {
        // Log the error details somewhere
        error_log($this->message);
    }
}

// Specific custom exception for database errors
class DatabaseException extends BaseCustomException
{
    public function additionalInfo()
    {
        return "Database connection failed: " . $this->getMessage();
    }
}

// Specific custom exception for user input errors
class InputException extends BaseCustomException
{
    public function suggestSolution()
    {
        return "Please check the provided input values.";
    }
}
