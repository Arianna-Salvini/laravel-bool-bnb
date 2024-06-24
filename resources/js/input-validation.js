/* let street_number = document.getElementById('street_number'); */
let formCreate = document.getElementById('apartment-form');
let roomsInput = document.getElementById('rooms');
let bedsInput = document.getElementById('beds');
let inputBathrooms = document.getElementById('bathrooms');
let squareMetersInput = document.getElementById('square_meters');
let services = document.getElementsByName('services[]');
let submit = document.getElementById('submit-btn')

console.log(submit)

/* let streetNumberErrorDiv = document.getElementById('number_error'); */
let roomsErrorDiv = document.getElementById('rooms_error');
let bedsErrorDiv = document.getElementById('beds_error');
let bathroomsErrorDiv = document.getElementById('bathrooms_error');
let squareMetersErorrDiv = document.getElementById('square_meters_error');
let servicesErrorDiv = document.getElementById('services_error');



function validatedInput(input) {
    // check that the string contains letters, numbers, and only the '/' character
    const regex = /^[a-zA-Z0-9/]+$/;
    return regex.test(input);
}
//function for input number (rooms,beds,bathrooms)
function validateNumberInput(input) {
    // check the input contains only numbers
    const regex = /^[0-9]+$/;
    return regex.test(input);
}

/* formCreate.addEventListener('keyup', function (e) {
    let inputValue = street_number.value;
    let isValid = validatedInput(inputValue);

    if (!isValid) {
        e.preventDefault(); 
        street_number.classList.add('is-invalid');
        streetNumberErrorDiv.textContent = 'Attention!!! Invalid street number format';
    } else {
        street_number.classList.remove('is-invalid');
        street_number.classList.add('is-valid');
        streetNumberErrorDiv.textContent = '';
    }
}); */

formCreate.addEventListener('submit', function (e) {
    let servicesChecked = false;
    submit.disabled = true
    submit.innerText = "Loading...";
    services.forEach(checkbox => {
        if (checkbox.checked) {
            servicesChecked = true;
        }
    });

    if (!servicesChecked) {
        e.preventDefault();
        servicesErrorDiv.textContent = 'Please select at least one service.';
        submit.disabled = false;
        submit.innerText = "Add";
    } else {
        servicesErrorDiv.textContent = '';
    }
});




roomsInput.addEventListener('keyup', function (e) {
    let inputValue = roomsInput.value;
    let isValidInput = validateNumberInput(inputValue);

    if (!isValidInput) {
        e.preventDefault();
        roomsInput.classList.add('is-invalid');
        roomsErrorDiv.textContent = 'Invalid input Rooms. Only numbers are allowed.';
    } else {
        roomsInput.classList.remove('is-invalid');
        roomsInput.classList.add('is-valid');
        roomsErrorDiv.textContent = '';
    }
});

bedsInput.addEventListener('keyup', function (e) {
    let inputValue = bedsInput.value;
    let isValidInput = validateNumberInput(inputValue);

    if (!isValidInput) {
        e.preventDefault();
        bedsInput.classList.add('is-invalid');
        bedsErrorDiv.textContent = 'Invalid input Beds. Only numbers are allowed.';
    } else {
        bedsInput.classList.remove('is-invalid');
        bedsInput.classList.add('is-valid');
        bedsErrorDiv.textContent = '';
    }
});

inputBathrooms.addEventListener('keyup', function (e) {
    let inputValue = inputBathrooms.value;
    let isValidInput = validateNumberInput(inputValue);

    if (!isValidInput) {
        e.preventDefault();
        inputBathrooms.classList.add('is-invalid');
        bathroomsErrorDiv.textContent = 'Invalid input Bathrooms. Only numbers are allowed.';
    } else {
        inputBathrooms.classList.remove('is-invalid');
        inputBathrooms.classList.add('is-valid');
        bathroomsErrorDiv.textContent = '';
    }
});
squareMetersInput.addEventListener('keyup', function (e) {
    let inputValue = squareMetersInput.value;
    let isValidInput = validateNumberInput(inputValue);

    if (!isValidInput) {
        e.preventDefault();
        squareMetersInput.classList.add('is-invalid');
        squareMetersErorrDiv.textContent = 'Invalid input Square Meters. Only numbers are allowed.';
    } else {
        squareMetersInput.classList.remove('is-invalid');
        squareMetersInput.classList.add('is-valid');
        squareMetersErorrDiv.textContent = '';
    }
});

