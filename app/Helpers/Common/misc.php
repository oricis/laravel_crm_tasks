<?php

declare(strict_types=1);

$funcName = 'getRandomId';
if (!function_exists($funcName)) {
    function getRandomId(string $modelClass): int
    {
        try {
            return $modelClass::inRandomOrder()
                ->limit(10)
                ->first('id')
                ->id;
        } catch (\Exception $e) {
            error(getExceptionStr($e));
            return 0;
        }
    }
} else {
    logger('@@@ Helper func "misc / ' . $funcName . '()" already EXISTS !');
}

