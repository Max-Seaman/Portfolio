"use strict";

var form = document.getElementById('form');
form.addEventListener('submit', function (event) {
  event.preventDefault();
  var form = event.target;
  var requiredFields = ['firstname', 'lastname', 'email', 'subject', 'message'];
  var isValid = true; // Clear error statements from before

  var errorDisplay = form.querySelectorAll('.input-control.error');
  var _iteratorNormalCompletion = true;
  var _didIteratorError = false;
  var _iteratorError = undefined;

  try {
    for (var _iterator = errorDisplay[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
      var control = _step.value;
      control.classList.remove('error');
    } // Validation for each field in the array

  } catch (err) {
    _didIteratorError = true;
    _iteratorError = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion && _iterator["return"] != null) {
        _iterator["return"]();
      }
    } finally {
      if (_didIteratorError) {
        throw _iteratorError;
      }
    }
  }

  for (var _i = 0, _requiredFields = requiredFields; _i < _requiredFields.length; _i++) {
    var fieldName = _requiredFields[_i];
    var input = form.elements[fieldName];
    var value = input.value.trim();

    if (value === '') {
      setError(input, "".concat(input.placeholder.replace(/\*$/, ''), " is required."));
      isValid = false;
    } else {
      setSuccess(input);
    }

    if (fieldName === 'email') {
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!emailRegex.test(value)) {
        setError(input, 'Please enter a valid email');
        isValid = false;
      }
    }
  } // Alert message when everything is correct


  if (isValid) {
    alert('Form submitted successfully!'); // will add form.submit() here when needed 
  }
}); // Functions for the error and success messages

function setError(input, message) {
  var inputControl = input.parentElement;
  var errorDisplay = inputControl.querySelector('.error');
  errorDisplay.innerText = message;
  inputControl.classList.remove('success');
  inputControl.classList.add('error');
}

function setSuccess(input) {
  var inputControl = input.parentElement;
  var errorDisplay = inputControl.querySelector('.error');
  errorDisplay.innerText = '';
  inputControl.classList.remove('error');
  inputControl.classList.add('success');
}
//# sourceMappingURL=index.dev.js.map
