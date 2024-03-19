'use strict';
loaded('js/common/query.js');

////////////////////////////////////////////////////////////////////////

// https://github.com/oricis/JS-UI/blob/develop/src/dom/query.js
function qs(selector, node) // js node
{
    return (node || document).querySelector(selector);
}

// https://github.com/oricis/JS-UI/blob/develop/src/dom/query.js
function qsa(selector, node) // js node/s
{
    return (node || document).querySelectorAll(selector);
}
