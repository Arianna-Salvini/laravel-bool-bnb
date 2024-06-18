let street_number = document.getElementById('street_number');
let formCreate = document.getElementById('apartment-form');
let streetNumberErrorDiv = document.getElementById('number_error');


function validatedInput(input) {
    // check that the string contains letters, numbers, and only the '/' character
    const regex = /^[a-zA-Z0-9/]+$/;
    return regex.test(input);
}

formCreate.addEventListener('submit', function (e) {
    let inputValue = street_number.value;
    let isValid = validatedInput(inputValue);

    if (!isValid) {
        e.preventDefault(); // prevent form submission
        street_number.classList.add('is-invalid');
        streetNumberErrorDiv.textContent = 'Attention!!! Invalid street number format';
    } else {
        street_number.classList.remove('is-invalid');
        streetNumberErrorDiv.textContent = '';
    }
});
