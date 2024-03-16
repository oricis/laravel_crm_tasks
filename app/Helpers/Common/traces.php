<?php

declare(strict_types=1);


$funcName = 'getExceptionStr';
if (!function_exists($funcName)) {
    function getExceptionStr(\Exception $exception): string
    {
        return date('Y-m-d H:i:s')
            . '<br>File: ' . $exception->getFile() . PHP_EOL
            . ' / Line: ' . $exception->getLine() . PHP_EOL
            . '<br>Exception: ' . $exception->getMessage();
    }
} else {
    logger('@@@ Helper func "traces / ' . $funcName . '()" already EXISTS !');
}

$funcName = 'go';
if (!function_exists($funcName)) {
    function go(array $backtrace = [], int $level = 1): string
    {
        $backtrace = ($backtrace)
            ? $backtrace
            : debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $level + 1);

        $funcName = (isset($backtrace[$level]['function']))
            ? $backtrace[$level]['function']
            : 'function_name_no_present';
        $shortedClassName = (isset($backtrace[$level]['class']))
            ? getLastSlice($backtrace[$level]['class'], '\\')
            : 'func ';

        return $shortedClassName . '@' . $funcName;
    }
} else {
    logger('@@@ Helper func "traces / ' . $funcName . '()" already EXISTS !');
}
