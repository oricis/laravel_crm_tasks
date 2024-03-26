<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

$funcName = 'getAppRoute';
if (!function_exists($funcName)) {
    function getAppRoute(): string
    {
        $route = getCurrentRoute();
        $appRoute = parse_url($route, PHP_URL_SCHEME)
            . '://'
            . parse_url($route, PHP_URL_HOST);

        return $appRoute;
    }
} else {
    logger('@@@ Helper func "routes / ' . $funcName . '()" already EXISTS !');
}

$funcName = 'getCurrentRoute';
if (!function_exists($funcName)) {
    function getCurrentRoute(): string
    {
        return Request::url();
    }
} else {
    logger('@@@ Helper func "routes / ' . $funcName . '()" already EXISTS !');
}

$funcName = 'getCurrentDomain';
if (!function_exists($funcName)) {
    function getCurrentDomain(): string
    {
        return Request::getHost();
    }
} else {
    logger('@@@ Helper func "routes / ' . $funcName . '()" already EXISTS !');
}

$funcName = 'getRouteParameters';
if (!function_exists($funcName)) {
    function getRouteParameters(): array
    {
        return ($route = request()->route())
            ? $route->parameters
            : [];
    }
} else {
    logger('@@@ Helper func "routes / ' . $funcName . '()" already EXISTS !');
}

$funcName = 'getRouteLastSlice';
if (!function_exists($funcName)) {
    function getRouteLastSlice(string $route = ''): string
    {
        $route = ($route) ? $route : getCurrentRoute();

        $slice = '';
        $routeSlices = explode('/', $route);

        if ($routeSlices) {
            $lastSlicePos = count($routeSlices) - 1;
            $slice = ($routeSlices[$lastSlicePos]) ? $routeSlices[$lastSlicePos] : $routeSlices[$lastSlicePos - 1];
        }

        return $slice;
    }
} else {
    logger('@@@ Helper func "routes / ' . $funcName . '()" already EXISTS !');
}

$funcName = 'routeHas';
if (!function_exists($funcName)) {
    function routeHas(string $needle, string $route = ''): bool
    {
        $route = getCurrentRoute();

        return ($route && str_contains($route, $needle));
    }
} else {
    logger('@@@ Helper func "routes / ' . $funcName . '()" already EXISTS !');
}

$funcName = 'traceRoute';
if (!function_exists($funcName)) {
    function traceRoute(): void
    {
        $route  = Route::current(); // object
        $name   = Route::currentRouteName(); // string
        $action = Route::currentRouteAction(); // string
        dd(
            $route,
            'Middlewares: ' . json_encode($route->computedMiddleware),
            'Parameters: ' . json_encode($route->parameters),
            'URI: ' . $route->uri,
            'Route name: ' . $name,
            'Route action: ' . $action
        );
    }
} else {
    logger('@@@ Helper func "routes / ' . $funcName . '()" already EXISTS !');
}
