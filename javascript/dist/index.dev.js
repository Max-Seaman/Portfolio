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
      var _control = _step.value;

      _control.classList.remove('error');
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

      if (value !== '' && !emailRegex.test(value)) {
        setError(input, 'Please enter a valid email');
        isValid = false;
      }
    }
  } // Separate validation for the phone number as its not a required field


  var telephoneInput = document.getElementById('telephone');
  var telephoneValue = telephoneInput.value.trim();
  var telephoneRegex = /^\d{11}$/;

  if (telephoneValue === '') {
    // If field is cleared, remove both error and success classes
    var inputControl = telephoneInput.parentElement;

    var _errorDisplay = inputControl.querySelector('.error');

    _errorDisplay.innerText = '';
    inputControl.classList.remove('error', 'success');
  } else if (!telephoneRegex.test(telephoneValue)) {
    setError(telephoneInput, 'Please enter a valid phone number');
    isValid = false;
  } else {
    setSuccess(telephoneInput);
  } // Alert message when everything is correct


  if (isValid) {
    alert('Form submitted successfully!'); // will add form.submit() here when needed 
    // Reset the form fields

    form.reset(); // Remove success classes

    var inputControls = form.querySelectorAll('.input-control');
    var _iteratorNormalCompletion2 = true;
    var _didIteratorError2 = false;
    var _iteratorError2 = undefined;

    try {
      for (var _iterator2 = inputControls[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
        var control = _step2.value;
        control.classList.remove('success');
      }
    } catch (err) {
      _didIteratorError2 = true;
      _iteratorError2 = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion2 && _iterator2["return"] != null) {
          _iterator2["return"]();
        }
      } finally {
        if (_didIteratorError2) {
          throw _iteratorError2;
        }
      }
    }
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
