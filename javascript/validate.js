const form = document.getElementById('form');

form.addEventListener('submit', (event) => {
    event.preventDefault();
    
    const form = event.target;
    const requiredFields = [
        'firstname',
        'lastname',
        'email',
        'subject',
        'message',
    ]
    let isValid = true;

    // Clear error statements from before
    const errorDisplay = form.querySelectorAll('.input-control.error');
    for (const control of errorDisplay) {
        control.classList.remove('error');
    }
      
    // Validation for each field in the array
    for (let fieldName of requiredFields) {
        const input = form.elements[fieldName];
        const value = input.value.trim();

        if (value === '') {
            setError(input, `${input.placeholder.replace(/\*$/, '')} is required.`);
            isValid = false;
        } else {
            setSuccess(input);
        }

        if (fieldName === 'email') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (value !== '' && !emailRegex.test(value)) {
                setError(input, 'Please enter a valid email');
                isValid = false;
            }
        }
    }

    // Separate validation for the phone number as its not a required field
    const telephoneInput = document.getElementById('telephone');
    const telephoneValue = telephoneInput.value.trim();
    const telephoneRegex = /^\+?\d(?:\d|\s){6,15}$/;
    if (telephoneValue === '') {
        // If field is cleared, remove both error and success classes
        const inputControl = telephoneInput.parentElement;
        const errorDisplay = inputControl.querySelector('.error');
        
        errorDisplay.innerText = '';
        inputControl.classList.remove('error', 'success');
    } else if (!telephoneRegex.test(telephoneValue)) {
        setError(telephoneInput, 'Please enter a valid phone number');
        isValid = false;
    } else {
        setSuccess(telephoneInput);
    }

    // Alert message when everything is correct
    if (isValid) {
        alert('Form submitted successfully!');
        // will add form.submit() here when needed 

        // Reset the form fields
        form.reset();

        // Remove success classes
        const inputControls = form.querySelectorAll('.input-control');
        for (const control of inputControls) {
            control.classList.remove('success');
        }
    }

});

// Functions for the error and success messages
function setError(input, message) {
    const inputControl = input.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.remove('success');
    inputControl.classList.add('error');
}

function setSuccess(input) {
    const inputControl = input.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.remove('error');
    inputControl.classList.add('success');
}