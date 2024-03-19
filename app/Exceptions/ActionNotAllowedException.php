<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

final class ActionNotAllowedException extends Exception
{

    public function __construct(
        string $message = 'Action not allowed',
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
