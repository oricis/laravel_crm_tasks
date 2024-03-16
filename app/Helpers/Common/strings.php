<?php

declare(strict_types=1);


$funcName = 'getLastSlice';
if (!function_exists($funcName)) {
    function getLastSlice(string $str = '', string $separator = '/'): string
    {
        $slices = explode($separator, $str);

        return $slices[count($slices) - 1];
    }
} else {
    logger('@@@ Helper func "strings / ' . $funcName . '()" already EXISTS !');
}
