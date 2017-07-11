/*
*   This content is licensed according to the W3C Software License at
*   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
*
*   File:   button.js
*
*   Desc:   JS code for Button Design Pattersn
*
*   Author: Jon Gunderson
*/

//From https://www.w3.org/TR/wai-aria-practices/examples/button/button.html
//Modified to support only aria-pressed

function init () {

  var toggleButtons = document.querySelectorAll('a[role=button], div[role=button]');

  for(var i = 0, len = toggleButtons.length; i < len; i++) {
    // Add event listeners
    toggleButtons[i].addEventListener('click', toggleButtonEventHandler);
    toggleButtons[i].addEventListener('keydown', toggleButtonEventHandler);
  }
}

function toggleButtonEventHandler (event) {
  var type = event.type;

  // Grab the keydown and click events
  if (type === 'keydown') {
    // If either enter or space is pressed, execute the funtion
    if (event.keyCode === 13 || event.keyCode === 32) {
      toggleButtonState(event);

      event.preventDefault();
    }
  }
  else if (type === 'click') {
    // Only allow this event if either role is correctly set
    // or a correct element is used.
    if (event.target.getAttribute('role') === 'button' || event.target.tagName === 'button') {
      toggleButtonState(event);
    }
  }
}

function toggleButtonState (event) {
  var button = event.target;
  var currentState = button.getAttribute('aria-pressed');
  var newState = 'true';

  // If aria-pressed is set to true, set newState to false
  if (currentState === 'true') {
    newState = 'false';
  }

  // Set the new aria-pressed state on the button
  button.setAttribute('aria-pressed', newState);
}

window.addEventListener('load', function (event) {
  init();
}, false);
