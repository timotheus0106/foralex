/**
 * Descrition
 */
define(function () {
    "use strict";

    /**
     * This is our classes constructor;
     */
    function Elements() {
        if (!(this instanceof Elements)) {
            throw new TypeError("Elements constructor cannot be called as a function.");
        }
    }

    function isElement(obj) {
      try {
        //Using W3 DOM2 (works for FF, Opera and Chrome)
        // return obj instanceof HTMLElement;
        if(!(obj instanceof HTMLElement)){
          el = find(el);
          return el.length > 0;
        }
        return true;
      }
      catch(e){
        //Browsers not supporting W3 DOM2 don't have HTMLElement and
        //an exception is thrown and we end up here. Testing some
        //properties that all elements have. (works on IE7)
        return (typeof obj==="object") &&
          (obj.nodeType===1) && (typeof obj.style === "object") &&
          (typeof obj.ownerDocument ==="object");
      }
    }

    Elements.prototype = {
        constructor: Elements,
        find: find,
        hasClass: hasClass,
        addClass: addClass,
        removeClass: removeClass,
        toggleClass: toggleClass,
        exists: exists
    };

    function find(querySelector){
        return document.querySelectorAll(querySelector);
    }

    function hasClass(el, className){
      if(!isElement(el)){
        return false;
      }
      if (el.classList){
          return el.classList.contains(className);
      }else{
          return new RegExp('(^| )' + className + '( |$)', 'gi').test(el.className);
      }
    }

    function addClass(el, className){
      if(!isElement(el)){
        return false;
      }
      if (el.classList){
        el.classList.add(className);
      }else{
        el.className += ' ' + className;
      }
    }

    function removeClass(el, className){
      if(!isElement(el)){
        return false;
      }
      if (el.classList){
          el.classList.remove(className);
      }else{
          el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
      }
    }

    function toggleClass(el, className){
      if(!isElement(el)){
        return false;
      }
      if (el.classList) {
          el.classList.toggle(className);
      } else {
        var classes = el.className.split(' ');
        var existingIndex = classes.indexOf(className);
        if (existingIndex >= 0){
          classes.splice(existingIndex, 1);
        }else{
          classes.push(className);
          el.className = classes.join(' ');
        }
      }
    }

    function exists(el){
        return el.querySelector(selector) !== null;
    }

    return new Elements();
});
