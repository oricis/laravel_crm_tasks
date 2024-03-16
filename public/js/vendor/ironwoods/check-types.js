/**
 * MIT License - Copyright (c) 2020 Moisés Alcocer
 *
 * contacto@ironwoods.es
 * https://www.ironwoods.es
 */

function checkArray(data) // bool
{
    return (Array.isArray(data));
}

function checkNull(data) // bool
{
    return (typeof data !== 'undefined' &&
        (typeof data !== 'object' || !data));
}

function checkNumber(data) // bool
{
    return (typeof (data) === 'number');
}

function checkObject(data) // bool
{
    return (data !== null
        && typeof (data) === 'object'
        && ! Array.isArray(data));
}

function checkString(data)  // bool
{
    return (data !== null
        && typeof (data) === 'string');
}

////////////////////////////////////////////////////////////////////////
// Aliases

function isArray(data) // bool
{
    return checkArray(data);
}

function isNull(data) // bool
{
    return checkNull(data);
}

function isNumber(data) // bool
{
    return checkNumber(data);
}

function isObject(data) // bool
{
    return checkObject(data);
}

function isString(data) // bool
{
    return checkString(data);
}
