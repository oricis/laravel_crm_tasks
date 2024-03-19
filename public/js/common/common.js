'use strict';
loaded('js/common/common.js');

////////////////////////////////////////////////////////////////////////

function closeFb() // void
{
    removeNode('.alert-background');
    removeNode('.alert');
}

function removeNode(nodeOrSelector, callbackFunc = null) // void
{
    const node = (typeof nodeOrSelector === 'string')
        ? qs(nodeOrSelector)
        : nodeOrSelector;

    if (node) {
        node.parentNode.removeChild(node);
    }
    if (callbackFunc) {
        callbackFunc();
    }
}
