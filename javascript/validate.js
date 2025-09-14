function validateFormJS() {
    const form = document.getElementById('form');
    if (!form) return false;

    let isValid = true;
    const requiredFields = ['firstname','lastname', 'email', 'subject', 'message'];

    // Clear previous error states
    form.querySelectorAll('.input-control').forEach(control => {
        control.classList.remove('error');
    });

    // Validate required fields
    requiredFields.forEach(fieldName => {
        const input = form.elements[fieldName];
        const value = input.value.trim();

        if (value === '') {
            setError(input);
            isValid = false;
        }

        if (fieldName === 'email' && value !== '') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                setError(input);
                isValid = false;
            }
        }
    });

    // Optional telephone field
    const telephoneInput = form.elements['telephone'];
    if (telephoneInput && telephoneInput.value.trim() !== '') {
        const phoneRegex = /^\+?\d(?:\d|\s){6,15}$/;
        if (!phoneRegex.test(telephoneInput.value.trim())) {
            setError(telephoneInput);
            isValid = false;
        }
    }

    return isValid; // crucial for onsubmit
}

// Functions for the error state
function setError(input) {
    const inputControl = input.closest('.input-control');
    if (inputControl) inputControl.classList.add('error');
}
