/**
 * JS-UI v.1.4.0
 *
 * Moisés Alcocer, 2020
 * https://www.ironwoods.es
 * MIT Licence
 */

loaded('"ui.js"');

// check if the key exist in object / array
var existObjectKey = function existObjectKey(obj, key) {
  return obj[key] !== undefined;
}

var submitFormTo = function submitFormTo(route, form) {
  form.action = route;
  form.submit();
}

var getLastSlice = function getLastSlice(str, separator) {
  separator = separator ? separator : '/';
  var strSlices = str.split(separator);
  return strSlices[strSlices.length - 1];
}

var getSlice = function getSlice(str, position, separator) {
  separator = separator ? separator : '/';
  var strSlices = str.split(separator);

  if (position < 0) {
    position = strSlices.length + position;
  }

  return position < strSlices.length ? strSlices[position] : '';
}

var getSlicesLength = function getSlicesLength(str, separator) {
  separator = separator ? separator : '/';
  return str.split(separator).length;
}

var replaceLastSlice = function replaceLastSlice(str, newSlice, separator) {
  separator = separator ? separator : '/';
  var strSlices = str.split(separator);
  strSlices[strSlices.length - 1] = newSlice;
  return strSlices.join(separator);
}

var replaceSlice = function replaceSlice(str, newSlice, position, separator) {
  if (!str || (!position && position !== 0)) {
    error('ERR - replaceSlice() - Something is wrong with the params!');
    return '';
  }
  newSlice  = newSlice  ? newSlice  : '';
  separator = separator ? separator : '/';

  var strSlices = str.split(separator);

  if (position < 0) {
    position = strSlices.length + position;
  }

  if (position >= strSlices.length) {
    console.error('ERR - Too few parts for position: ' + position);
    return '';
  }

  strSlices[position] = newSlice;
  return strSlices.join(separator);
}

var strhas = function strhas(haystack, needle) {
  return haystack.indexOf(needle) >= 0;
}

var strpos = function strpos(haystack, needle) {
  return haystack.indexOf(needle);
}

var $ = function $(selector) {
  if (selector.indexOf("#") === 0 && selector.indexOf(' ') < 0) {
    return document.querySelector(selector);
  }

  return document.querySelectorAll(selector);
}

var removeAttr = function removeAttr(selector, attrName) {
  var target = getTargetDomNode(selector);
  target.removeAttribute(attrName);
}

var removeAttrFrom = function removeAttrFrom(element, attrName) {
  element.removeAttribute(attrName);
}

var getAttrValue = function getAttrValue(selector, attrName) {
  var target = getTargetDomNode(selector);
  var result = target.getAttribute(attrName);
  return result ? result : '';
}

var getAttrValueFrom = function getAttrValueFrom(element, attrName) {
  var result = element.getAttribute(attrName);
  return result ? result : '';
}

var getDataValue = function getDataValue(selector, dataName) {
  var target = getTargetDomNode(selector);
  var result = target.dataset[dataName];
  return result ? result : '';
}

var getDataValueFrom = function getDataValueFrom(element, dataName) {
  var result = element.dataset[dataName];
  return result ? result : '';
}

function getTargetDomNode(selector) {
  var target = $(selector);

  if (Array.isArray(target) && target) {
    target = target[0];
  }

  return target;
}

var addClass = function addClass(selector, className, position) {
  position = position ? position : 0;
  var target = $(selector);

  if (target && target.length > 1) {
    if (position === 'all') {
      target.forEach(function (element) {
        addClassTo(element, className);
      });
    } else {
      addClassTo(target[position], className);
    }

    return;
  } // $('#foo')  returns an element
  // $('div p') returns an node collection


  if (target[position] != undefined) addClassTo(target[position], className); else addClassTo(target, className);
}

var addClassTo = function addClassTo(element, className) {
  element.classList.add(className);
}

var addClassToAll = function addClassToAll(elements, className) {
  if (!elements || typeof (elements) !== 'object') {
    console.error('addClassToAll() => Err args');
    return;
  }

  elements.forEach(function (element) {
    addClassTo(element, className);
  });
}

var getClass = function getClass(selector, position) {
  position = position ? position : 0;
  var target = $(selector);

  if (target && target.length > 1) {
    if (position === 'all') {
      var classNames = [];
      target.forEach(function (element) {
        classNames.push(element.className);
      });
      return classNames; // array
    }

    return getClassFrom(target[position]); // string
  }

  return getClassFrom(target[position]); // string
}

var getClassFrom = function getClassFrom(element) {
  return element.className; // string
}

var hasClass = function hasClass(element, className) {
  return element.classList.contains(className);
}

var removeClass = function removeClass(selector, className, position) {
  position = position ? position : 0;
  var target = $(selector);

  if (target && target.length > 1) {
    if (position === 'all') {
      target.forEach(function (element) {
        removeClassFrom(element, className);
      });
    } else {
      removeClassFrom(target[position], className);
    }

    return;
  } // $('#foo')  returns an element
  // $('div p') returns an node collection


  if (target[position] != undefined) removeClassFrom(target[position], className); else removeClassFrom(target, className);
}

var removeClassFrom = function removeClassFrom(element, className) {
  element.classList.remove(className);
}

var removeClassFromAll = function removeClassFromAll(elements, className) {
  if (!elements || typeof (elements) !== 'object') {
    console.error('removeClassFromAll() => Err args');
    return;
  }

  elements.forEach(function (element) {
    removeClassFrom(element, className);
  });
}

var toggleClassOf = function toggleClassOf(node, className) {
  node.classList.toggle(className);
}

var addTextById = function addTextById(id, content) {
  id = getId(id);
  var textContent = getText($(id));
  setText($(id), textContent + content);
}

function getId(id) {
  return id.indexOf('#') === 0 ? id : '#' + id;
}

function getText(element) {
  return element.innerText;
}

var removeText = function removeText(selector, position) {
  position = position ? position : 0;
  var target = $(selector);

  if (target && target.length > 1) {
    if (position === 'all') {
      target.forEach(function (element) {
        element.innerText = '';
      });
    } else {
      target[position].innerText = '';
    }

    return;
  }

  setText(target, '');
}

var removeTextById = function removeTextById(id) {
  id = getId(id);
  setText($(id), '');
}

function setText(element, content) {
  element.innerText = content;
}

var setTextById = function setTextById(id, content) {
  id = getId(id);
  setText($(id), content);
}
