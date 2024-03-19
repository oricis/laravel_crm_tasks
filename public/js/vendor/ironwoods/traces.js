/**
 * JS-UI
 *
 * Wrap functions to beatify console log traces
 *
 * Moisés Alcocer, 2021
 * https://www.ironwoods.es / https://github.com/oricis/js-ui
 * MIT Licence
 */

'use strict';

function api() // void
{
    console.log(
        '%c==> API CALL !!!',
        'padding:3px 5px; border-radius:7px 0 7px 0; font-weight:bold; background:black; color:lime'
    );
    log(...arguments);
}
function async() // void
{
    console.log(
        '%c==> ASYNC CALL !!!',
        'padding:3px 5px; border-radius:7px 0 7px 0; font-weight:bold; background:black; color:lime'
    );
    log(...arguments);
}

function colorize(data, color, bold = false) // void
{
    bold = (bold) ? ';font-weight:bold' : '';
    color = (color) ? color : 'grey';
    if (typeof data !== 'object') {
        console.log('%c' + data, 'color:' + color + bold);
    } else {
        console.log(data);
    }
}
function echo() // void
{
    for (var i = 0; i < arguments.length; i++) {
        console.log(
            '%c' + arguments[i],
            'padding:3px 5px; border-radius:7px 0 7px 0; font-weight:bold;'
        );
    }
}
function err() // void
{
    const color = 'red';
    console.log(
        '%c==> ERROR !!!',
        'padding:3px 5px; border-radius:7px 0 7px 0; font-weight:bold; background:#ffc0b0; color:' + color
    );
    for (var i = 0; i < arguments.length; i++) {
        colorize(arguments[i], color);
    }
}
function error() // void
{
    err(...arguments);
}
function event(message, event = 'click') // void
{
    const color = '#0066ff';
    if (event) {
        console.log(
            '%c==> ' + new String(event).toUpperCase() + ' !!!',
            'padding:3px 5px; border-radius:7px 0 7px 0; background:#e6f0ff; color:' + color
        );
        colorize(message, color, true);
        return;
    }
    console.log('%cMessage:' + message + '\n', 'background:#e6f0ff; color:' + color);
}
function hack() // void
{
    console.log(
        '%c==> HACK !!!',
        'padding:3px 5px; border-radius:7px 0 7px 0; font-weight:bold; background:#40bd44; color:#ffee00'
    );
    log(...arguments);
}
function loaded(message) // void
{
    const bgColor = 'blue';
    console.log(
        '%cLOADED: ' + message,
        'padding:5px 9px; border-radius:7px 0 7px 0; font-weight:bold; color:' + bgColor
    );
}

function log() // void
{
    for (var i = 0; i < arguments.length; i++) {
        console.log(arguments[i]);
    }
}
function logger() // void
{
    log(...arguments);
}
function note(message) // void
{
    const bgColor = '#4aca6e';
    console.log(
        '%cNOTE:',
        'padding:5px 9px; border-radius:7px 0 7px 0; font-weight:bold; background:' + bgColor
    );
    console.log('%cMessage:' + message, 'padding:3px 5px; border-radius:5px 0 5px 0; background:' + bgColor);
}
function todo(message) // void
{
    const bgColor = '#1E90FF';
    console.log(
        '%cTODO:',
        'padding:5px 9px; border-radius:7px 0 7px 0; font-weight:bold; background:' + bgColor
    );
    console.log('%cMessage:' + message, 'padding:3px 5px; border-radius:5px 0 5px 0; background:' + bgColor);
}
function warn() // void
{
    console.log(
        '%cWARN:',
        'padding:3px 5px; border-radius:7px 0 7px 0; font-weight:bold; background:yellow; color:red',
    );
    for (var i = 0; i < arguments.length; i++) {
        console.warn(arguments[i]);
    }
}
function warning(message) // void
{
    warn(...arguments);
}
