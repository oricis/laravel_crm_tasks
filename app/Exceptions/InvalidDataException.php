<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

final class InvalidDataException extends Exception
{

    public function __construct(
        string $message = 'Something is wrong with the data',
        int $code = 0
    )
    {
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        return $this->getMessage();
    }
}
