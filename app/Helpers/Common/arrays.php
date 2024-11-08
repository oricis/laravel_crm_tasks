<?php

declare(strict_types=1);

$funcName = 'removeArrElementsByIndex';
if (!function_exists($funcName)) {
    function removeArrElementsByIndex(array $arr, array $indexesToRemove): array
    {
        foreach ($indexesToRemove as $arrIndex) {
            unset($arr[$arrIndex]);
        }

        return $arr;
    }
} else {
    logger('@@@ Helper func "arrays / ' . $funcName . '()" already EXISTS !');
}
