function validateLogin() {
    const fullname = document.getElementById('fullname').value.trim();
    const email = document.getElementById('email').value.trim();
    const phonenumber = document.getElementById('phonenumber').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmpassword = document.getElementById('confirmpassword').value.trim();
    const male = document.getElementById('male').checked;
    const female = document.getElementById('female').checked;

    // Check if passwords match
    if (password !== confirmpassword) {
        alert('Passwords do not match');
        return false;
    }

    // Check if all required fields are filled
    if (fullname === '' || email === '' || phonenumber === '' || password === '' || confirmpassword === '' || (!male && !female)) {
        alert('Please fill in all required fields');
        return false;
    }

    return true;
}

function validatePhoneNumber(input) {
    // Remove non-numeric characters from input value
    input.value = input.value.replace(/\D/g, '');

    // Limit input to maximum 11 characters
    if (input.value.length > 11) {
        input.value = input.value.slice(0, 11);
    }
}

function validateStep(stepId) {
    const inputs = document.querySelectorAll(`#${stepId} input[required]`);
    for (let input of inputs) {
        if (input.value.trim() === '') {
            alert('Please fill in all required fields before proceeding.');
            return false;
        }
    }
    return true;
}

function nextStep() {
    const currentStep = document.querySelector('form > div:not([style*="display: none"])');
    if (validateStep(currentStep.id)) {
        const nextStep = currentStep.nextElementSibling;
        if (nextStep) {
            currentStep.style.display = 'none';
            nextStep.style.display = 'block';
        }
    }
}

function prevStep() {
    const currentStep = document.querySelector('form > div:not([style*="display: none"])');
    const prevStep = currentStep.previousElementSibling;

    if (prevStep) {
        currentStep.style.display = 'none';
        prevStep.style.display = 'block';
    }
}